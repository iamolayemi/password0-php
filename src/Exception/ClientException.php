<?php

declare(strict_types=1);

namespace Iamolayemi\Password0\Exception;

use Exception;
use Throwable;

/**
 * @codeCoverageIgnore
 */
final class ClientException extends Exception implements BaseException
{
    public const MSG_INVALID_SECRET_KEY = 'The password sdk requires a secret key key to be provided at initialization';
    public const MSG_CONNECTION_NOT_ESTABLISHED = 'An error occurred while establishing a connection to password0 server.';
    public const MSG_CHANNEL_NOT_SUPPORTED = 'The provided authentication channel is not supported.';

    public static function invalidSecretKey(Throwable $previous = null): self
    {
        return new self(self::MSG_INVALID_SECRET_KEY, 0, $previous);
    }

    public static function connectionNotEstablished(Throwable $previous = null): self
    {
        return new self(self::MSG_CONNECTION_NOT_ESTABLISHED, 0, $previous);
    }

    public static function channelNotSupported(Throwable $previous = null): self
    {
        return new self(self::MSG_CHANNEL_NOT_SUPPORTED, 0, $previous);
    }
}
