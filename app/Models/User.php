<?php

namespace App\Models;

use App\Traits\ConvertsToWebp;
use Artesaos\SEOTools\Facades\SEOTools;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $name
 * @property string $bio
 *
 * @method static UserFactory factory(...$parameters)
 */
class User extends Authenticatable implements HasMedia, FilamentUser
{
    use HasSlug;
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use HasTranslations;
    use InteractsWithMedia;

    public string $imageProperty = 'avatar';

    public array $translatable = [
        'bio'
    ];

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
        'super_admin'       => 'boolean',
    ];

    protected $with = [
        'roles',
        'permissions',
        'media'
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
        SEOTools::jsonLd()->addImage($this->getFirstMedia()->getUrl());
    }

    public function canImpersonate(self $impersonated = null): bool
    {
        return $this->isSuperAdmin() || $this->hasRole('admin');
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->isSuperAdmin();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('card')
            ->width(80)
            ->height(80)
            ->format('webp')
            ->performOnCollections();
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function canManageSettings(): bool
    {
        return $this->isSuperAdmin() || $this->can('manage-settings');
    }

    public function canManageBackups(): bool
    {
        return $this->isSuperAdmin() || $this->can('manage-backups');
    }
}
