<?php

namespace App\Filament\Resources\MicrosoftTenantResource\Pages;

use App\Filament\Resources\MicrosoftTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMicrosoftTenant extends CreateRecord
{
    protected static string $resource = MicrosoftTenantResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string {
        return 'Tenant created';
    }
}
