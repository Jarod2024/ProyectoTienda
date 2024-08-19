<?php

namespace App\Filament\Resources\ReporteClienteResource\Pages;

use App\Filament\Resources\ReporteClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteCliente extends EditRecord
{
    protected static string $resource = ReporteClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
