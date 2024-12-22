<?php

namespace App\Filament\Resources\PahlawanResource\Pages;

use App\Filament\Resources\PahlawanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPahlawan extends EditRecord
{
    protected static string $resource = PahlawanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
