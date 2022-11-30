<?php

namespace App\Filament\Resources\PostSeriesResource\Pages;

use App\Filament\Resources\PostSeriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostSeries extends ListRecords
{
    protected static string $resource = PostSeriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
