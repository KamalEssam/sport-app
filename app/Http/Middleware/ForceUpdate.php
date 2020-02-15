<?php

namespace App\Http\Middleware;

use Closure;

class ForceUpdate
{

    public function handle($request, Closure $next)
    { 
        $version       = 1;
        $headerVersion = $request->header('version') ? (int) $request->header('version') : 1 ;

        if($headerVersion < $version) {
            $response['status']  = 1;
            $response['message'] = "Upgrade Required";
            return response()->json($response, 403); 
        }

        return $next($request);
    }
}
