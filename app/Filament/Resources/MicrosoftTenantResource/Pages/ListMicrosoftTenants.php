<?php

namespace App\Filament\Resources\MicrosoftTenantResource\Pages;

use App\Filament\Resources\MicrosoftTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMicrosoftTenants extends ListRecords
{
    protected static string $resource = MicrosoftTenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
