<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsMerchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        // Check if the user is authenticated and has the 'merchant' role
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name == 'merchant') {
            // If yes, allow the request to proceed
            return $next($request);
        }

        // If not, abort the request with a "Forbidden" status
        abort(403, 'Unauthorized Access.');


    }
}
