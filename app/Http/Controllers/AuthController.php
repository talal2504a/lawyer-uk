<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Specialization;

class AuthController extends Controller
{
    public function showRegister()
    {
        $specializations = Specialization::where('status', 'active')->get();
        return view('auth.register', compact('specializations'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'required|string|max:20',
            'user_type' => 'required|in:customer,lawyer,admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'city' => $request->city ?? 'Karachi',
            'user_type' => $request->user_type,
            'status' => 'active',
        ]);

        // Create record in respective table
        if ($request->user_type === 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'role' => 'admin',
            ]);
        } elseif ($request->user_type === 'customer') {
            Customer::create([
                'user_id' => $user->id,
                'mobile' => $request->mobile ?? '',
                'city' => $request->city ?? 'Karachi',
            ]);
        } elseif ($request->user_type === 'lawyer') {
            Lawyer::create([
                'user_id' => $user->id,
                'specialization' => $request->specialization ?? 'General Practice',
                'experience' => $request->experience ?? 0,
                'bio' => $request->bio ?? '',
                'is_approved' => 1,
                'consultation_fee' => 5000,
                'consultation_duration' => 45,
            ]);
        }

        Auth::login($user);

        return $this->redirectAfterLogin($user);
    }

    public function showLogin()
    {
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return $this->redirectAfterLogin($user);
        }

        // If request is AJAX/ expects JSON, return structured error for password
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'errors' => [
                    'password' => 'Password does not exist'
                ]
            ], 422);
        }

        // Fallback for normal form submit
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    private function redirectAfterLogin($user)
    {
        $redirectUrl = route('home');

        if ($user->isAdmin()) {
            $redirectUrl = route('admin.dashboard');
        } elseif ($user->isLawyer()) {
            $redirectUrl = route('lawyer.dashboard');
        } elseif ($user->isCustomer()) {
            $redirectUrl = route('customer.dashboard');
        }

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl,
                'user_type' => $user->user_type,
            ]);
        }

        return redirect($redirectUrl)->with('success', 'Login successful!');
    }
}