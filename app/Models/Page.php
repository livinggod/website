<?php

namespace App\Models;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Traits\ConvertsToWebp;
use App\Traits\IsLocalizable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $title
 */
class Page extends Model
{
    use HasFactory, ConvertsToWebp, HasTranslations, IsLocalizable;

    protected $guarded = [];

    public $translatable = ['title', 'content'];

    protected $casts = [
        'locales' => 'array',
    ];

    public function setMeta(): void
    {
        SEOTools::setTitle($this->title);
        SEOTools::setDescription(
            strip_tags(
                NovaEditorJs::generateHtmlOutput($this->content)
            )
        );
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::twitter()->setSite('@livinggodnet');
        SEOTools::jsonLd()->addImage(asset('storage/' . $this->image));
    }
}
