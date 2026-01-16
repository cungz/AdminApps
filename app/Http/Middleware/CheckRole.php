<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        if (!$request->user()->isActive()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account is inactive.');
        }

        if ($request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access. You do not have the required role.');
    }
}