<?php

namespace App\Filament\Student\Resources\PastPaperResource\Pages;

use App\Filament\Student\Resources\PastPaperResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPastPaper extends ViewRecord
{
    protected static string $resource = PastPaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
