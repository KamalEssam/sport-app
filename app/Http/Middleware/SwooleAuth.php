<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

class SwooleAuth extends BaseMiddleware 
{
    protected $websocket;

    public function __construct(Websocket $websocket)
    {
        $this->websocket = $websocket;
    }

    public function handle($request, Closure $next)
    {
        
        try {
            if($user = JWTAuth::parseToken()->authenticate())
            {
                $request->merge(['user' => $user]);
            }
        }
        catch(TokenExpiredException $e)
        {
            Websocket::emit('token_expired', 'token expired');
        }
        catch(TokenInvalidException $e)
        {
            Websocket::emit('token_invalid', 'Token Invalid');
        }
        catch(TokenBlacklistedException $e)
        {
            Websocket::emit('token_blacklisted', 'Token BlackListed');
        }
        catch(JWTException $e)
        {
            Websocket::emit('token_absent', 'Token Absent');
        }
        return $next($request);
    }

}