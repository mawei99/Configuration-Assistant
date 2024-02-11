<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class ResponseFactory extends Factory
{
    public function definition(): array {
        return [
            'microsoft_Tenant_name' => 'test-tenant',
            'user_name' => Auth::user()->name,
            'configuration_name' => 'test-configuration',
            'configuration_properties' => 'test',
            'response_code' => '201',
            'headers' => 'headers',
            'body' => 'body',
        ];
    }
}
