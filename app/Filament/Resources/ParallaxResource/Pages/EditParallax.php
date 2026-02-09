<?php

namespace App\Filament\Resources\ParallaxResource\Pages;

use App\Filament\Resources\ParallaxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParallax extends EditRecord
{
    protected static string $resource = ParallaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
