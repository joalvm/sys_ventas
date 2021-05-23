<?php

namespace App\Contracts;

interface RepositoryContract
{
    /**
     * Establece el filtro por el usuario que ha realizado la petición.
     *
     * @return static
     */
    public function setUser(?int $userId);

    /**
     * Seatea el usuario al repositorio desde la configuración.
     */
    public function setUserFromConfig(): void;
}
