<?php

namespace App\Filament\Resources\ReporteProductoResource\Pages;

use App\Filament\Resources\ReporteProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Productos;
use Barryvdh\DomPDF\Facade\Pdf;

class ListReporteProductos extends ListRecords
{
    protected static string $resource = ReporteProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('PDF')
                ->label('Exportar PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    
                    $reporteProductos = Productos::with('categoria', 'plataforma')->get();
                    // Obtener los registros de ReporteCliente.
                    $reporteProductos = Productos::all();

                    // Renderizar una vista en PDF.
                    $pdf = Pdf::loadView('PDF.ProductosPDF', [
                        'reporteProductos' => $reporteProductos,
                    ]);

                    // Descargar el PDF.
                    return response()->streamDownload(
                        fn () => print($pdf->stream()),
                        'reporte_productos.pdf'
                    );
                })
                ->requiresConfirmation()
                ->color('success'),
        ];
    }
}
