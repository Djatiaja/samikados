<?php

use App\Http\Middleware\Verify2FAMiddleware;
use App\Http\Middleware\VerifyRole;
use App\Http\Middleware\VerifyUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup("verifyUser", [
            VerifyUser::class,
        ]);

        $middleware->alias([
            "role"=>VerifyRole::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
