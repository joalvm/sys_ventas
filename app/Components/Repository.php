<?php

namespace App\Components;

abstract class Repository
{
    /**
     * Id del usuario que realiza la petición.
     *
     * @var int|null
     */
    protected $userId = null;

    public function __construct()
    {
        $this->setConfig();
    }

    public function setConfig()
    {
        $this->setUser(config('app.uid'));
    }

    public function setUser(?int $userId): void
    {
        $this->userId = to_int($userId);
    }
}
