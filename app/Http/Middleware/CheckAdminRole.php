<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\GenericUser;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            $sess = session('user');
            if (is_array($sess) && !empty($sess['id'])) {
                $generic = new GenericUser($sess);
                Auth::setUser($generic);
            } else {
                return redirect()->route('login.form');
            }
        }

        $user = Auth::user();

        $role = null;
        if (is_array($user)) {
            $role = $user['role'] ?? null;
        } elseif (is_object($user)) {
            $role = $user->role ?? ($user->getAuthIdentifierName() ? ($user->role ?? null) : null);
        }

        if ($role !== 'admin') {
            abort(403, 'شما مجوز دسترسی به این بخش را ندارید.');
        }

        return $next($request);
    }
}
