<?php

namespace App\Http\Response\Responses;

use App\Extensions\Locale\Locale;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

        $currentLocaleSupported = $this->post->locales->contains(App::currentLocale());

        if (! $currentLocaleSupported) {
            $locale = $this->post->locales->filter()->first();


            $this->redirectUrl = LaravelLocalization::getLocalizedUrl($locale, $this->post->getTranslation('slug', $locale));
        } else {
            $path = request()->path();
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $key) {
                $path = str_replace($key.'/', '', $path);
            }

            if ($path !== $this->post->getTranslation('slug', App::currentLocale())) {
                $this->redirectUrl = LaravelLocalization::getLocalizedUrl(App::currentLocale(), $this->post->getTranslation('slug', App::currentLocale()));
            }
        }

        return true;
    }
}
