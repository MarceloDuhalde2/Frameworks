<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarTokenEliminar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtengo el token
        $token = $request->bearerToken();
        // defino token esperado segun el enunciado
        $token_esperado = 'SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE=';

        // Comparo los tokens y devuelvo respuesta si no es correcto
        if ($token !== $token_esperado) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Si es correcto, continua la solicitud
        return $next($request);
    }
}
