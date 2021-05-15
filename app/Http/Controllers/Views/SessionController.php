<?php

namespace App\Http\Controllers\Views;

use App\Contracts\PersonsContract;
use App\Contracts\UsersContract;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SessionController extends ViewsController
{
    /**
     * @var PersonsContract
     */
    private $personRepository;

    /**
     * @var UsersContract
     */
    private $userRepository;

    public function __construct(
        PersonsContract $personRepository,
        UsersContract $userRepository
    ) {
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
    }

    public function register(): View
    {
        return view('pages.register');
    }

    public function createUser(RegisterRequest $request)
    {
        DB::beginTransaction();

        $personModel = $this->personRepository->save($request);
        $usermodel = $this->userRepository
            ->setPersonId($personModel->id)
            ->save($request)
        ;

        dd($personModel, $usermodel);
    }

    public function login(): View
    {
        return view('pages.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $rememberMe = $request->input('remember-me');
        $credentials = $request->only(['email', 'password']);

        $result = Auth::attempt($credentials, $rememberMe);

        dd($result);
    }
}
