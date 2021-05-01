<?php

namespace App\Repositories;

use stdClass;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use App\Components\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Contracts\UnidadMedidaContract;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UnidadMedidaRepository extends Repository implements UnidadMedidaContract
{
    public function all(): Collection
    {
        return $this->builder()->get();
    }

    public function find(int $id): ?stdClass
    {
        return $this->builder()->where('um.id', $id)->first();
    }

    public function save(Request $request): UnidadMedida
    {
        $model = new UnidadMedida($request->all());

        $model->validate()->save();

        return $model;
    }

    public function update(int $id, Request $request): UnidadMedida
    {
        /** @var UnidadMedida $model */
        $model = UnidadMedida::find($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->fill($request->all());

        $model->validate()->update();

        return $model;
    }

    public function delete(int $id): bool
    {
        /** @var UnidadMedida $model */
        $model = UnidadMedida::find($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model->delete();
    }

    public function builder(): Builder
    {
        return DB::table('unidad_medida', 'um')
            ->select('id', 'nombre', 'prefijo', 'created_at', 'updated_at')
            ->whereNull('deleted_at');
    }
}
