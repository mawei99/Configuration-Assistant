<?php

namespace Database\Factories\Configuration;

use App\Models\Configuration\ConfigurationTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigurationFactory extends Factory
{
    public function definition(): array {
        return [
            'name' => 'Test Configuration',
            'configuration_template_id' => ConfigurationTemplate::factory()->create()->id,
        ];
    }
}
