<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelo=$exception->getModel();
            return $this->errorResponse('No existe el usuario solicitado', 404);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse('Sin permisos para ejecutar', 403);
        }

        if ($exception instanceof NotFoundHttpException) {
			dd($exception);
            return $this->errorResponse('No existe la urls', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('Metodo no permitido', 404);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $codigo=$exception->errorInfo[1];
            if ($codigo==1451) {
                return $this->errorResponse('No se puede eliminar este recurso pues esta relacionado con otros', 409);
            } else {
                return $this->errorResponse('Error de integridad', 409);
            }
        }

        if ($request->expectsJson()) {
            if (config('app.debug')) {
                return $this->errorResponse($request, $exception);
            } else {
                return $this->errorResponse('falla inseperada', 500);
            }

            //return response()->json(['error' => 'Unauthenticated.'], 401);
        }


        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->errorResponse('no autenticado', 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;

            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }

    /**
   * Create a response object from the given validation exception.
   *
   * @param  \Illuminate\Validation\ValidationException  $e
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

     //   return $this->errorResponse('no autenticado', 401);
        /*
              if ($e->response) {
                  return $e->response;
              }*/

        $errors=$e->validator->errors()->getMessages();
        if ($request->expectsJson()) {
            return $this->errorResponse($errors, 422);
        } else {
            return dd($errors);
            return $this->errorResponse($errors, 422);
        }
    }
}
