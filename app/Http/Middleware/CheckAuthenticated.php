<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\GenericUser;

class CheckAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }

        $sess = session('user');
        if (is_array($sess) && !empty($sess['id'])) {
            $generic = new GenericUser($sess);
            Auth::setUser($generic);

            return $next($request);
        }

        return redirect()->route('login.form');
    }
}
