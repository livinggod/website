<?php

namespace App\Providers;

use App\Domain\SendPortal\Integrations\SendPortal;
use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sendportal', SendPortal::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);

        Carbon::setLocale(App::currentLocale());

        Model::preventLazyLoading(app()->isLocal());

        Blade::directive('block', fn ($expression) => "<?php echo \App\Models\Block::getCachedByCode($expression); ?>");
        Blade::directive('limit', fn ($expression) => "<?php echo \Illuminate\Support\Str::limit($expression) ?? ''; ?>");
        Blade::directive('latestposts', fn ($expression) => "<?php echo \App\Models\Post::getCachedLatestPosts($expression); ?>");
    }
}
