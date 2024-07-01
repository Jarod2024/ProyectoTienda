<?php

namespace App\Filament\Resources\PlataformaResource\Pages;

use App\Filament\Resources\PlataformaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlataformas extends ListRecords
{
    protected static string $resource = PlataformaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
