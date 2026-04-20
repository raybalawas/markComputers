<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuthController extends Controller
{
    public function showRegister()
    {
        return view('superadmin.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:super_admins,email',
            'password' => 'required|min:6',
        ]);

        $admin = SuperAdmin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('superadmin')->login($admin);

        return redirect()->route('superadmin.dashboard');
    }
    public function showLogin()
    {
        return view('superadmin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt($credentials)) {
            return redirect()->route('superadmin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }
    public function dashboard()
    {
        return view('superadmin.auth.dashboard');
    }

    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login');
    }
}
