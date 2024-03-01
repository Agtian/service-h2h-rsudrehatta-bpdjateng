<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            $user = Auth::user()->level_user;
            if ($user == $role) {
                return $next($request);
            }
        }

        Auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // return redirect()->route('login');
    }
}
