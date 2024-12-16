<?php

use App\Models\Team;
use App\Models\User;

test('team members can access team projects', function () {
    $team = Team::factory()->create();
    $user = User::factory()->create(['team_id' => $team->id]);

    $this->actingAs($user)
        ->get('/teams/' . $team->id . '/projects')
        ->assertOk();
});

