<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
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
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if($e instanceof\Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=>'TokenisInvalid']);
            }else if($e instanceof\Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=>'TokenisExpired']);
            }else{
                return response()->json(['status'=>'AuthorizationTokennotfound']);
            }
        }
        return $next($request);
    }
}
