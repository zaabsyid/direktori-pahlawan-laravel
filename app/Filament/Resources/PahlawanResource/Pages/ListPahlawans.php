<?php

namespace App\Filament\Resources\PahlawanResource\Pages;

use App\Filament\Resources\PahlawanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPahlawans extends ListRecords
{
    protected static string $resource = PahlawanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
