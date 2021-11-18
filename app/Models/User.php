<?php

namespace App\Models;

use App\Traits\ConvertsToWebp;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $name
 * @property string $bio
 */
class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use ConvertsToWebp;
    use HasSlug;
    use HasTranslations;

    public string $imageProperty = 'avatar';

    public array $translatable = ['bio'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar',
        'show_email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'super_admin' => 'boolean',
    ];

    protected $with = [
        'roles',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->super_admin ?? false;
    }

    public function setMeta(): void
    {
        SEOTools::setTitle($this->name);
        SEOTools::setDescription($this->bio ?? '');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::twitter()->setSite('@livinggodnet');
        SEOTools::jsonLd()->addImage(asset('storage/' . $this->avatar));
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function canImpersonate(self $impersonated = null): bool
    {
        return $this->isSuperAdmin() || $this->hasRole('admin');
    }

    public function canBeImpersonated(?\Illuminate\Contracts\Auth\Authenticatable $impersonator = null): bool
    {
        return ! $this->isSuperAdmin();
    }
}
