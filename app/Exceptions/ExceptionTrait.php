<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{

     public function apiExceptions($request, $exception)
     {
        if($exception instanceof ModelNotFoundException) {
            return response()->json(
                [
                'error' => 'model not found'
                ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(
                [
                'error' => 'Bad URL'
                ], Response::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $exception);
         
     }
}