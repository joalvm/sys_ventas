<?php

namespace App\Authentication;

use App\Models\Usuario;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as EloquentUserProvider;

class UserProvider implements EloquentUserProvider
{
    /**
     * @var Authenticatable
     */
    protected $user;

    /**
     * @param Usuario $user
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function retrieveById($identifier)
    {
        dd('retrieveById');
    }

    public function retrieveByToken($identifier, $token)
    {
        dd('retrieveByToken');
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        dd('updateRememberToken');
    }

    public function retrieveByCredentials(array $credentials)
    {
        dd('retrieveByCredentials');
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        dd('validateCredentials');
    }
}
