<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface PersonsContract extends RepositoryContract
{
    /**
     * Obtiene el recurso completo Persons.
     */
    public function all(): Collection;
}
