<?php

namespace App\Domain\SendPortal\Models;

use App\Domain\SendPortal\Facades\SendPortal;

class Subscriber extends BaseModel
{
    /**
     * @param array<int> $tags
     */
    public static function add(string $email, string $firstname = '', string $lastname = '', array $tags = []): static
    {
        $subscriber = SendPortal::post('subscribers', [
            'first_name' => $firstname,
            'last_name'  => $lastname,
            'email'      => $email,
            'tags'       => $tags,
        ])['data'];

        $subscriber = new static($subscriber);

        $subscriber->tags = collect($subscriber->tags)->mapInto(Tag::class);

        return $subscriber;
    }

    public static function findByEmail(string $email)
    {
        $subscribers = SendPortal::get('subscribers')['data'];

        return collect($subscribers)->mapInto(static::class)->filter(fn (self $subscriber) => strtolower($subscriber->email) === strtolower($email))->first();
    }
}
