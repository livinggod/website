<?php

namespace App\Http\Controllers;

use App\Domain\SendPortal\Models\Subscriber;
use App\Domain\SendPortal\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NewsletterOptInController
{
    public function __invoke(Request $request): RedirectResponse
    {
        App::setLocale($request->language);
        if (Subscriber::findByEmail($request->email)) {
            return redirect(
                config("localization.allowed_locales.{$request->language}.domain")
            )->with('message', __('This email address is already subscribed.'));
        }

        $tags = [];

        if ($tag = Tag::findByName($request->language)) {
            $tags[] = $tag->id;
        }

        Subscriber::add(
            email: $request->email,
            firstname: explode('@', $request->email)[0],
            tags: $tags
        );

        return redirect(
            config("localization.allowed_locales.{$request->language}.domain")
        )->with('message', __("Thanks for signing up! You'll now receive updates on our latest articles!"));
    }
}
