<?php

use App\Filament\Resources\MicrosoftTenantResource\Pages\ListMicrosoftTenants;
use App\Models\User\User;
use App\Models\MicrosoftTenant\MicrosoftTenant;
use App\Filament\Resources\MicrosoftTenantResource;
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
            'tenant_id' => 123,
            'application_id' => 456,
            'secret' => 789,
        ])->callMountedAction();

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
        ])->callMountedTableAction();

    $this->assertEquals('After-Editing', MicrosoftTenant::first()->name);
});

it('can delete microsoft tenant', function () {
    $microsoftTenant = MicrosoftTenant::factory()->create();

    Livewire::test(ListMicrosoftTenants::class)
        ->mountTableAction('delete', $microsoftTenant)
        ->callMountedTableAction();

    $this->assertCount(0, MicrosoftTenant::all());
});
