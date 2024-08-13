<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlatasformasCategoriasChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Estadísticas de Plataformas y Categorías';

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
        // Datos de plataformas
        $plataformasData = DB::table('plataformas')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();

        // Datos de categorías
        $categoriasData = DB::table('categorias')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();

        // Asegúrate de que haya 12 meses en los datos
        $monthlyPlataformasData = array_replace(array_fill(1, 12, 0), $plataformasData);
        $monthlyCategoriasData = array_replace(array_fill(1, 12, 0), $categoriasData);

        return [
            'datasets' => [
                [
                    'label' => 'Plataformas registradas',
                    'data' => array_values($monthlyPlataformasData),
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                ],
                [
                    'label' => 'Categorías registradas',
                    'data' => array_values($monthlyCategoriasData),
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'backgroundColor' => 'rgba(255, 206, 86, 0.2)',
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
        return 'radar'; // Cambiado a 'radar' para gráfico de radar
    }
}
