<?php

namespace App\Models\MicrosoftTenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicrosoftTenant extends Model
{
    use HasFactory;

    public function tokenStatusMessage(): string {
        if ($this->accessTokenActive()) {
            return 'The access Token is valid';
        }

        return 'The access token is not active';
    }

    private function accessTokenActive(): bool {
        return ! is_null($this->access_token);
    }

    public function renewAccessToken() {
        dd('WORKS');
    }

    public function importConfiguration() {

    }
}
