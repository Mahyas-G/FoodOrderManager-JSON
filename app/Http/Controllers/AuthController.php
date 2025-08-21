<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private string $userPath = 'data/users.json';

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $users = [];
        if (Storage::exists($this->userPath)) {
            $users = json_decode(Storage::get($this->userPath), true) ?: [];
        }

        foreach ($users as $u) {
            if (isset($u['email']) && $u['email'] === $request->email) {
                return back()->withErrors(['error' => 'این ایمیل قبلاً ثبت شده است.']);
            }
        }

        $newUser = [
            'id'       => count($users) + 1,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ];

        $users[] = $newUser;
        Storage::put($this->userPath, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->loginUserSession($newUser);

        return redirect()->intended(route('menu.index'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Storage::exists($this->userPath)) {
            return back()->withErrors(['error' => 'هیچ کاربری ثبت نشده است.']);
        }

        $users = json_decode(Storage::get($this->userPath), true) ?: [];

        foreach ($users as $u) {
            if (isset($u['email']) &&
                $u['email'] === $request->email &&
                isset($u['password']) &&
                Hash::check($request->password, $u['password'])
            ) {
                $this->loginUserSession($u);

                return redirect()->intended(route('menu.index'));
            }
        }

        return back()->withErrors(['error' => 'ایمیل یا رمز عبور اشتباه است.']);
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
        } catch (\Throwable $e) {
        }

        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

    private function loginUserSession(array $user): void
    {
        $sessionUser = [
            'id'    => $user['id'] ?? null,
            'email' => $user['email'] ?? null,
            'role'  => $user['role'] ?? 'user',
        ];

        session(['user' => $sessionUser]);
        session()->save();

        $generic = new GenericUser($sessionUser);
        Auth::setUser($generic);
    }
}
