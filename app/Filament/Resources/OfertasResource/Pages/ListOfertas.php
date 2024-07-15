<?php

namespace App\Filament\Resources\OfertasResource\Pages;

use App\Filament\Resources\OfertasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfertas extends ListRecords
{
    protected static string $resource = OfertasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
