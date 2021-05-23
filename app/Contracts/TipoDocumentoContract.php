<?php

namespace App\Contracts;

use App\Models\TipoDocumento;
use App\Repositories\TipoDocumentoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

interface TipoDocumentoContract extends RepositoryContract
{
    /**
     * Obtiene el listado completo de los recursos.
     */
    public function all(): Collection;

    /**
     * Obtiene un recurso TipoDocumento.
     */
    public function find(int $id): ?stdClass;

    /**
     * Crea un nuevo recurso TipoDocumento.
     */
    public function save(Request $request): TipoDocumento;

    /**
     * Edita un recurso TipoDocumento.
     */
    public function update(int $id, Request $request): TipoDocumento;

    /**
     * Elimina un recurso TipoDocumento.
     */
    public function delete(int $id): bool;

    /**
     * Establece el filtro por el campo operaciones.
     *
     * @param null|string[] $operaciones
     */
    public function setOperaciones($operaciones): TipoDocumentoRepository;
}
