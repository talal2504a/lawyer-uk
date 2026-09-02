<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Specialization;
use App\Models\Appointment;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = [
            'total_customers' => User::where('user_type', 'customer')->count(),
            'total_lawyers' => User::where('user_type', 'lawyer')->count(),
            'pending_lawyers' => Lawyer::where('is_approved', 0)->count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
        ];

        $pendingLawyers = Lawyer::with('user')->where('is_approved', 0)->orderBy('created_at', 'desc')->take(6)->get();
        $recentAppointments = Appointment::with(['customer', 'lawyer'])->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pendingLawyers', 'recentAppointments'));
    }

    public function customers()
    {
        $customers = User::where('user_type', 'customer')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.customers', compact('customers'));
    }

    public function deleteCustomer($id)
    {
        $customer = User::where('user_type', 'customer')->findOrFail($id);
        $customer->delete();
        return back()->with('success', 'Customer deleted successfully.');
    }

    public function lawyers()
    {
        $lawyers = Lawyer::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.lawyers', compact('lawyers'));
    }

    public function approveLawyer($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->update(['is_approved' => 1]);
        return back()->with('success', 'Lawyer approved successfully.');
    }

    public function rejectLawyer($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->user->delete();
        return back()->with('success', 'Lawyer rejected and deleted.');
    }

    public function deleteLawyer($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->user->delete();
        return back()->with('success', 'Lawyer deleted successfully.');
    }

    public function specializations()
    {
        $specializations = Specialization::orderBy('name')->paginate(15);
        return view('admin.specializations', compact('specializations'));
    }

    public function addSpecialization(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:specializations']);
        Specialization::create(['name' => $request->name, 'status' => 'active']);
        return back()->with('success', 'Specialization added successfully.');
    }

    public function updateSpecialization(Request $request, $id)
    {
        $spec = Specialization::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $spec->update(['name' => $request->name]);
        return back()->with('success', 'Specialization updated successfully.');
    }

    public function deleteSpecialization($id)
    {
        $spec = Specialization::findOrFail($id);
        $spec->delete();
        return back()->with('success', 'Specialization deleted successfully.');
    }

    public function appointments()
    {
        $appointments = Appointment::with(['customer', 'lawyer'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.appointments', compact('appointments'));
    }
}