<?php

namespace App\Filament\Pages;

use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups as BaseBackups;

class Backups extends BaseBackups
{
    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->canManageBackups() ?? true;
    }
}
