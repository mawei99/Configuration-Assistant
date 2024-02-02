<?php

use App\Filament\Resources\ConfigurationResource\Pages\ListConfigurations;
use App\Filament\Resources\ConfigurationTemplateResource;
use App\Models\Configuration\Configuration;
use App\Models\Configuration\ConfigurationTemplate;
use App\Models\User\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can render page', function () {
    $this->get(ConfigurationTemplateResource::getUrl('index'))->assertSuccessful();
});

it('can list configuration', function () {
    $configurationTemplate = Configuration::factory()->count(10)->create();

    Livewire::test(ListConfigurations::class)
        ->assertCanSeeTableRecords($configurationTemplate);
});

it('can create configuration', function () {
    Livewire::test(ListConfigurations::class)
        ->mountAction('create')
        ->setActionData([
        'name' => 'test',
        'configuration_template_id' => ConfigurationTemplate::factory()->Create()->id,
        'data' => ['properties' => [
            1 => ['name' => 'ABC',
                'type' => 'string',
                'value' => '123'],
            ]
        ]])
        ->callMountedAction()
    ->assertHasNoActionErrors();

    $this->assertCount(1, Configuration::all());
})->skip();

it('can edit configuration', function () {
    $configurationTemplate = Configuration::factory()->state([
        'name' => 'Before-Editing'
    ])->create();

    Livewire::test(ListConfigurations::class)
        ->mountTableAction('edit', $configurationTemplate)
        ->setTableActionData([
            'name' => 'After-Editing',
        ])->callMountedTableAction()
    ->assertHasNoTableActionErrors();

    $this->assertEquals('After-Editing', Configuration::first()->name);
});

it('can delete configuration', function () {
    $configurationTemplate = Configuration::factory()->create();

    Livewire::test(ListConfigurations::class)
        ->mountTableAction('delete', $configurationTemplate)
        ->callMountedTableAction();

    $this->assertCount(0, Configuration::all());
});
