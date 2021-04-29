<?php

namespace App\Components;

use Closure;
use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Arr;
use App\Traits\Schematizable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\JsonEncodingException;

class Item implements Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    use Schematizable;

    private $isPaginate = false;

    protected $item = [];

    /**
     * @var array
     */
    protected $schema = [];

    /**
     * @var Closure
     */
    private $casts = null;

    public function __construct($item, array $schema)
    {
        $this->item = $item;
        $this->schema = $schema;
    }

    /**
     * Obtiene el valor de un parametro del esquema item.
     *
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return Arr::get($this->toArray(), $key, $default);
    }

    public function toArray()
    {
        return (array) $this->schematize($this->item, $this->casts);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->item[] = $value;
        } else {
            $this->item[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->item[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->item[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->item[$offset]) ? $this->item[$offset] : null;
    }

    public function isEmpty()
    {
        return empty($this->item);
    }

    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Set the value of casts.
     */
    public function setCasts(?Closure $casts = null): self
    {
        $this->casts = $casts;

        return $this;
    }

    public function isPagination(): bool
    {
        return $this->isPaginate;
    }
}
