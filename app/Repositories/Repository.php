<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;

abstract class Repository implements RepositoryContract
{
    private $user;

    public function setUserFromConfig(): void
    {
        $this->user = 1;
    }

    public function setUser(?int $userId)
    {
        return $this;
    }
}
