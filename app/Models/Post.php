<?php

namespace App\Models;

use App\Traits\ConvertsToWebp;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, ConvertsToWebp, HasTranslations;

    const WORDS_PER_MINUTE_FALLBACK = 150;

    protected $guarded = [];

    protected $casts = [
        'publish_at' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password'
    ];

    public $translatable = ['title', 'description', 'content'];

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

//    public function setTitleAttribute(?array $titles): void
//    {
//        $this->attributes['title'] = array_map(fn ($title) => ucwords($title), $titles);
//    }

    public function canShow(): bool
    {
        return $this->isPublished() || optional(auth()->user())->can('see-drafts');
    }

    public function isPublished(): bool
    {
        return !is_null($this->publish_at) && $this->publish_at <= now() && $this->ready;
    }

    public function calculateRead(): int
    {
        $words = 0;
        foreach (optional(json_decode($this->content, true))['blocks'] ?? [] as $block) {
            try {
                $words += count(explode(' ', strip_tags($block['data']['text'])));
            } catch (Exception $e) {}
        }

        if ($words === 0) {
            return 0;
        }

        $this->minutes = (int)round($words / (store('wordsperminute') ?? self::WORDS_PER_MINUTE_FALLBACK), 0, PHP_ROUND_HALF_EVEN);

        return $this->minutes;
    }

    public static function getCachedLatestPosts(int $amount): Collection
    {
        return Cache::remember('latest_articles_'.$amount, now()->addHour(),
            fn () => Post::published()->orderBy('publish_at', 'desc')->take($amount)->get()
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
