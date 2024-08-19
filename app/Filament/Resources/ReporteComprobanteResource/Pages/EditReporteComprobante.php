<?php

namespace App\Filament\Resources\ReporteComprobanteResource\Pages;

use App\Filament\Resources\ReporteComprobanteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteComprobante extends EditRecord
{
    protected static string $resource = ReporteComprobanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
