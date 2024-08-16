<?php

namespace App\Filament\Resources\ReporteComprobanteResource\Pages;

use App\Filament\Resources\ReporteComprobanteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\comprobante;

class ListReporteComprobantes extends ListRecords
{
    protected static string $resource = ReporteComprobanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('PDF')
                ->label('Exportar PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    
                    $reporteComprobante = comprobante::with('cliente')->get();
                    // Obtener los registros de ReporteCliente.
                    $reporteComprobante = comprobante::all();

                    // Renderizar una vista en PDF.
                    $pdf = Pdf::loadView('PDF.ComprobantePDF', [
                        'reporteComprobante' => $reporteComprobante,
                    ]);

                    // Descargar el PDF.
                    return response()->streamDownload(
                        fn () => print($pdf->stream()),
                        'reporte_comprobante.pdf'
                    );
                })
                ->requiresConfirmation()
                ->color('success'),
        ];
    }
}
