<?php

namespace App\Components\Request;

use App\Components\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Sort
{
    /**
     * Dependecia de la clase Fields que permite obtner
     * la lista de columnas que estan permitidas.
     *
     * @var Fields
     */
    protected $fields;

    /**
     * Los short=>order obtenidos.
     *
     * @var array
     */
    protected $values = [];

    public function __construct(Fields $fields)
    {
        $this->fields = $fields;

        $this->values = $this->init(
            to_array(Request::input('sort'))
        );
    }

    public function getValues()
    {
        return $this->filterValues();
    }

    protected function filterValues(): array
    {
        $values = [];

        foreach ($this->values as $field => $order) {
            if ($this->fields->exists($field)) {
                $nfield = $this->fields->getDefaults()[$field];

                $isObject = is_object($nfield) or \is_callable($nfield);

                array_push($values, (object) [
                    'column' => $isObject ? DB::raw("\"${field}\"") : $nfield,
                    'direction' => $order,
                    'is_object' => $isObject,
                ]);
            }
        }

        return $values;
    }

    public function run(Builder &$builder)
    {
        foreach ($this->filterValues() as $index => $order) {
            $builder->orderBy($order->column, $order->direction);
        }
    }

    /**
     * Inicia la captura de todos los ordenamientos.
     */
    protected function init(array $params)
    {
        $values = [];

        if (!is_assoc($params)) {
            return $values;
        }

        foreach ($params as $ikey => $value) {
            if (is_numeric($ikey)) {
                if (!is_string($value)) {
                    continue;
                }

                $parts = \explode(' ', trim($value));

                $values[$parts[0]] = $this->checkOrder($parts[1] ?? '');
            } elseif (is_string($ikey) and \is_string($value)) {
                if (!is_string($value)) {
                    continue;
                }

                $values[$ikey] = $this->checkOrder(trim($value));
            }
        }

        return $values;
    }

    private function checkOrder($order)
    {
        return in_array($this->toUpper($order), ['ASC', 'DESC'])
            ? ($this->toUpper($order))
            : 'DESC';
    }

    private function toUpper(string $text): string
    {
        return mb_strtoupper($text, 'utf-8');
    }
}
