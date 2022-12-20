<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {

            // Api Not Found Routes
            if ($request->is('api/*')) {

                return response()->json([
                    'error' => true,
                    'status-code' => 404,
                    'error-code' => 'route-not-found',
                    'error-method' => $request->method(),
                    'error-route' => $request->path()
                ], 404);

            }

        });
    }

    // public function render(Request $request, Exception $e) {

    //     if ($e instanceof \Illuminate\Session\TokenMismatchException) {

    //         return redirect()
    //                 ->back()
    //                 ->withInput($request->except('password'))
    //                 ->with([
    //                     'message' => 'Validation Token was expired. Please try again',
    //                     'message-type' => 'danger']);
    //     }

    //     return parent::render($request, $e);

    // }

}
