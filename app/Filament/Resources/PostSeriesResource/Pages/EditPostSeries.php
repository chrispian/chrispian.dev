<?php

namespace App\Filament\Resources\PostSeriesResource\Pages;

use App\Filament\Resources\PostSeriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostSeries extends EditRecord
{
    protected static string $resource = PostSeriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
