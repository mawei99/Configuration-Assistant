<?php

namespace App\Filament\Resources\ConfigurationTemplateResource\Pages;

use App\Filament\Resources\ConfigurationTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfigurationTemplate extends EditRecord
{
    protected static string $resource = ConfigurationTemplateResource::class;

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
        return 'Configuration Template updated';
    }
}
