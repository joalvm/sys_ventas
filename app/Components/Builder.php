<?php

namespace App\Components;

use Closure;
use App\Components\Request\Sort;
use App\Components\Request\Dates;
use App\Components\Request\Limit;
use App\Components\Request\Fields;
use App\Components\Request\Offset;
use App\Components\Request\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
    /**
     * @var Closure|null
     */
    private $filters = null;

    /**
     * @var Closure|null
     */
    private $casts = null;

    /**
     * Indica si builder devuelve los datos paginados default: true.
     *
     * @var bool
     */
    private $pagination = true;

    /**
     * Indica si el builder acepta filtros personalizados.
     *
     * @var bool
     */
    private $filtered = true;

    protected $filterColumn = true;
    protected $sercheable = true;
    protected $filterClient = true;
    protected $timestamps = [];

    protected $attributes = [
        'columns' => [],
        'from' => [],
    ];

    public function __construct(?ConnectionInterface $connection = null)
    {
        parent::__construct($connection ?? DB::connection());

        $this->pagination = to_bool(request()->get('paginate', true));
        $this->casts = null;
    }

    public static function table(string $table, string $as = null): self
    {
        return (new static())->from($table, $as);
    }

    public function from($tableName, $as = null)
    {
        list($table, $alias) = $this->resolveTableAlias($tableName);

        if ($as) {
            $alias = $as;
        }

        $this->attributes['from'] = [$table, $alias];

        $this->from = "${table} AS ${alias}";

        return $this;
    }

    public function schema($columns = ['*'], bool $filterColumn = true)
    {
        $this->filterColumn = $filterColumn;
        $this->attributes['columns'] = $this->resolveSchema(
            $columns,
            '',
            $this->attributes['from'][1] ?? ''
        );

        return $this;
    }

    public function collection(): Collection
    {
        $limit = (new Limit())->getValue();
        $offset = (new Offset())->getValue();

        $this->initQuery();

        return (
            new Collection(
                $this->pagination
                    ? $this->paginate($limit, ['*'], 'offset', $offset)
                    : $this->get(),
                array_keys($this->attributes['columns'])
            )
        )->setCasts($this->casts);
    }

    public function item()
    {
        $this->initQuery();

        $this->limit(1);

        return (
            new Item(
                $this->first(),
                array_keys($this->attributes['columns'])
            )
        )->setCasts($this->casts);
    }

    public function handleTimestamp(string $column, ?string $columnTZ = null): self
    {
        $this->timestamps = [$column, $columnTZ];

        return $this;
    }

    private function resolveTableAlias(string $tableName): array
    {
        $tableName = \str_replace(' as ', ' AS ', $tableName);

        return (2 == count($parts = explode(' AS ', $tableName)))
            ? $parts
            : (
                2 == count($parts = explode(' ', $tableName))
                    ? $parts
                    : [$tableName, $tableName]
            );
    }

    private function resolveSchema(array $fields, string $preffix = '', string $aliasTable = '')
    {
        $nfields = [];

        foreach ($fields as $aliasColumn => $field) {
            $params = [
                'field' => $field,
                'preffix' => $preffix,
                'aliasTable' => $aliasTable,
                'aliasColumn' => $aliasColumn,
            ];

            if (is_string($field)) {
                $pfield = explode('.', $field);
                if (2 === count($pfield)) {
                    $params['aliasTable'] = $pfield[0];
                    $params['field'] = $pfield[1];
                }
            }

            if (is_numeric($aliasColumn)) {
                $nfields = \array_merge(
                    $nfields,
                    $this->resolveField($params)
                );
            } elseif (\is_string($aliasColumn)) {
                if (\is_array($field)) {
                    $parts = \explode(':', $aliasColumn);
                    $ast = '';

                    if (2 == count($parts)) {
                        $parts = array_map('trim', $parts);
                        if (false !== \strpos($parts[1], '.*')) {
                            $parts[1] = \str_replace('.*', '', $parts[0]);
                            $ast = '.*';
                        }
                    }

                    $nfields = \array_merge(
                        $nfields,
                        $this->resolveSchema(
                            $field,
                            self::setPreffix($preffix, $parts[0] . $ast),
                            2 == count($parts) ? $parts[1] : $aliasTable
                        )
                    );
                } else {
                    $nfields = \array_merge(
                        $nfields,
                        $this->resolveField($params)
                    );
                }
            }
        }

        return $nfields;
    }

    public static function setPreffix(?string $preffix, string $value): string
    {
        return (!empty($preffix) ? "${preffix}." : '') . $value;
    }

    public static function isColumnAlias($ColumnAlias): bool
    {
        return \preg_match(
            "/^(([a-zA-Z])(\w+)?\.)?([a-zA-Z]\w+|_)$/i",
            $ColumnAlias
        );
    }

    private function resolveField(array $params)
    {
        $key = '';
        $value = '';

        $field = is_string($params['field']) ? trim($params['field']) : $params['field'];

        if ($field instanceof \Illuminate\Database\Query\Expression or \is_callable($field)) {
            $key = self::setPreffix($params['preffix'], $params['aliasColumn']);
            $value = $field;
        } elseif (\is_string($field)) {
            if (self::isColumnAlias($field)) {
                $key = self::setPreffix(
                    $params['preffix'],
                    !is_numeric($params['aliasColumn'])
                        ? $params['aliasColumn']
                        : $field
                );

                $value = self::setPreffix($params['aliasTable'], $field);
            } else {
                $key = self::setPreffix($params['preffix'], $params['aliasColumn']);
                $value = DB::raw("(${field})");
            }
        }

        return [$key => $value];
    }

    private function initQuery()
    {
        $fields = new Fields($this->attributes['columns'], $this->filterColumn);

        $fields->run($this);

        (new Sort($fields))->run($this);
        (new Search($fields))->run($this);

        if ($this->timestamps) {
            (new Dates($this->timestamps[0], $this->timestamps[1]))->run($this);
        }

        if ($this->filters) {
            $callback = $this->filters;
            $callback($this);
        }
    }

    public function setFilters(Closure $callback): self
    {
        $this->filters = $callback;

        return $this;
    }

    public function setCasts(Closure $callback): self
    {
        $this->casts = $callback;

        return $this;
    }

    public function disablePagination()
    {
        $this->pagination = false;

        return $this;
    }

    private function disableFiltered()
    {
        $this->filtered = false;

        return $this;
    }
}
