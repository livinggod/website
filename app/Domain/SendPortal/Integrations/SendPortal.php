<?php

namespace App\Domain\SendPortal\Integrations;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SendPortal
{
    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withToken(
            token: config('sendportal.api_key')
        )->baseUrl(
            url: $this->getBaseUrl()
        );
    }

    protected function getBaseUrl(): string
    {
        return $this->fallbackSlash(config('sendportal.url', ''));
    }

    protected function fallbackSlash(?string $item = null): string
    {
        return rtrim($item ?? '', '/').'/';
    }

    public function post(string $endpoint, array $data): array
    {
        return $this->client->post(
            url: $endpoint,
            data: $data
        )->throw()->json();
    }

    public function get(string $endpoint): array
    {
        return $this->client->get(
            url: $endpoint
        )->throw()->json();
    }
}
