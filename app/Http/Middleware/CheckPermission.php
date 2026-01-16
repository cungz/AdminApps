<?php
// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        if (!$request->user()->isActive()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account is inactive.');
        }

        foreach ($permissions as $permission) {
            if ($request->user()->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access. You do not have the required permission.');
    }
}