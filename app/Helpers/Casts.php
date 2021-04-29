<?php

use Illuminate\Support\Arr;

if (!function_exists('cast_int')) {
    /**
     * castea valores numericos, de tipo entero, de un objeto.
     *
     * @param array $row    Objeto a castear
     * @param array $fields Keys cuyos valores serán casteados (acepta notación DOT)
     *
     * @return void
     */
    function cast_int(array &$row, array $fields = [])
    {
        foreach ($fields as $field) {
            if (Arr::has($row, $field)) {
                Arr::set(
                    $row,
                    $field,
                    to_int(Arr::get($row, $field))
                );
            }
        }
    }
}

if (!function_exists('cast_bool')) {
    /**
     * castea valores numericos, de tipo entero, de un objeto.
     *
     * @param array $row    Objeto a castear
     * @param array $fields Keys cuyos valores serán casteados (acepta notación DOT)
     *
     * @return void
     */
    function cast_bool(array &$row, array $fields = [])
    {
        foreach ($fields as $field) {
            if (Arr::has($row, $field)) {
                Arr::set(
                    $row,
                    $field,
                    to_bool(Arr::get($row, $field))
                );
            }
        }
    }
}

if (!function_exists('cast_float')) {
    /**
     * castea valores numericos, de tipo flotante, de un objeto.
     *
     * @param array $row    Objeto a castear
     * @param array $fields Keys cuyos valores serán casteados (acepta notación DOT)
     *
     * @return void
     */
    function cast_float(array &$row, array $fields = [])
    {
        foreach ($fields as $field) {
            if (Arr::has($row, $field)) {
                Arr::set(
                    $row,
                    $field,
                    to_float(Arr::get($row, $field))
                );
            }
        }
    }
}

if (!function_exists('cast_json')) {
    /**
     * castea texto, de tipo json, de un objeto.
     *
     * @param array $row    Objeto a castear
     * @param array $fields Keys cuyos valores serán casteados (acepta notación DOT)
     *
     * @return void
     */
    function cast_json(array &$row, array $fields = [], bool $assoc = true)
    {
        foreach ($fields as $field) {
            if (Arr::has($row, $field)) {
                Arr::set(
                    $row,
                    $field,
                    json_decode(Arr::get($row, $field), $assoc)
                );
            }
        }
    }
}
