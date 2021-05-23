<?php

namespace App\Contracts;

use App\Models\Users;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

interface UsersContract extends RepositoryContract
{
    /**
     * Crea un nuevo recurso Users.
     */
    public function save(Request $request): Users;

    /**
     * Establece el filtro por Id de Persona.
     *
     * @param null|int $personId
     */
    public function setPersonId($personId): UsersRepository;
}
