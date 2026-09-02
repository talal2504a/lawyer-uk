<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lawyer;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\Chat;
use App\Models\User;
use App\Models\PracticeArea;

class LawyerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ===== DASHBOARD OVERVIEW =====
    public function index()
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();

        $stats = [
            'new_requests' => Appointment::where('lawyer_id', Auth::id())->where('status', 'pending')->count(),
            'pending' => Appointment::where('lawyer_id', Auth::id())->where('status', 'pending')->count(),
            'accepted' => Appointment::where('lawyer_id', Auth::id())->where('status', 'confirmed')->count(),
            'rejected' => Appointment::where('lawyer_id', Auth::id())->where('status', 'cancelled')->count(),
            'completed' => Appointment::where('lawyer_id', Auth::id())->where('status', 'completed')->count(),
            'total' => Appointment::where('lawyer_id', Auth::id())->count(),
        ];

        $pendingRequests = Appointment::where('lawyer_id', Auth::id())
            ->where('status', 'pending')
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $recentAppointments = Appointment::where('lawyer_id', Auth::id())
            ->with('customer')
            ->orderBy('appointment_date', 'desc')
            ->take(5)
            ->get();

        return view('lawyer.dashboard', compact('lawyer', 'stats', 'pendingRequests', 'recentAppointments'));
    }

    // ===== CASE REQUEST DETAIL =====
    public function caseDetail($id)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->with('customer', 'chats.sender')->findOrFail($id);
        $lawyers = User::where('user_type', 'lawyer')->where('id', '!=', Auth::id())->get();
        return view('lawyer.case-detail', compact('appointment', 'lawyers'));
    }

    // ===== ACCEPT CASE =====
    public function acceptCase(Request $request, $id)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required',
            'meeting_mode' => 'required|in:In-Person,Video Call,Phone Call',
            'meeting_location' => 'nullable|string',
            'consultation_fee' => 'required|numeric|min:0',
            'advance_required' => 'required|numeric|min:0',
            'message' => 'nullable|string',
        ]);

        $appointment->update([
            'status' => 'confirmed',
            'appointment_date' => $request->appointment_date,
            'time_slot' => $request->time_slot,
            'meeting_mode' => $request->meeting_mode,
            'meeting_location' => $request->meeting_location,
            'consultation_fee' => $request->consultation_fee,
            'advance_required' => $request->advance_required,
            'lawyer_response' => $request->message,
        ]);

        return redirect()->route('lawyer.case.detail', $appointment->id)->with('success', 'Case accepted successfully! Meeting details sent to customer.');
    }

    // ===== REJECT CASE =====
    public function rejectCase(Request $request, $id)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
            'suggested_lawyer_id' => 'nullable|exists:users,id',
        ]);

        $data = [
            'status' => 'cancelled',
            'rejection_reason' => $request->rejection_reason,
        ];

        if ($request->filled('suggested_lawyer_id')) {
            $data['suggested_lawyer_id'] = $request->suggested_lawyer_id;
        }

        $appointment->update($data);

        return redirect()->route('lawyer.dashboard')->with('success', 'Case rejected. Customer has been notified.');
    }

    // ===== MY PROFILE =====
    public function myProfile()
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();
        $practiceAreas = PracticeArea::where('lawyer_id', $lawyer->id)->get();
        return view('lawyer.my-profile', compact('lawyer', 'practiceAreas'));
    }

    public function updateProfile(Request $request)
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'specialization' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'consultation_duration' => 'required|integer|min:15',
            'bio' => 'nullable|string|max:2000',
            'profile_image' => 'nullable|image|max:2048',
            'title' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email_contact' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'has_discount' => 'nullable|boolean',
            'is_verified' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'specialization', 'experience', 'consultation_fee', 'consultation_duration',
            'bio', 'title', 'education', 'address', 'phone', 'email_contact', 'website',
            'has_discount', 'is_verified'
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $data['profile_image'] = $path;
        }

        $lawyer->update($data);

        // Update user's name if provided
        if ($request->filled('name')) {
            Auth::user()->update(['name' => $request->name]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    // ===== MY CASES PAGE =====
    public function cases(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Appointment::where('lawyer_id', Auth::id())->with('customer');

        switch ($filter) {
            case 'active':
                $query->where('status', 'confirmed');
                break;
            case 'completed':
                $query->where('status', 'completed');
                break;
            case 'rejected':
                $query->where('status', 'cancelled');
                break;
            case 'pending':
                $query->where('status', 'pending');
                break;
            default:
                break;
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(10);
        $currentFilter = $filter;

        return view('lawyer.cases', compact('appointments', 'currentFilter'));
    }

    // ===== CHAT SYSTEM =====
    public function getChats($appointmentId)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->findOrFail($appointmentId);
        $chats = Chat::where('appointment_id', $appointmentId)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['chats' => $chats])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function sendChat(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->findOrFail($appointmentId);

        $request->validate([
            'message' => 'required_without:attachment|string|nullable',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $data = [
            'appointment_id' => $appointmentId,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('chat-attachments', 'public');
        }

        Chat::create($data);

        return response()->json(['success' => true, 'message' => 'Message sent!']);
    }

    // ===== LEGACY METHODS =====
    public function appointments()
    {
        $appointments = Appointment::where('lawyer_id', Auth::id())
            ->with('customer')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('lawyer.appointments', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::where('lawyer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Appointment status updated.');
    }

    public function availability()
    {
        $timeSlots = TimeSlot::where('lawyer_id', Auth::user()->lawyer->id)
            ->where('slot_date', '>=', now()->toDateString())
            ->orderBy('slot_date')
            ->orderBy('slot_time')
            ->paginate(20);

        return view('lawyer.availability', compact('timeSlots'));
    }

    public function addTimeSlot(Request $request)
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'slot_date' => 'required|date|after_or_equal:today',
            'slot_time' => 'required',
        ]);

        $exists = TimeSlot::where('lawyer_id', $lawyer->id)
            ->where('slot_date', $request->slot_date)
            ->where('slot_time', $request->slot_time)
            ->exists();

        if ($exists) {
            return back()->withErrors(['slot_time' => 'This time slot already exists.']);
        }

        TimeSlot::create([
            'lawyer_id' => $lawyer->id,
            'slot_date' => $request->slot_date,
            'slot_time' => $request->slot_time,
            'is_booked' => 0,
        ]);

        return back()->with('success', 'Time slot added successfully.');
    }

    public function deleteTimeSlot($id)
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();
        $slot = TimeSlot::where('lawyer_id', $lawyer->id)->where('is_booked', 0)->findOrFail($id);
        $slot->delete();

        return back()->with('success', 'Time slot deleted.');
    }

    // ===== PRACTICE AREAS MANAGEMENT =====
    public function addPracticeArea(Request $request)
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'area_name' => 'required|string|max:255',
        ]);

        PracticeArea::create([
            'lawyer_id' => $lawyer->id,
            'area_name' => $request->area_name,
        ]);

        return back()->with('success', 'Practice area added successfully.');
    }

    public function deletePracticeArea($id)
    {
        $lawyer = Lawyer::where('user_id', Auth::id())->firstOrFail();
        $practiceArea = PracticeArea::where('lawyer_id', $lawyer->id)->findOrFail($id);
        $practiceArea->delete();

        return back()->with('success', 'Practice area deleted successfully.');
    }
}
