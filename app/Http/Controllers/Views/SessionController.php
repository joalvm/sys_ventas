<?php

namespace App\Http\Controllers\Views;

use App\Components\Errors;
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

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            Auth::login($usermodel, $rememberMe);
        }

        DB::commit();
    }

    public function login(): View
    {
        return view('pages.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $rememberMe = to_bool($request->input('remember-me', false));
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            // Auth::login($request->user(), $rememberMe);
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'username' => trans(Errors::WRONG_CREDENTIALS),
        ]);
    }
}
