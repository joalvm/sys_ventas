<?php

namespace App\Contracts;

use App\Models\Persons;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface PersonsContract extends RepositoryContract
{
    /**
     * Obtiene el recurso completo Persons.
     */
    public function all(): Collection;

    /**
     * Crea un nuevo recurso Persons.
     */
    public function save(Request $request): Persons;
}
