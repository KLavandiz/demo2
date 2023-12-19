<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		 if (!Auth::onceBasic('email')) {
            throw new AuthException('Invalid credentials',401);
        }
        return $next($request);
    }
}
