<?php

namespace App\Contracts;

interface RepositoryContract
{
    /**
     * Establece el filtro por el usuario que ha realizado la petición.
     */
    public function setUser(?int $userId): void;
}
