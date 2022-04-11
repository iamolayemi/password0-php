<?php

declare(strict_types=1);

namespace Iamolayemi\Password0\Contracts;

interface AuthenticationChannel
{
    public function via(string $channel): self;
}
