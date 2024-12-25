<?php

namespace App\Jobs;

use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreateTenantAdmin implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Tenant $tenant)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function ($tenant) {
            //create team
            $team = Team::create(["name" => $tenant->name . "'s team"]);
            //create user
            $user = User::create([
                'name' => $tenant->name,
                'email' => $tenant->email,
                'password' => $tenant->password,
            ]);
            $team->members()->attach($user->id);
            $user->current_team_id = $team->id;
            $user->save();
        });
    }
}
