<?php

namespace App\Filament\Resources\ParallaxResource\Pages;

use App\Filament\Resources\ParallaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParallaxes extends ListRecords
{
    protected static string $resource = ParallaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
