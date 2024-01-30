<?php

namespace App\Models\MicrosoftTenant;

use App\Models\Configuration\Configuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class MicrosoftTenant extends Model
{
    use HasFactory;

    public function tokenStatusMessage(): string {
        if ($this->accessTokenActive()) {
            return 'The current access Token is valid';
        }

        return 'The access token is not active';
    }

    public function accessTokenActive(): bool {
        return ! is_null($this->access_token);
    }

    public function renewAccessToken() {
        $response = Http::asForm()->post('https://login.microsoftonline.com/'. $this->tenant_id . '/oauth2/v2.0/token', [
            'client_id' => $this->client_id,
            'client_secret' => $this->secret_value,
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials'
        ]);

        $this->access_token = $response->json('access_token');
        $this->save();
    }

    public function importConfiguration(): void {
        $configuration = Configuration::find(2);

        Http::withToken($this->access_token)
            ->post($configuration->configurationTemplate->url,
                $configuration->properties->pluck('value', 'key')->toArray());
    }
}
