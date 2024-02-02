<?php

use App\Models\Configuration\Configuration;
use App\Models\MicrosoftTenant\MicrosoftTenant;
use App\Models\User\User;
use Illuminate\Support\Facades\Http;

it('gets access token', function () {
    $this->actingAs(User::factory()->create());
    $microsoftTenant = MicrosoftTenant::factory()->create();

    Http::preventStrayRequests();
    Http::fake([
        'microsoftonline.com/*' => Http::response(['access_token' => '1234'], 200)
    ]);

    $microsoftTenant->importConfiguration(Configuration::factory()->create());
    $this->assertEquals('1234', MicrosoftTenant::first()->access_token);
})->skip();
