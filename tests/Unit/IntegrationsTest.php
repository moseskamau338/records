<?php
use App\Services\Pipedream\PipedreamClient;

test('it retrieves integration credentials correctly', function () {
    // Assert that the default configuration is loaded
     // Manually register the service provider
    app()->register(\App\Providers\PipedreamServiceProvider::class);
    dd($this->app['config']);
    $config = config('services.pipedream');
    dd($config);
    expect($config)->toHaveKeys(['client_id', 'client_secret', 'project_id', 'environment']);

    // Resolve the PipedreamClient instance using the default config
    $pipedream = app(PipedreamClient::class);

    // Example user
    $testUser = '8381d036-f236-4cee-85f1-3e6eec987885/1';

    // Mock the Pipedream API responses for the test
    \Illuminate\Support\Facades\Http::fake([
        'https://api.pipedream.com/v1/oauth/token' => \Illuminate\Support\Facades\Http::response([
            'access_token' => 'test-access-token',
            'expires_in' => 3600,
        ], 200),
        'https://api.pipedream.com/v1/connect/' . $config['project_id'] . '/user/credentials' => \Illuminate\Support\Facades\Http::response([
            'id' => 'test-credential-id',
            'name' => 'Test Credential',
        ], 200),
    ]);

    // Call the method
    $credentials = $pipedream->getCredentials();

    // Assertions
    expect($credentials)->toHaveKeys(['id', 'name']);
    expect($credentials['id'])->toBe('test-credential-id');
});

todo('it lists all accounts connected to a user correctly');
todo('it shows folders in a connected app');
