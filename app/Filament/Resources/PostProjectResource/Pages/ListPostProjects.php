<?php

namespace App\Filament\Resources\PostProjectResource\Pages;

use App\Filament\Resources\PostProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostProjects extends ListRecords
{
    protected static string $resource = PostProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
