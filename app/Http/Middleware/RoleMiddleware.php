<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $role = $jwt_id['role'];

        // Pre-Middleware Action
        if ($request->umur <= 20) {
            return "Anda tidak di ijinkan masuk, karena umur anda belum mencukupi.";
        }
        return $next($request);

        // $response = $next($request);

        // // Post-Middleware Action

        // return $response;
    }
}
