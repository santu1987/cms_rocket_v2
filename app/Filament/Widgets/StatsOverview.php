<?php
namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Product;
use App\Models\Contact;
use App\Models\ProductType;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Productos Cargados', Product::count())
                ->description('Total de inventario')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Tipos de Productos', ProductType::count())
                ->description('Total de tipos de productos')
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('success'),    

            Stat::make('Contactos Registrados', Contact::count()) // Asegúrate de tener este modelo
                ->description('Personas interesadas')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

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