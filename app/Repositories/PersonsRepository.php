<?php

namespace App\Repositories;

use App\Contracts\PersonsContract;
use App\Models\Persons;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class PersonsRepository extends Repository implements PersonsContract
{
    public function all(): Collection
    {
        return $this->builder()->get();
    }

    public function find(int $id): ?stdClass
    {
        return $this->builder()->where('p.id', $id)->first();
    }

    public function save(Request $request): Persons
    {
        $model = new Persons($request->all());

        $model->validate()->save();

        return $model;
    }

    public function builder(): Builder
    {
        return DB::table('persons', 'p')
            ->select($this->columns())
            ->whereNull('deleted_at')
        ;
    }

    public function columns(): array
    {
        return [
            'id',
            'name',
            'lastname',
            'gender',
            'email',
            'phone',
            'avatar_url',
            'created_at',
            'updated_at',
        ];
    }
}
