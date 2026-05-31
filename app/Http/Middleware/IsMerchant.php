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
        //dd(Auth::user()->role_id);
        //dd(Auth::user()->role->name);
        // Check if the user is authenticated and has the 'merchant' role
        if (Auth::check() && Auth::User()->role_id == 2 && Auth::User()->role_id == 2 ) {
            // If yes, allow the request to proceed
            return $next($request);
        }
        // If not, abort the request with a "Forbidden" status
        abort(403, 'Unauthorized Access.');


    }
}
