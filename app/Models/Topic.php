<?php

namespace App\Models;

use App\Traits\IsLocalizable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $name
 * @property string $description
 */
class Topic extends Model
{
    use HasFactory, HasSlug, HasTranslations, IsLocalizable;

    protected $guarded = [];

    protected $casts = [
        'locales' => 'array',
    ];

    public array $translatable = ['name', 'description'];

    public function articles(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function setNameAttribute(string $value = null): void
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setMeta(): void
    {
        SEOTools::setTitle($this->name);
        SEOTools::setDescription($this->description ?? '');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::twitter()->setSite('@livinggodnet');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
