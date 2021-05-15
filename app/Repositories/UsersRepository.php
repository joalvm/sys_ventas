<?php

namespace App\Repositories;

use App\Contracts\UsersContract;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersRepository extends Repository implements UsersContract
{
    /**
     * @var null|int
     */
    private $personId;

    public function save(Request $request): Users
    {
        $model = new Users($request->all());

        $model->setAttribute('person_id', $this->personId);

        $model->hashPassword()->validate()->save();

        // SE DEBE AGREGAR LA FUNCIONALIDAD DE VERIFICACIÓN DE EMAIL.

        return $model;
    }

    public function setPersonId($personId): self
    {
        $this->personId = to_int($personId);

        return $this;
    }
}
