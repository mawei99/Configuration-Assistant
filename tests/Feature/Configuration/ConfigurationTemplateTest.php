<?php

use App\Filament\Resources\ConfigurationTemplateResource;
use App\Filament\Resources\ConfigurationTemplateResource\Pages\ListConfigurationTemplates;
use App\Models\Configuration\ConfigurationTemplate;
use App\Models\User\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can render page', function () {
    $this->get(ConfigurationTemplateResource::getUrl('index'))->assertSuccessful();
});

it('can list configuration template', function () {
    $configurationTemplate = ConfigurationTemplate::factory()->count(10)->create();

    Livewire::test(ListConfigurationTemplates::class)
        ->assertCanSeeTableRecords($configurationTemplate);
});

it('can create configuration template', function () {
    Livewire::test(ListConfigurationTemplates::class)
        ->mountAction('create')
        ->setActionData([
            'name' => 'test',
            'url' => 'https://test.de/api/v1',
        ])->callMountedAction()
        ->assertHasNoActionErrors();

    $this->assertCount(1, ConfigurationTemplate::all());
});

it('can edit configuration template', function () {
    $configurationTemplate = ConfigurationTemplate::factory()->state([
        'name' => 'Before-Editing'
    ])->create();

    Livewire::test(ListConfigurationTemplates::class)
        ->mountTableAction('edit', $configurationTemplate)
        ->setTableActionData([
            'name' => 'After-Editing',
        ])->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertEquals('After-Editing', ConfigurationTemplate::first()->name);
});

it('can delete configuration template', function () {
    $configurationTemplate = ConfigurationTemplate::factory()->create();

    Livewire::test(ListConfigurationTemplates::class)
        ->mountTableAction('delete', $configurationTemplate)
        ->callMountedTableAction();

    $this->assertCount(0, ConfigurationTemplate::all());
});
