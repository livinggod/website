<?php

namespace App\Models;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Traits\ConvertsToWebp;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, ConvertsToWebp, HasTranslations;

    public $translatable = ['title', 'content'];

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
