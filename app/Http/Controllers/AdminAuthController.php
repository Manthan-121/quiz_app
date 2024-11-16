<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class AdminAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.login');  // Create a login view for the admin panel
    }
    // Handle login request
    public function login(Request $request)
    {
        // Validate incoming request
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            \Log::info('Admin logged in successfully.');
            return redirect()->route('admin.dashboard');
        }

        \Log::info('Admin login failed. Credentials: ', $credentials);
        return redirect()->route('admin.login')->withErrors(['Invalid credentials']);
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('admin')->logout();  // Log the admin out

        return redirect('/admin/login'); // Redirect to login page
    }
}
