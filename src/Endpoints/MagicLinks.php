<?php

declare(strict_types=1);

namespace Iamolayemi\Password0\Endpoints;

use Iamolayemi\Password0\Contracts\AuthenticationChannel;
use Iamolayemi\Password0\Exception\ClientException;

final class MagicLinks extends BaseEndpoint implements AuthenticationChannel
{
    /**
     * @var array|string[]
     */
    protected array $supportedChannels = ['email', 'sms', 'whatsapp'];

    protected string $channel = 'email';

    /**
     * Set the channel to be used for authentication.
     *
     * @throws ClientException
     */
    public function via(string $channel): self
    {
        if (!in_array($channel, $this->supportedChannels)) {
            throw ClientException::channelNotSupported();
        }
        $this->channel = $channel;

        return $this;
    }

    /**
     * Create a new magic link token.
     *
     * @param array<mixed> $payload
     *
     * @return array<mixed>
     */
    public function create(array $payload = []): array
    {
        return $this->post('magic_links/' . $this->channel . '/create', $payload);
    }

    /**
     * Send a new magic link token.
     *
     * @param array<mixed> $payload
     *
     * @return array<mixed>
     */
    public function send(array $payload = []): array
    {
        return $this->post('magic_links/' . $this->channel . '/send', $payload);
    }

    /**
     * Authenticate a user via a magic link token.
     *
     * @param array<mixed> $payload
     *
     * @return array<mixed>
     */
    public function authenticate(array $payload = []): array
    {
        return $this->post('magic_links/' . $this->channel . '/authenticate', $payload);
    }
}
