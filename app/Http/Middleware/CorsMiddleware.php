<?php namespace App\Http\Middleware;

use Closure;
class CorsMiddleware
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
        // cors baru
    //     $headers = [
    //         'Access-Control-Allow-Origin'      => '*',
    //         'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
    //         'Access-Control-Allow-Credentials' => 'true',
    //         'Access-Control-Max-Age'           => '86400',
    //         'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
    //     ];

    //     if ($request->isMethod('OPTIONS'))
    //     {
    //         return response()->json('{"method":"OPTIONS"}', 200, $headers);
    //     }

    //     $response = $next($request);
    //     foreach($headers as $key => $value)
    //     {
    //         $response->header($key, $value);
    //     }

    //     return $response;
    // }

    //Cors lama
    //Intercepts OPTIONS requests
    if ($request->isMethod('OPTIONS')) {
        $response = response('', 200);
    } else {
        // Pass the request to the next middleware
        $response = $next($request);
    }

    // Adds headers to the response
    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
    $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
    $response->header('Access-Control-Allow-Origin', '*');
    $response->header('Access-Control-Expose-Headers', 'Location');

    // Sends it
    return $response;
    }
}