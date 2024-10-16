<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure $roles is not empty
        if (empty($roles)) {
            abort(500, 'No roles specified for CheckUserRole middleware.');
        }

        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
