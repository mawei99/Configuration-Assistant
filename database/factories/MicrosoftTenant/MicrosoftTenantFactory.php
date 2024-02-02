<?php

namespace Database\Factories\MicrosoftTenant;

use Illuminate\Database\Eloquent\Factories\Factory;

class MicrosoftTenantFactory extends Factory
{
    public function definition(): array {
        return [
            'name' => 'Test Tenant',
            'tenant_id' => fake()->uuid(),
            'client_id' => fake()->uuid(),
            'secret_value' => 'testSecret',
        ];
    }
}
