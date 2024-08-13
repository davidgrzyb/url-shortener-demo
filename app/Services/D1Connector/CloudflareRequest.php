<?php

namespace App\Services\D1Connector;

use Illuminate\Database\Connectors\Connector;
use Saloon\Http\Request;

abstract class CloudflareRequest extends Request
{
    protected CloudflareConnector $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    protected function resolveConnector(): Connector
    {
        return $this->connector;
    }
}
