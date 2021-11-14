<?php

namespace App\Http\Controllers;

use App\Domain\SendPortal\Models\Subscriber;
use App\Mail\NewsletterOptInMail;
use App\Models\Newsletter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class NewsletterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'email' => 'required|email'
        ]);

        if (! Newsletter::where('email', 'quinten.buis@gmail.com')->exists() && Subscriber::findByEmail($request->email)) {
            session()->flash('message', __("This email address is already subscribed."));

            return back();
        }

        $url = URL::temporarySignedRoute(
            'opt-in', now()->addMinutes(120), ['email' => $valid['email'], 'language' => app()->currentLocale()]
        );

        Mail::to($valid['email'])
            ->locale(App::currentLocale())
            ->queue(new NewsletterOptInMail($url));

        Newsletter::remember($valid['email']);

        session()->flash('message', __("We've send you an email to confirm your newsletter subscription!"));

        return back();
    }
}
