<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PersonsContract;
use Illuminate\Http\Request;

class PersonsController extends ApiController
{
    /**
     * @var PersonsContract
     */
    public $repository;

    public function __construct(PersonsContract $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        dd('index', $this->repository);
    }
}
