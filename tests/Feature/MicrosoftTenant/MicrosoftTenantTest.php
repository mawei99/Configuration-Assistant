<?php

use App\Filament\Resources\MicrosoftTenantResource\Pages\ListMicrosoftTenants;
use App\Models\Configuration\Configuration;
use App\Models\Response;
use App\Models\User\User;
use App\Models\MicrosoftTenant\MicrosoftTenant;
use App\Filament\Resources\MicrosoftTenantResource;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can render page', function () {
    $this->get(MicrosoftTenantResource::getUrl('index'))->assertSuccessful();
});

it('can list microsoft tenant', function () {
    $microsoftTenant = MicrosoftTenant::factory()->count(10)->create();

    Livewire::test(MicrosoftTenantResource\Pages\ListMicrosoftTenants::class)
        ->assertCanSeeTableRecords($microsoftTenant);
});

it('can create microsoft tenant', function () {
    Livewire::test(ListMicrosoftTenants::class)
        ->mountAction('create')
        ->setActionData([
            'name' => 'test',
            'tenant_id' => fake()->uuid(),
            'client_id' => fake()->uuid(),
            'secret_value' => 'secretetst',
        ])->callMountedAction()
        ->assertHasNoActionErrors();

    $this->assertCount(1, MicrosoftTenant::all());
});

it('can edit microsoft tenant', function () {
    $microsoftTenant = MicrosoftTenant::factory()->state([
        'name' => 'Before-Editing'
    ])->create();

    Livewire::test(ListMicrosoftTenants::class)
        ->mountTableAction('edit', $microsoftTenant)
        ->setTableActionData([
            'name' => 'After-Editing',
        ])->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertEquals('After-Editing', MicrosoftTenant::first()->name);
});

it('can delete microsoft tenant', function () {
    $microsoftTenant = MicrosoftTenant::factory()->create();

    Livewire::test(ListMicrosoftTenants::class)
        ->mountTableAction('delete', $microsoftTenant)
        ->callMountedTableAction();

    $this->assertCount(0, MicrosoftTenant::all());
});

it('can push configuration', function () {
    $microsoftTenant = MicrosoftTenant::factory()->create();
    $configuration = Configuration::factory()->create();

    Http::preventStrayRequests();
    Http::fake([
        'microsoftonline.com/*' => Http::response(['access_token' => '1234'], 200)
    ]);
    Http::fake([
        'https://test.de/api/*' => Http::response()
    ]);

    Livewire::test(ListMicrosoftTenants::class)
        ->mountTableAction('Import configuration', $microsoftTenant)
        ->setTableActionData([
            'configuration' => $configuration->id,
        ])
        ->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertCount(2, Response::all());
});
