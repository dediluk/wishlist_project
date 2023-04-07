<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): ?Response
    {
//        dd(Auth::check());
//        var_dump(isset($request->user()->roles));
        return isset($request->user()->roles) && $request->user()->hasRole('admin') ? $next($request) : abort(403);
//        return $next($request);
    }
}
