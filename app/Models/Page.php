<?php

namespace App\Models;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Directives\Flexible;
use App\Traits\ConvertsToWebp;
use App\Traits\IsLocalizable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $title
 */
class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use IsLocalizable;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $attributes = [
        'image' => 'test', // TODO: remove image column
    ];

    protected $hidden = [
        'image'
    ];

    public array $translatable = ['title', 'content'];

    protected $casts = [
        'content' => 'array',
        'locales' => 'array'
    ];

    public function setMeta(): void
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription(Flexible::render($this->content));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::twitter()->setSite('@livinggodnet');
        SEOTools::jsonLd()->addImage($this->getFirstMediaUrl());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->singleFile();
    }
}
