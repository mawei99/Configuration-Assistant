<?php

namespace App\Models\MicrosoftTenant;

use App\Models\Configuration\Configuration;
use App\Models\Response;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MicrosoftTenant extends Model
{
    use HasFactory;

    private $response;
    private Configuration $configurationToImport;
    private $access_token;

    public function importConfiguration(Configuration $configuration): void {
        $this->configurationToImport = $configuration;
        $this->handleAccessTokenRequest();
        $this->handleImport();
    }

    private function handleAccessTokenRequest(): void {
        $this->response = Http::asForm()->post('https://login.microsoftonline.com/'. $this->tenant_id . '/oauth2/v2.0/token', [
            'client_id' => $this->client_id,
            'client_secret' => $this->secret_value,
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials'
        ]);

        $this->handleResponse();
        $this->access_token = $this->response->json('access_token');
    }

    public function handleImport(): void {
        $this->response = Http::withToken($this->access_token)
            ->post($this->configurationToImport?->configurationTemplate->url,
                $this->configurationToImport?->properties->pluck('value', 'key')->toArray());

        $this->handleResponse();
    }

    private function handleResponse() {
        $this->logResponse();
        $this->handleResponseCode();
    }

    private function logResponse() {
        if ($this->response->status() == 200) {
            return;
        }

        Response::create([
            'microsoft_Tenant_name' => $this->name,
            'user_name' => Auth::user()->name,
            'configuration_name' => $this->configurationToImport->name ?? null,
            'configuration_properties' => json_encode($this->configurationToImport->properties()->pluck('value', 'key')),
            'response_code' => $this->response->status(),
            'headers' => json_encode($this->response->headers()),
            'body' => $this->response->body(),
        ]);
    }

    private function handleResponseCode(): void {
        if ($this->response->status() == 201) {
            Notification::make()
                ->title('Import Successfully')
                ->success()
                ->send();
        } elseif ($this->response->status() == 401) {
            Notification::make()
                ->title('Access Token request failed!')
                ->danger()
                ->send();
        } elseif ($this->response->status() >= 400) {
           Notification::make()
               ->title('Something went wrong!')
               ->danger()
               ->send();
       }
    }
}
