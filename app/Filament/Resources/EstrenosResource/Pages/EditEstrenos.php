<?php

namespace App\Filament\Resources\EstrenosResource\Pages;

use App\Filament\Resources\EstrenosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstrenos extends EditRecord
{
    protected static string $resource = EstrenosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
