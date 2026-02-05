<?php
namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios Totales', User::count())
                ->description('Usuarios registrados en Rocket')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Roles Activos', '2') // Aquí podrías contar tus roles de Rocket
                ->description('Admin y Editor')
                ->color('info'),

            Stat::make('Estado del Servidor', 'Activo')
                ->description('Conectado a bd_cms_rocket')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('primary'),
        ];
    }
}