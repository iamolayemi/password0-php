<?php

declare(strict_types=1);

namespace Iamolayemi\Password0;

use Iamolayemi\Password0\Endpoints\MagicLinks;
use Iamolayemi\Password0\Endpoints\PassCodes;
use Iamolayemi\Password0\Endpoints\Sessions;
use Iamolayemi\Password0\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Password0
{
    private string $baseUrl = 'https://api.password0.com/v1/';

    private ?HttpClientInterface $client = null;


    /**
     * Password0 Constructor.
     *
     * @param  string  $secretKey
     *
     * @throws ClientException
     */
    public function __construct(protected string $secretKey)
    {
        if ($this->secretKey === '') {
            throw ClientException::invalidSecretKey();
        }
        $this->connect();
    }

    /**
     * Create base connection to password API server.
     */
    private function connect(): void
    {
        $this->client = HttpClient::createForBaseUri($this->baseUrl, [
            'auth_bearer' => $this->secretKey,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Get password0 api client.
     *
     * @return ?HttpClientInterface
     */
    public function getClient(): ?HttpClientInterface
    {
        return $this->client;
    }

    /**
     * Set password0 api client.
     */
    public function setClient(HttpClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * Get password0 api base user.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Create a new instance to authentication via magic links.
     *
     * @throws ClientException
     */
    public function magicLinks(): MagicLinks
    {
        return new MagicLinks($this);
    }


    /**
     * Create a new instance to authentication via passcodes.
     *
     * @throws ClientException
     */
    public function passCodes(): PassCodes
    {
        return new PassCodes($this);
    }

    /**
     * Create a new instance to session management.
     *
     */
    public function sessions(): Sessions
    {
        return new Sessions($this);
    }
}
