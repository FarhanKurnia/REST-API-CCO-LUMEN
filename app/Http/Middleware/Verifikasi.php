<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;

class Verifikasi
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
        // Pre-Middleware Action

        //$response = $next($request);

        // Post-Middleware Action
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $verifikasi = $jwt_id['verifikasi'];
        $aktif = $jwt_id['aktif'];

        if (!$verifikasi == true) {
            return response()->json([
                'status' => 'Unauthorized',
                'message' => 'Please Verify your account'], 403);
        } 
        elseif(!$aktif == true){
            return response()->json([
                'status' => 'Unauthorized',
                'message' => 'Please activate your account'], 403);
        }

        return $next($request);
        // return $response;
    }
}
