<?php

namespace App\Services\D1Connector;

use App\Services\D1Connector\D1\D1Connection;
use Illuminate\Support\ServiceProvider;

class L1ServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerD1();
    }

    /**
     * Register the D1 service.
     *
     * @return void
     */
    protected function registerD1()
    {
        $this->app->resolving('db', function ($db) {
            $db->extend('d1', function ($config, $name) {
                $config['name'] = $name;

                $connection = new D1Connection(
                    new CloudflareD1Connector(
                        $config['database'],
                        $config['auth']['token'],
                        $config['auth']['account_id'],
                        $config['api'] ?? 'https://api.cloudflare.com/client/v4',
                    ),
                    $config,
                );

                return $connection;
            });
        });
    }
}
