<?php

use App\Filament\Resources\ResponseResource;
use App\Filament\Resources\ResponseResource\Pages\ListResponses;
use App\Models\Response;
use App\Models\User\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can render page', function () {
    $this->get(ResponseResource::getUrl('index'))->assertSuccessful();
});

it('can list responses', function () {
    Response::factory()->count(5)->create();

    Livewire::test(ListResponses::class)
        ->assertCanSeeTableRecords(Response::all());
});

it('can view response', function () {
    $response = Response::factory()->create();

    Livewire::test(ListResponses::class)
        ->mountTableAction('view', $response)
        ->callMountedTableAction()
        ->assertHasNoTableActionErrors();
});
