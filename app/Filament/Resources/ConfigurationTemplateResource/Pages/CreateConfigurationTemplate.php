<?php

namespace App\Filament\Resources\ConfigurationTemplateResource\Pages;

use App\Filament\Resources\ConfigurationTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConfigurationTemplate extends CreateRecord
{
    protected static string $resource = ConfigurationTemplateResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Configuration Template created';
    }
}
