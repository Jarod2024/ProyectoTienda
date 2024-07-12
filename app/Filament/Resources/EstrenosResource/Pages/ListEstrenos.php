<?php

namespace App\Filament\Resources\EstrenosResource\Pages;

use App\Filament\Resources\EstrenosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstrenos extends ListRecords
{
    protected static string $resource = EstrenosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
