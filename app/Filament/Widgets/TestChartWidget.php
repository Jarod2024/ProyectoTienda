<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Estadísticas de Clientes';

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
        // Consulta los datos directamente desde la base de datos
        $data = DB::table('clientes')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();

        // Asegúrate de que haya 12 meses en los datos
        $monthlyData = array_replace(array_fill(1, 12, 0), $data);

        return [
            'datasets' => [
                [
                    'label' => 'Clientes registrados',
                    'data' => array_values($monthlyData),
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
        return 'line'; // Puedes cambiar esto a 'bar', 'pie', etc.
    }
}
