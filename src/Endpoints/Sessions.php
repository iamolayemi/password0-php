<?php

declare(strict_types=1);

namespace Iamolayemi\Password0\Endpoints;

final class Sessions extends BaseEndpoint
{
    /**
     * Get authenticated user from session JWT.
     *
     * @return array<mixed>
     */
    public function account(string $session_jwt): array
    {
        return $this->post('sessions/account', [
            'session_jwt' => $session_jwt,
        ]);
    }

    /**
     * Invalidate/Logout an authenticated user.
     *
     * @return array<mixed>
     */
    public function invalidate(string $session_jwt): array
    {
        return $this->post('sessions/invalidate', [
            'session_jwt' => $session_jwt,
        ]);
    }
}
