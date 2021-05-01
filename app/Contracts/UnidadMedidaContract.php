<?php

namespace App\Contracts;

use stdClass;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface UnidadMedidaContract extends RepositoryContract
{
    /**
     * Obtiene el listado completo de los recursos.
     */
    public function all(): Collection;

    /**
     * Obtiene un recurso UnidadMedida.
     */
    public function find(int $id): ?stdClass;

    /**
     * Crea un nuevo recurso UnidadMedida.
     */
    public function save(Request $request): UnidadMedida;

    /**
     * Edita un recurso UnidadMedida.
     */
    public function update(int $id, Request $request): UnidadMedida;

    /**
     * Elimina un recurso UnidadMedida.
     */
    public function delete(int $id): bool;
}
