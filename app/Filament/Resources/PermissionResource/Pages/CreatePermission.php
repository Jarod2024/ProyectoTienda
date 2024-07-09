<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;

    // Esta funcion permite movernos a la bandeja de permisos cuando se crea un nuevo permiso
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
