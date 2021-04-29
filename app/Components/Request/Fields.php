<?php

namespace App\Components\Request;

use App\Components\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Fields
{
    protected $values = [];
    protected $regexps = [];
    protected $filtered = [];
    protected $defaults = [];
    protected $filter = false;

    public function __construct(array $defaults, bool $filter = false)
    {
        $this->defaults = $defaults;
        $this->filter = $filter;

        $this->values = $this->init(to_array(Request::input('fields')));

        $this->generateMatches();

        if ($this->filter) {
            $this->initFilter();
        } else {
            $this->filtered = $this->defaults;
        }
    }

    public function getValues()
    {
        return $this->values;
    }

    public function exists(string $field): bool
    {
        return \array_key_exists($field, $this->defaults);
    }

    public function getFiltered()
    {
        return $this->filtered;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function run(Builder &$builder): void
    {
        $fs = empty($this->filtered) ? $this->defaults : $this->filtered;

        foreach ($fs as $key => $value) {
            if (\is_string($value) or $value instanceof \Illuminate\Database\Query\Expression) {
                $builder->addSelect(
                    Builder::isColumnAlias($value)
                        ? "${value} as ${key}"
                        : (DB::raw("${value} as \"${key}\"")
                    )
                );
            } else {
                $builder->selectSub($value, DB::raw("\"${key}\""));
            }
        }
    }

    protected function initFilter()
    {
        $this->filtered = array_filter(
            $this->defaults,
            function ($key) {
                foreach ($this->regexps as $index => $regex) {
                    if (\preg_match($regex, $key)) {
                        return true;
                    }
                }

                return false;
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    protected function init(array $httpParams, $preffix = '')
    {
        $params = [];

        foreach ($httpParams as $httpParam) {
            if (is_string($httpParam)) {
                \array_push(
                    $params,
                    Builder::setPreffix($preffix, $httpParam)
                );
            } elseif (is_array($httpParam)) {
                $key = \key($httpParam);
                $params = array_merge(
                    $params,
                    $this->init(
                        $httpParam[$key],
                        Builder::setPreffix($preffix, $key)
                    )
                );
            }
        }

        return $params;
    }

    /**
     * Gerar un array de expresiones regulares para field, la expresion
     * regular permite mantener la estructura separada por comas.
     */
    protected function generateMatches(): void
    {
        $this->regexps = \array_map(
            function ($key) {
                return '/^'.\str_replace('*', '(?:[a-z._]+)', $key).'/i';
            },
            $this->getValues()
        );
    }
}
