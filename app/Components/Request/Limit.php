<?php

namespace App\Components\Request;

use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Request;

class Limit
{
    const DEFAULT_VALUE = 25;
    const MAX_ROWS = 100;

    protected $value = self::DEFAULT_VALUE;

    public function __construct()
    {
        $this->value = $this->init();

        if ($this->value > self::MAX_ROWS) {
            throw new BadRequestException(\trans('exception.limit_rows'));
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    protected function init()
    {
        $os = Request::input('limit');

        return is_numeric($os)
            ? ((int) $os < 1 ? (self::DEFAULT_VALUE) : (int) $os)
            : self::DEFAULT_VALUE;
    }
}
