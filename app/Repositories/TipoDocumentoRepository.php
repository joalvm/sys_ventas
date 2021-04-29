<?php

namespace App\Repositories;

use stdClass;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use App\Components\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Contracts\TipoDocumentoContract;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TipoDocumentoRepository extends Repository implements TipoDocumentoContract
{
    /**
     * @var string[]|null
     */
    private $operaciones;

    public function all(): Collection
    {
        return $this->builder()->get();
    }

    public function find(int $id): ?stdClass
    {
        return $this->builder()->where('td.id', $id)->first();
    }

    public function save(Request $request): TipoDocumento
    {
        $model = new TipoDocumento($request->all());

        $model->validate()->save();

        return $model;
    }

    public function update(int $id, Request $request): TipoDocumento
    {
        $model = TipoDocumento::find($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->fill($request->all())->validate()->update();

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = TipoDocumento::find($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model->delete();
    }

    public function builder(): Builder
    {
        return $this->filters(
            DB::table('tipo_documento', 'td')
            ->select([
                'id',
                'nombre',
                'operacion',
                'created_at',
                'updated_at',
            ])->whereNull('deleted_at')
        );
    }

    private function filters(Builder $builder): Builder
    {
        if ($this->operaciones) {
            $builder->whereIn('operacion', $this->operaciones);
        }

        return $builder;
    }

    public function setOperaciones($operaciones): self
    {
        $this->operaciones = array_filter(
            to_array_str($operaciones),
            function ($item) {
                return in_array($item, TipoDocumento::ALLOWED_OPERATION);
            }
        );

        return $this;
    }
}
