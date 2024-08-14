<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductosChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Estadísticas de Productos';

    /**
     * Verifica si el widget debe ser visible para el usuario actual.
     *
     * @return bool
     */
    public static function canView(): bool
    {
        // Verifica si el usuario está autenticado y tiene el rol de administrador
        return Auth::check() && Auth::user()->hasRole('Admin'); // Ajusta según tu sistema de roles
    }

    /**
     * Obtiene los datos para el gráfico.
     *
     * @return array Datos para el gráfico.
     */
    protected function getData(): array
    {
        // Datos de productos
        $productosData = DB::table('productos')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();

        // Asegúrate de que haya 12 meses en los datos
        $monthlyProductosData = array_replace(array_fill(1, 12, 0), $productosData);

        return [
            'datasets' => [
                [
                    'label' => 'Productos registrados',
                    'data' => array_values($monthlyProductosData),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        ];
    }

    /**
     * Obtiene el tipo de gráfico.
     *
     * @return string Tipo de gráfico.
     */
    protected function getType(): string
    {
        return 'bar'; // Cambiado a 'bar' para gráfico de barras
    }
}
