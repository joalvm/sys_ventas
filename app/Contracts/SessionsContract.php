<?php

namespace App\Contracts;

use App\Models\Sessions;

interface SessionsContract extends RepositoryContract
{
    /**
     * Autentifica al usuario e inicia su sesión.
     */
    public function login(
        string $username,
        string $password,
        bool $rememberMe
    ): Sessions;
}
