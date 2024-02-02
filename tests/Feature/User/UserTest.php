<?php

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can render page', function () {
    $this->get(UserResource::getUrl('index'))->assertSuccessful();
});

it('can list user', function () {
    Livewire::test(ListUsers::class)
        ->assertCanSeeTableRecords(User::all());
});

it('can create user', function () {
    Livewire::test(ListUsers::class)
        ->mountAction('create')
        ->setActionData([
            'name' => 'Test-User',
            'email' => fake()->email(),
            'password' => '1234',
        ])->callMountedAction()
        ->assertHasNoActionErrors();

    $this->assertCount(2, User::all());
});

it('can edit user', function () {
    $user = User::factory()->state([
        'name' => 'Before-Editing'
    ])->create();

    Livewire::test(ListUsers::class)
        ->mountTableAction('edit', $user)
        ->setTableActionData([
            'name' => 'After-Editing',
            'password' => '1234'
        ])->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertEquals('After-Editing', User::find($user->id)->name);
});

it('can delete configuration template', function () {
    $user = User::factory()->create();

    Livewire::test(ListUsers::class)
        ->mountTableAction('delete', $user)
        ->callMountedTableAction();

    $this->assertCount(1, User::all());
});
