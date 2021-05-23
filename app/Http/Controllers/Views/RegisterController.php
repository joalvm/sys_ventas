<?php

namespace App\Http\Controllers\Views;

use App\Contracts\PersonsContract;
use App\Contracts\UsersContract;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisterController extends ViewsController
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

    public function index(): View
    {
        return view('pages.register');
    }

    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();

        $rememberMe = to_bool($request->input('remember_me', false));

        $personModel = $this->personRepository->save($request);
        $usermodel = $this->userRepository
            ->setPersonId($personModel->id)
            ->save($request)
        ;

        $credentials = [
            'password' => $request->input('password'),
            'username' => $usermodel->username,
        ];

        DB::commit();

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
        }
    }
}
