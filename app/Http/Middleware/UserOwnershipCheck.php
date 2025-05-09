<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOwnershipCheck
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = $request->user();

        if (!$currentUser) {
            abort(401, __('messages.user.access_unauthorized'));
        }

        // Allow admins to access any user route
        if ($currentUser->isAdmin()) {
            return $next($request);
        }

        // Get the user ID from the route
        $routeId = $request->route('id') ?? $request->route('user');

        // If no ID in route, or it's the current user's ID, proceed
        if (!$routeId || $currentUser->id === (int)$routeId) {
            return $next($request);
        }

        // Otherwise, unauthorized access
        abort(403, __('messages.user.access_unauthorized'));
    }
}
