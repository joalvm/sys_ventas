<?php

namespace App\Http\Controllers\Api;

use App\Components\Response;
use Illuminate\Http\Request;
use App\Components\Controller;
use App\Contracts\UnidadMedidaContract;

class UnidadMedidaController extends Controller
{
    /**
     * @var UnidadMedidaContract
     */
    private $repository;

    public function __construct(UnidadMedidaContract $repository)
    {
        $this->repository = $repository;
    }

    public function index(): Response
    {
        return Response::collection(
            $this->repository->all()
        );
    }

    public function store(Request $request): Response
    {
        return Response::created(
            $this->repository->find(
                $this->repository->save($request)->id
            )
        );
    }

    public function show(int $id): Response
    {
        return Response::item($this->repository->find($id));
    }

    public function update(int $id, Request $request): Response
    {
        return Response::updated(
            $this->repository->find(
                $this->repository->update($id, $request)->id
            )
        );
    }

    public function destroy(int $id)
    {
        return Response::deleted($this->repository->delete($id));
    }
}
