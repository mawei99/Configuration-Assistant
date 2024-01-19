<?php

use App\Models\User;

it('creates user', function () {
    $user = User::factory()->create();

    $this->assertCount(1, User::all());
});

it('deletes user', function () {
    $user = User::factory()->create();

    $user->delete();

    $this->assertCount(0, User::all());
});
