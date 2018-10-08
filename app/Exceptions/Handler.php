<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

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
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        Log::info("handler");
        Log::info($exception->getMessage());

        switch ($exception->getMessage()) {
            case "Token has expired":
                return Response::json(array(
                    'code' => 500,
                    'message' => "Inicie sesion nuevamente."
                ), 500);
                break;
            case "Token not provided":
                return Response::json(array(
                    'code' => 500,
                    'message' => "Inicie sesion."
                ), 500);
                break;
            default:
                return Response::json(array(
                    'code' => 500,
                    'message' => "Ocurrió un error inesperado. Si el problema persiste comuníquese con el administrador."
                ), 500);
        }

        return parent::render($request, $exception);
    }
}
