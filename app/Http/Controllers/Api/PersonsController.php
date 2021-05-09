<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Contracts\PersonsContract;

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
