<?php

use App\Helpers\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        if (config('app.env') === 'production' || config('app.api_response') === true) {
            $exceptions->render(function (Throwable $e, Request $request) {
                if ($request->is('api/*')) {
                    return APIResponse::GetAPIResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), false, null);
                }
            });
        }

    })->create();
