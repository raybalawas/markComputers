<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\LibrarySeat;
use App\Models\LibraryStudent;
use App\Models\PgResident;
use App\Models\PgRooms;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuperAdminAuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.dashboard');
        }
        return view('superadmin.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:super_admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $admin = SuperAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'super-admin',
            'is_active' => true,
        ]);

        Auth::guard('superadmin')->login($admin);

        return redirect()->route('superadmin.dashboard')
            ->with('success', 'Registration successful! Welcome to dashboard.');
    }

    public function showLogin()
    {
        if (Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.dashboard');
        }
        return view('superadmin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('superadmin')->attempt($credentials)) {
            $user = Auth::guard('superadmin')->user();

            // Check if user is active
            if (!$user->is_active) {
                Auth::guard('superadmin')->logout();
                return back()->with('error', 'Your account has been deactivated. Please contact support.');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('superadmin.dashboard'))
                ->with('success', 'Welcome back, ' . ($user->name ?? 'Admin') . '!');
        }

        return back()->with('error', 'Invalid email or password credentials.')->withInput();
    }

    public function dashboard()
    {
        // === 1. Academics / Enquiry System Stats ===
        $totalCategories = Category::count();
        $totalCourses = Course::count();
        $totalEnquiries = Enquiry::count();
        $recentEnquiries = Enquiry::latest()->take(3)->get();

        // === 2. Library Management System Stats ===
        $totalLibStudents = LibraryStudent::count();
        $totalSeats = LibrarySeat::count();
        $availableSeats = LibrarySeat::where('status', 'available')->count();
        $recentLibStudents = LibraryStudent::latest()->take(3)->get();

        // === 3. PG Management System Stats ===
        $totalRooms = PgRooms::count();
        $occupiedRooms = PgRooms::where('status', 'occupied')->count();
        $totalResidents = PgResident::count();
        $recentResidents = PgResident::latest()->take(3)->get();

        return view('superadmin.auth.dashboard', compact(
            'totalCategories',
            'totalCourses',
            'totalEnquiries',
            'recentEnquiries',
            'totalLibStudents',
            'totalSeats',
            'availableSeats',
            'recentLibStudents',
            'totalRooms',
            'occupiedRooms',
            'totalResidents',
            'recentResidents'
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
