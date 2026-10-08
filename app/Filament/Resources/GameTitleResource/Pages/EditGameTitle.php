<?php

namespace App\Filament\Resources\GameTitleResource\Pages;

use App\Filament\Resources\GameTitleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameTitle extends EditRecord
{
    protected static string $resource = GameTitleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
