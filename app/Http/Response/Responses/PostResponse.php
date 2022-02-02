<?php

namespace App\Http\Response\Responses;

use App\Extensions\Locale\Locale;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class PostResponse extends BaseResponse
{
    protected ?Post $post;

    protected string $redirectUrl = '';

    public function handle(): View | RedirectResponse
    {
        if (! $this->post->canShow()) {
            abort(404);
        }

        if (! empty($this->redirectUrl)) {
            return redirect($this->redirectUrl);
        }

        $this->post->setMeta();

        session()->flash('active', 'article');

        return view('posts.show', [
            'post' => $this->post
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        $this->post = Post::query()->where('slug', 'LIKE', "%{$slug}%")->first();

        if (! $this->post) {
            return false;
        }

//        $currentLocaleSupported = ! $this->post->locales->filter()->only(App::currentLocale())->isEmpty();
//
//        if (! $currentLocaleSupported) {
//            $locale = $this->post->locales->filter()->keys()[0];
//
//            $this->redirectUrl = config("localization.allowed_locales.{$locale}.domain")."/{$this->post->getTranslation('slug', $locale)}";
//        } else {
//            // check if the given slug belongs to the locale
//
//            if (request()->path() !== $this->post->getTranslation('slug', App::currentLocale())) {
//                $locale = $this->post->locales->filter()->keys()[0];
//
//                $this->redirectUrl = config("localization.allowed_locales.{$locale}.domain")."/{$this->post->getTranslation('slug', $locale)}";
//            }
//        }

        return true;
    }
}
