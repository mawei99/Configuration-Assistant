<?php

use App\Models\MicrosoftTenant\MicrosoftTenant;
use Illuminate\Support\Facades\Http;


it('checks for access token', function () {
    $microsoftTenant = MicrosoftTenant::factory()->state([
        'access_token' => null,
    ])->create();
    $this->assertFalse($microsoftTenant->accessTokenActive());

    $microsoftTenant->access_token = '1234';
    $this->assertTrue($microsoftTenant->accessTokenActive());
});

it('gets access token', function () {
    $microsoftTenant = MicrosoftTenant::factory()->create();

    Http::preventStrayRequests();
    Http::fake([
        'microsoftonline.com/*' => Http::response(['access_token' => '1234'], 200)
    ]);

    $microsoftTenant->renewAccessToken();
    $this->assertEquals('1234', MicrosoftTenant::first()->access_token);
});
