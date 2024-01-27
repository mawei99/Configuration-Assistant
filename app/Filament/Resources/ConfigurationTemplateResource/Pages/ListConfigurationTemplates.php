<?php

namespace App\Filament\Resources\ConfigurationTemplateResource\Pages;

use App\Filament\Resources\ConfigurationTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfigurationTemplates extends ListRecords
{
    protected static string $resource = ConfigurationTemplateResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
