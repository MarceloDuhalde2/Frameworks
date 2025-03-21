<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Añadimos las rutas API aquí
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api' // Especificamos el prefijo /api para las rutas API
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.bearer' => \App\Http\Middleware\CheckBearerToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, $request) {
            $error = $e->validator->errors()->first();
            // Extraemos el campo y el mensaje del error
            $field = explode(' ', $error)[0]; // Simplificación: asumimos que el campo está al inicio
            $value = $request->input($field) ?? 'unknown';
            return response()->json([
                'message' => "Invalid value for {$field}: {$value}"
            ], 400);
        });
    })->create();