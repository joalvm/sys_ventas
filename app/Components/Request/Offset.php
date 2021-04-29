<?php

namespace App\Components\Request;

use Illuminate\Support\Facades\Request;

class Offset
{
    const DEFAULT_VALUE = 0;

    protected $value = self::DEFAULT_VALUE;

    public function __construct()
    {
        $this->value = $this->init();
    }

    public function getValue()
    {
        return $this->value;
    }

    protected function init()
    {
        $os = Request::input('offset');

        return is_numeric($os)
            ? ((int) $os < 1 ? 1 : (int) $os)
            : (self::DEFAULT_VALUE);
    }
}
