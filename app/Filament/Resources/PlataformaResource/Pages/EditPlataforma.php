<?php

namespace App\Filament\Resources\PlataformaResource\Pages;

use App\Filament\Resources\PlataformaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlataforma extends EditRecord
{
    protected static string $resource = PlataformaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
