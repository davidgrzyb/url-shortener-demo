<?php

namespace App\Services\D1Connector\D1\Requests;

use App\Services\D1Connector\CloudflareRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

class D1QueryRequest extends CloudflareRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        $connector,
        protected string $database,
        protected string $sql,
        protected array $sqlParams,
    ) {
        parent::__construct($connector);
    }

    public function resolveEndpoint(): string
    {
        return sprintf(
            '/accounts/%s/d1/database/%s/query',
            $this->connector->accountId,
            $this->database,
        );
    }

    protected function defaultBody(): array
    {
        return [
            'sql' => $this->sql,
            'params' => $this->sqlParams,
        ];
    }
}
