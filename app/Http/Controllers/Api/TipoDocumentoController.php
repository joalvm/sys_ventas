<?php

namespace App\Http\Controllers\Api;

use App\Components\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\TipoDocumentoContract;

class TipoDocumentoController extends Controller
{
    /**
     * @var TipoDocumentoContract
     */
    private $repository;

    public function __construct(TipoDocumentoContract $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): Response
    {
        return Response::collection(
            $this->repository
                ->setOperaciones($request->get('operaciones'))
                ->all()
        );
    }

    public function store(Request $request)
    {
        return Response::created(
            $this->repository->find(
                $this->repository->save($request)->id
            )
        );
    }

    public function show(int $id)
    {
        return Response::item($this->repository->find($id));
    }

    public function update(int $id, Request $request)
    {
        return Response::updated(
            $this->repository->find(
                $this->repository->update($id, $request)->id
            )
        );
    }

    public function destroy($id)
    {
        return Response::deleted($this->repository->delete($id));
    }
}
