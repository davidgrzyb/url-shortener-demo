<?php

namespace App\Services\D1Connector;

use App\Services\D1Connector\D1\Requests\D1QueryRequest;
use Saloon\Http\Response;

class CloudflareD1Connector extends CloudflareConnector
{
    public function __construct(
        public ?string $database = null,
        protected ?string $token = null,
        public ?string $accountId = null,
        public string $apiUrl = 'https://api.cloudflare.com/client/v4',
    ) {
        parent::__construct($token, $accountId, $apiUrl);
    }

    public function databaseQuery(string $query, array $params): Response
    {
        return $this->send(
            new D1QueryRequest($this, $this->database, $query, $params),
        );
    }
}
