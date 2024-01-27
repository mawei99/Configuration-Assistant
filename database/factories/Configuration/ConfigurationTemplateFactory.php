<?php

namespace Database\Factories\Configuration;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigurationTemplateFactory extends Factory
{
    public function definition(): array {
        return [
            'name' => 'Test Configuration Template',
            'url' => 'test.de/api/v1'
        ];
    }
}
