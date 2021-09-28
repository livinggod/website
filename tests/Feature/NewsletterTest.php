<?php

namespace Tests\Feature;

use App\Domain\SendPortal\Facades\SendPortal;
use App\Domain\SendPortal\Models\Subscriber;
use App\Extensions\Locale\Locale;
use App\Mail\NewsletterOptInMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_a_opt_in_mail_with_temporary_signed_route(): void
    {
        Mail::fake();
        SendPortal::shouldReceive('get')
            ->andReturn(['data' => []]);

        $this->post(route('newsletter.store'), ['email' => 'test@test.com'])
            ->assertSessionHas('message', "We've send you an email to confirm your newsletter subscription!");

        Mail::assertQueued(NewsletterOptInMail::class, function (NewsletterOptInMail $mail) {
            return Str::contains($mail->url, ['signature', 'expires']);
        });
    }

    /** @test */
    public function if_the_email_already_exists_it_wont_send_a_mail_and_give_a_notice(): void
    {
        Mail::fake();
        SendPortal::shouldReceive('get')
            ->andReturn($this->fakeSubscriber());

        $this->post(route('newsletter.store'), ['email' => 'test@test.com'])
            ->assertSessionHas('message', 'This email address is already subscribed.');

        Mail::assertNotQueued(NewsletterOptInMail::class);
    }

    /** @test */
    public function it_redirects_to_correct_language_after_opting_in(): void
    {
        SendPortal::shouldReceive('get')->andReturn(['data' => []]);
        SendPortal::shouldReceive('post')->andReturn(['data'=> ['tags' => []]]);

        $url = URL::temporarySignedRoute(
            'opt-in', now()->addMinutes(120), ['email' => 'test@test.com', 'language' => 'nl']
        );

        $this
            ->get($url)
            ->assertRedirect(
                uri: Locale::redirectToLocale('nl', '/')
            );
    }

    protected function fakeSubscriber(): array
    {
        return [
            'data' => [
                [
                    'id'              => 1,
                    'email'           => 'test@test.com',
                    'unsubscribed_at' => null,
                    'tags'            => [],
                ]
            ],
        ];
    }
}
