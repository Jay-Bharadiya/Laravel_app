<?php

namespace App\Exceptions;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use App\Traits\ApiResponser;
use Asm89\Stack\CorsService;
use render;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    // public function handleException($request, Exception $exception)
    // {
    //     if ($exception instanceof ValidationException) {
    //         return $this->convertValidationExceptionToResponse($exception, $request);
    //     }

    //     if ($exception instanceof ModelNotFoundException) {
    //         $modelName = strtolower(class_basename($exception->getModel()));

    //         return $this->errorResponse("Does not exists any {$modelName} with the specified identificator", 404);
    //     }

    //     if ($exception instanceof AuthenticationException) {
    //         return $this->unauthenticated($request, $exception);
    //     }

    //     if ($exception instanceof AuthorizationException) {
    //         return $this->errorResponse($exception->getMessage(), 403);
    //     }

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse('The specified method for the request is invalid', 405);
    //     }

    //     if ($exception instanceof NotFoundHttpException) {
    //         return $this->errorResponse('The specified URL cannot be found', 404);
    //     }

    //     if ($exception instanceof HttpException) {
    //         return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
    //     }
    // }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function render($request, Throwable $exception)
    {

              if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

   if ($exception instanceof ModelNotFoundException) {
    $modelName = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("Does not exists any {$modelName} with the specified identificator", 404);

            }
  if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified URL cannot be found', 404);


            }
                   if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified method for the request is invalid', 405);
        }
            if ($exception instanceof HttpException) {
                        return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
                    }

}
protected function unauthenticated($request, AuthenticationException $exception)
    {

        return $this->errorResponse('Unauthenticated.', 401);
    }
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();



        return $this->errorResponse($errors, 422);
    }

    public function register()
    {
    //    $this->renderable(function (NotFoundHttpException $e, $request) {
    //         return $this->errorResponse('The specified URL cannot be found', 404);

    //     });
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
