<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // api: __DIR__ . '/../routes/api.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'api/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {
            if (!app()->environment(['local', 'testing']) && in_array($response->getStatusCode(), [500, 503, 404, 403])) {
                return Inertia::render('Errors/Index', ['status' => $response->getStatusCode()])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            } elseif ($response->getStatusCode() === 419) {
                return back()->with([
                    'message' => 'The page expired, please try again.',
                ]);
            }

            return $response;
        });

        $exceptions->render(function (NotFoundHttpException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Resource not found',
                    'errors' => $e->getMessage(),
                    'status' => 404
                ], 404);
            }
        });

        // Handle Model Not Found
        $exceptions->render(function (ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Resource not found',
                    'errors' => $e->getMessage(),
                    'status' => 404
                ], 404);
            }
        });

        // Handle Validation Exceptions
        $exceptions->render(function (ValidationException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $e->errors(),
                    'status' => 422
                ], 422);
            }
        });

        // Handle Authentication Exceptions
        $exceptions->render(function (AuthenticationException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'errors' => $e->getMessage(),
                    'status' => 401
                ], 401);
            }
        });

        // Handle Authorization Exceptions
        $exceptions->render(function (AuthorizationException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized action',
                    'errors' => $e->getMessage(),
                    'status' => 403
                ], 403);
            }
        });

        // Handle Method Not Allowed
        $exceptions->render(function (MethodNotAllowedHttpException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Method not allowed',
                    'errors' => $e->getMessage(),
                    'status' => 405
                ], 405);
            }
        });

        // Handle Database Errors
        $exceptions->render(function (QueryException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Database error occurred',
                    'errors' => $e->getMessage(),
                    'status' => 500
                ], 500);
            }
        });

        // Handle General Exceptions
        $exceptions->render(function (Throwable $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Server error',
                    'errors' => $e->getMessage(),
                    'status' => 500
                ], 500);
            }
        });
    })->create();
