<?php

declare(strict_types=1);

namespace Iamolayemi\Password0\Endpoints;

use Iamolayemi\Password0\Exception\ClientException;
use Iamolayemi\Password0\Password0;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BaseEndpoint
{
    protected Password0 $password0;

    protected ResponseInterface $response;

    /**
     * Constructor.
     *
     * @throws ClientException
     */
    public function __construct(Password0 $password0)
    {
        $this->password0 = $password0;

        if ($this->password0->getClient() === null) {
            throw ClientException::connectionNotEstablished();
        }
    }

    /**
     * Make a http get request.
     *
     * @param array<mixed> $queryParams
     *
     * @return array<mixed>
     */
    protected function get(string $url, array $queryParams = []): array
    {
        $response = $this->client('GET', $url, [
            'query' => $queryParams,
        ]);

        return $response->toArray(false);
    }

    /**
     * Make a http post request.
     *
     * @param array<mixed> $bodyParams
     *
     * @return array<mixed>
     */
    protected function post(string $url, array $bodyParams = []): array
    {
        $bodyParams = json_encode($bodyParams, JSON_THROW_ON_ERROR);

        $response = $this->client('POST', $url, ['body' => $bodyParams]);

        return $response->toArray(false);
    }

    /**
     * Make a http patch request.
     *
     * @param array<mixed> $bodyParams
     *
     * @return array<mixed>
     */
    protected function patch(string $url, array $bodyParams = []): array
    {
        $bodyParams = json_encode($bodyParams, JSON_THROW_ON_ERROR);

        $response = $this->client('PATCH', $url, ['body' => $bodyParams]);

        return $response->toArray(false);
    }

    /**
     * Make a http delete request.
     *
     * @return array<mixed>
     */
    protected function delete(string $url): array
    {
        $response = $this->client('DELETE', $url);

        return $response->toArray(false);
    }

    private function client(string $method, string $url, array $payload = []): ResponseInterface
    {
        return $this->password0->getClient()->request($method, $url, $payload);
    }
}
