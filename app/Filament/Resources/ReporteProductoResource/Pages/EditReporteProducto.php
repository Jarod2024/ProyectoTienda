<?php

namespace App\Filament\Resources\ReporteProductoResource\Pages;

use App\Filament\Resources\ReporteProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteProducto extends EditRecord
{
    protected static string $resource = ReporteProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
