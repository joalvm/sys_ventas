<?php

namespace App\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Rules
{
    /**
     * Contiene las reglas de validación.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Lista de reglas que serán excluidas.
     *
     * @var array
     */
    protected $except = [];

    /**
     * Lista de reglas que serán filtradas.
     *
     * @var array
     */
    protected $only = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Obtiene la lista de reglas.
     */
    public function get(): array
    {
        $attributes = $this->attributes;

        if (!empty($this->except)) {
            $attributes = Arr::except($attributes, $this->except);
        }

        if (!empty($this->only)) {
            $attributes = Arr::only($attributes, $this->only);
        }

        return $attributes;
    }

    /**
     * Agregar reglas de validacion a la lista.
     *
     * @return self
     */
    public function addRules(array $rules): Rules
    {
        foreach ($rules as $key => $rule) {
            if (!array_key_exists($key, $this->attributes)) {
                continue;
            }

            if (is_array($rule)) {
                foreach ($rule as $index => $validator) {
                    if (!\in_array($validator, $this->attributes[$key])) {
                        array_push($this->attributes[$key], $validator);
                    } else {
                        $this->attributes[$key][$index] = $validator;
                    }
                }
            }
        }

        return $this;
    }

    public function removeRules(array $rules): Rules
    {
        foreach ($rules as $key => $rule) {
            if (!array_key_exists($key, $this->attributes)) {
                continue;
            }

            if (is_array($rule)) {
                $this->attributes[$key] = array_diff(
                    $this->attributes[$key],
                    $rule
                );
            }
        }

        return $this;
    }

    /**
     * Une las reglas de validacion entre reglas.
     *
     * @return self
     */
    public function with(array $classes): Rules
    {
        foreach ($classes as $key => $class) {
            foreach ($this->getClassRules($class) as $innerKey => $rules) {
                $this->attributes[Str::snake($key) . '.' . $innerKey] = $rules;
            }
        }

        return $this;
    }

    /**
     * reglas a ser excluidas de la lista de atributos.
     *
     * @return self
     */
    public function except(array $rules): Rules
    {
        $this->except = $this->filterArray($rules);

        return $this;
    }

    /**
     * Reglas que serán buscadas en la lista de atributos.
     */
    public function only(array $rules)
    {
        $this->only = $this->filterArray($rules);

        return $this;
    }

    /**
     * Obtiene las reglas de una clase.
     */
    private function getClassRules(string $modelName): array
    {
        if (\class_exists($modelName)) {
            return (new $modelName())->rules()->get();
        }

        return [];
    }

    /**
     * Verifica que el array contiene valores.
     *
     * @param mixed $sarray
     */
    private function filterArray($sarray): array
    {
        return is_array($sarray) ? array_values($sarray) : [];
    }
}
