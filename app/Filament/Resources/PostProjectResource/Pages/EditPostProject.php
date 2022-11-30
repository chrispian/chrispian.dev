<?php

namespace App\Filament\Resources\PostProjectResource\Pages;

use App\Filament\Resources\PostProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostProject extends EditRecord
{
    protected static string $resource = PostProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
