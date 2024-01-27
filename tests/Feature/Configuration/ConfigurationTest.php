
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

it('can list microsoft tenant', function () {
    $configurationTemplate = Configuration::factory()->count(10)->create();

    Livewire::test(ListConfigurations::class)
        ->assertCanSeeTableRecords($configurationTemplate);
});

it('can create microsoft tenant', function () {
    Livewire::test(ListConfigurations::class)
        ->mountAction('create')
        ->setActionData([
            'name' => 'test',
            'configuration_template_id' => ConfigurationTemplate::factory()->Create()->id
        ])->callMountedAction();

    $this->assertCount(1, Configuration::all());
});

it('can edit microsoft tenant', function () {
    $configurationTemplate = Configuration::factory()->state([
        'name' => 'Before-Editing'
    ])->create();

    Livewire::test(ListConfigurations::class)
        ->mountTableAction('edit', $configurationTemplate)
        ->setTableActionData([
            'name' => 'After-Editing',
        ])->callMountedTableAction();

    $this->assertEquals('After-Editing', Configuration::first()->name);
});

it('can delete microsoft tenant', function () {
    $configurationTemplate = Configuration::factory()->create();

    Livewire::test(ListConfigurations::class)
        ->mountTableAction('delete', $configurationTemplate)
        ->callMountedTableAction();

    $this->assertCount(0, Configuration::all());
});
