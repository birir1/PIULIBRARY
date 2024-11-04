<?php

namespace App\Filament\Student\Resources\PastPaperResource\Pages;

use App\Filament\Student\Resources\PastPaperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPastPapers extends ListRecords
{
    protected static string $resource = PastPaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
