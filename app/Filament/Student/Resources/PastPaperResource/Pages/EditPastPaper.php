<?php

namespace App\Filament\Student\Resources\PastPaperResource\Pages;

use App\Filament\Student\Resources\PastPaperResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPastPaper extends EditRecord
{
    protected static string $resource = PastPaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
