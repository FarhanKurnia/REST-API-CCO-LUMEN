<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library
// use Illuminate\Contracts\Auth\Factory as Auth;

use Closure;

class Role
{
    public function handle($request, Closure $next)
    {
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $role = $jwt_id['role_id'];
        if ($role > 1) {
            // return response('Unauthorized', 401);
            return response('You are not Helpdesk', 403);
        }
        return $next($request);
    }
}
