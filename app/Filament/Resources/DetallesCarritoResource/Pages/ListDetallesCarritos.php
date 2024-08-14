<?php

namespace App\Filament\Resources\DetallesCarritoResource\Pages;

use App\Filament\Resources\DetallesCarritoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetallesCarritos extends ListRecords
{
    protected static string $resource = DetallesCarritoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
