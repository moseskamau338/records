<?php

namespace App\Services;

use \League\Flysystem\Filesystem;
use \League\Flysystem\Config;
use \League\Flysystem\Visibility;
class GoogleDriveService
{
    protected Filesystem $client;
    public function __construct(array $config){
        $client = new \Google\Client();
        $client->setClientId($config['clientId']);
        $client->setClientSecret($config['clientSecret']);
        $client->refreshToken($config['refreshToken']);
        $client->setApplicationName(env('APP_NAME'));

        $service = new \Google\Service\Drive($client);
        $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service);

        $this->client = new Filesystem($adapter, (array)new Config([Config::OPTION_VISIBILITY => Visibility::PRIVATE]));
    }

    /**
     * @return Filesystem
     */
    public function getClient(): Filesystem
    {
        return $this->client;
    }
}
