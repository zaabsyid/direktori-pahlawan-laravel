<?php

namespace App\Filament\Resources\PahlawanResource\Pages;

use App\Filament\Resources\PahlawanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePahlawan extends CreateRecord
{
    protected static string $resource = PahlawanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
