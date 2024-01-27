<?php

namespace App\Filament\Resources\MicrosoftTenantResource\Pages;

use App\Filament\Resources\MicrosoftTenantResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ViewMicrosoftTenant extends Page
{

    protected static string $resource = MicrosoftTenantResource::class;

    protected static string $view = 'filament.resources.microsoft-tenant-resource.pages.view-microsoft-tenant';

    use InteractsWithRecord;

    public function mount(int | string $record): void {
        $this->record = $this->resolveRecord($record);

    }

    protected function getHeaderActions(): array {
        return [
            Action::make('Get new access token'),
        ];
    }
}
