<?php

namespace App\Models;

use App\Events\PostSaved;
use App\Traits\ConvertsToWebp;
use App\Traits\IsLocalizable;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $title
 * @property string $description
 */
class Post extends Model
{
    use HasFactory, ConvertsToWebp, HasTranslations, HasTranslatableSlug, IsLocalizable;

    const WORDS_PER_MINUTE_FALLBACK = 150;

    protected $guarded = [];

    protected $casts = [
        'publish_at' => 'datetime',
        'locales' => 'collection',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
    ];

    public $translatable = ['title', 'description', 'content', 'slug'];


    protected $dispatchesEvents = [
        'saved' => PostSaved::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where([['publish_at', '<=', now()], ['ready', true]]);
    }

    public function scopeLocalized(Builder $builder): Builder
    {
        if ($this->canShow()) {
            return $builder;
        }

        return $builder->where('locales->' . App::currentLocale(), true);
    }

    public function canShow(): bool
    {
        return $this->isPublished() || auth()->user()?->can('see-drafts');
    }

    public function isPublished(): bool
    {
        return ! is_null($this->publish_at) && $this->publish_at <= now() && $this->ready;
    }

    public function calculateRead(): int
    {
        $words = 0;
        foreach (optional(json_decode($this->getTranslation('content', app()->getLocale()), true))['blocks'] ?? [] as $block) {
            try {
                $words += str_word_count($block['data']['text']);
            } catch (Exception $e) {
            }
        }

        if (! $words) {
            return 0;
        }

        return (int)round($words / (store('wordsperminute') ?? self::WORDS_PER_MINUTE_FALLBACK), 0, PHP_ROUND_HALF_EVEN);
    }

    public static function getCachedLatestPosts(int $amount): Collection
    {
        return Cache::remember('latest_articles_' . App::currentLocale() . '_' . $amount, now()->addHour(),
            fn () => Post::published()->localized()->orderBy('publish_at', 'desc')->take($amount)->get()
        );
    }

    public function setMeta(): void
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::twitter()->setSite('@livinggodnet');
        SEOTools::jsonLd()->addImage(asset('storage/' . $this->image));
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
