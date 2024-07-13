<?php

namespace App\Filament\Resources\OfertasResource\Pages;

use App\Filament\Resources\OfertasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfertas extends EditRecord
{
    protected static string $resource = OfertasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
