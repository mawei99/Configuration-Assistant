<?php

namespace App\Filament\Resources\MicrosoftTenantResource\Pages;

use App\Filament\Resources\MicrosoftTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMicrosoftTenant extends EditRecord
{
    protected static string $resource = MicrosoftTenantResource::class;

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

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Tenant updated';
    }
}