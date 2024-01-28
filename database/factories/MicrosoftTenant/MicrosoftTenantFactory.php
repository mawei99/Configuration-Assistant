<?php

namespace Database\Factories\MicrosoftTenant;

use Illuminate\Database\Eloquent\Factories\Factory;

class MicrosoftTenantFactory extends Factory
{
    public function definition(): array {
        return [
            'name' => 'Test Tenant',
            'tenant_id' => 1234,
            'client_id' => 4567,
            'secret_value' => 8910,
        ];
    }
}
