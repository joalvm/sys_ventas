<?php

namespace App\Exceptions;

use App\Components\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param Request $request
     */
    public function render($request, Throwable $exception)
    {
        DB::rollBack();

        if ($exception instanceof ValidationException) {
            $exception->status(
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return Str::contains($request->getPathInfo(), '/api/')
            ? Response::catch($exception)
            : parent::render($request, $exception);
    }
}
