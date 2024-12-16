<?php

use App\Models\Tenant;
use App\Models\User;


it('creates a tenant', function () {
    $tenant = Tenant::create(['plan' => 'monthly']);
    expect($tenant)->not()->toBeNull();
});

it('creates a user inside the tenant DB', function () {
    $tenant = Tenant::create(['plan' => 'monthly']);
    $tenant->run(function () use ($tenant) {
       $user = User::factory()->create(['tenant_id' => $tenant->id]);
        expect($user)->not()->toBeNull();
    });
});

it('creates a new domain for the tenant and it works!', function () {
    $tenant = Tenant::create(['plan' => 'monthly']);
    $tenant->domains()->create(['domain' => 'acme.records.test']);
    expect($tenant->domains()->first()->domain)->toBe('acme.records.test');
    $this->get('acme.records.test')->assertStatus(200);
});

