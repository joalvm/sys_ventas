<?php

namespace App\Components;

use Closure;
use Illuminate\Support\Arr;
use App\Traits\Schematizable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    use Schematizable;

    /**
     * Contiene la estructura para cada item de la colección.
     *
     * @var array
     */
    protected $schema = [];

    /**
     * @var Closure|null
     */
    protected $casts = null;

    /**
     * @var bool
     */
    private $isPaginate = false;

    /**
     * @var Collection
     */
    private $paginate = null;

    /**
     * @param BaseCollection|LengthAwarePaginator $items
     */
    public function __construct($items, array $schema = [])
    {
        $this->schema = $schema;

        $this->isPaginate = $items instanceof LengthAwarePaginator;

        parent::__construct(
            $this->isPaginate
                ? $items->items()
                : (is_array($items) ? $items : $items->items)
        );

        if ($this->isPaginate) {
            $this->paginate = $items->setCollection(collect());
        }
    }

    public function all()
    {
        return $this->isPaginate
            ? Arr::except(
                $this->paginate->setCollection(
                    collect($this->getAll(parent::all()))
                )->toArray(),
                ['links']
            )
            : $this->getAll(parent::all());
    }

    public function first(callable $callback = null, $default = null)
    {
        return $this->schematize(
            Arr::first($this->items, $callback, $default),
            $this->casts
        );
    }

    public function each(callable $callback): self
    {
        foreach ($this->items as $key => &$item) {
            $callback($item, $key);
        }

        return $this;
    }

    /**
     * Set the value of casts.
     *
     * @param Closure|null $casts
     *
     * @return self
     */
    public function setCasts($casts)
    {
        $this->casts = $casts;

        return $this;
    }

    private function getAll(array $items): array
    {
        return array_map(function ($item) {
            return $this->schematize($item, $this->casts);
        }, $items);
    }

    public function isPagination(): bool
    {
        return $this->isPaginate;
    }
}
