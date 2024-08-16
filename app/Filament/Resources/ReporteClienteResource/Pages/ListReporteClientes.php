<?php

namespace App\Filament\Resources\ReporteClienteResource\Pages;

use App\Filament\Resources\ReporteClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class ListReporteClientes extends ListRecords
{
    protected static string $resource = ReporteClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('PDF')
                ->label('Exportar PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    // Obtener los registros de ReporteCliente.
                    $reporteClientes = Cliente::all();

                    // Renderizar una vista en PDF.
                    $pdf = Pdf::loadView('PDF.ClientesPDF', [
                        'reporteClientes' => $reporteClientes,
                    ]);

                    // Descargar el PDF.
                    return response()->streamDownload(
                        fn () => print($pdf->stream()),
                        'reporte_clientes.pdf'
                    );
                })
                ->requiresConfirmation()
                ->color('success'),
        ];
    }
}
