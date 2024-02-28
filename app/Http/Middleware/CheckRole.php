<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // $statusRole = Auth::user()->level_user == $roles[0];

        // if ($statusRole === true) {
        //     return redirect('/redirect');
        // } else {
        //     auth()->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();
        //     return redirect('/login');
        // }

        if (in_array(auth()->user()->access_user_id, $roles)) {
            return $next($request);
        }

        return redirect('/redirect');
    }
}
