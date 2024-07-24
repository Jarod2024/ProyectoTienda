<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Cliente;
use App\Models\Productos;
use Illuminate\Support\Facades\Auth;

class TestWidget extends BaseWidget
{
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
     * Retorna la configuración de estadísticas del widget.
     *
     * @return array
     */
    protected function getStats(): array
    {
        return [
            Stat::make('Nuevos Usuarios', Cliente::count())
                ->description('Usuarios registrados recientemente')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([1, 3, 4, 5, 10, 20, 40]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('success'),

            Stat::make('Nuevos Productos', Productos::count())
                ->description('Productos registrados recientemente')
                ->descriptionIcon('heroicon-o-shopping-bag') // Ajusta el ícono según sea necesario
                ->chart([1, 2, 4, 7, 11, 18, 30]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('primary'), // Cambié el color a 'primary', puedes ajustar según el diseño
        ];
    }
}


