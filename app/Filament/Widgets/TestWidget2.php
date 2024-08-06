<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\Estrenos;
use App\Models\Ofertas;
use App\Models\Categoria;
use App\Models\Plataforma;

class TestWidget2 extends BaseWidget
{
    /**
     * Verifica si el widget debe ser visible para el usuario actual.
     *
     * @return bool
     */
    public static function canView(): bool
    {
        // Verifica si el usuario está autenticado y tiene el rol de 'employee'
        return Auth::check() && Auth::user()->hasRole('employee'); // Ajusta según tu sistema de roles
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Nuevos Estrenos', Estrenos::count())
                ->description('Estrenos registrados recientemente')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([1, 3, 4, 5, 10, 20, 40]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('success'),

            Stat::make('Nuevas Ofertas', Ofertas::count())
                ->description('Ofertas registradas recientemente')
                ->descriptionIcon('heroicon-o-shopping-bag') // Ajusta el ícono según sea necesario
                ->chart([1, 2, 4, 7, 11, 18, 30]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('primary'), // Cambié el color a 'primary', puedes ajustar según el diseño
            
            Stat::make('Nuevas Categorías', Categoria::count())
                ->description('Categorías registradas recientemente')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([1, 3, 4, 5, 10, 20, 40]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('success'),

            Stat::make('Nuevas Plataformas', Plataforma::count())
                ->description('Plataformas registradas recientemente')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([1, 3, 4, 5, 10, 20, 40]) // Puedes ajustar estos datos de acuerdo a tus necesidades
                ->color('success'),
        ];
    }
}
