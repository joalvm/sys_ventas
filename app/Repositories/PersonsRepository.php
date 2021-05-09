<?php

namespace App\Repositories;

use stdClass;
use App\Contracts\PersonsContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

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

    public function builder(): Builder
    {
        return DB::table('persons', 'p')
            ->select($this->columns())
            ->whereNull('deleted_at');
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
