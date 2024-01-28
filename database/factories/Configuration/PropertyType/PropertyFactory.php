<?php

namespace Database\Factories\Configuration\PropertyType;

use App\Models\Configuration\Configuration;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array {
        return [
            'configuration_id' => Configuration::first() ?? Configuration::factory()->create(),
            'key' => 'test',
            'value' => 'something',
        ];
    }
}
