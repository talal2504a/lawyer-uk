<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Specialization;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\Chat;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $userId = Auth::id();

        // Stats
        $totalAppointments = Appointment::where('customer_id', $userId)->count();
        $upcomingAppointments = Appointment::where('customer_id', $userId)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', now()->toDateString())
            ->count();
        $completedAppointments = Appointment::where('customer_id', $userId)
            ->where('status', 'completed')
            ->count();
        $favoriteLawyers = 0; // Placeholder for future feature

        // Upcoming appointments
        $upcoming = Appointment::where('customer_id', $userId)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', now()->toDateString())
            ->with('lawyer')
            ->orderBy('appointment_date', 'asc')
            ->take(5)
            ->get();

        // Recent activity (all appointments)
        $recentActivity = Appointment::where('customer_id', $userId)
            ->with('lawyer')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Top specializations
        $topSpecializations = Specialization::where('status', 'active')
            ->withCount(['lawyers' => function ($q) {
                $q->where('is_approved', 1);
            }])
            ->orderByDesc('lawyers_count')
            ->take(6)
            ->get();

        // Featured lawyers
        $featuredLawyers = User::where('user_type', 'lawyer')
            ->whereHas('lawyer', function ($q) {
                $q->where('is_approved', 1);
            })
            ->with('lawyer')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('customer.dashboard', compact(
            'totalAppointments', 'upcomingAppointments', 'completedAppointments',
            'favoriteLawyers', 'upcoming', 'recentActivity', 'topSpecializations',
            'featuredLawyers'
        ));
    }

    public function search(Request $request)
    {
        $query = User::where('user_type', 'lawyer')
            ->whereHas('lawyer', function ($q) {
                $q->where('is_approved', 1);
            });

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('specialization')) {
            $query->whereHas('lawyer', function ($q) use ($request) {
                $q->where('specialization', 'like', '%' . $request->specialization . '%');
            });
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $lawyers = $query->with('lawyer')->paginate(12);
        $specializations = Specialization::where('status', 'active')->get();
        $cities = User::where('user_type', 'lawyer')
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city');

        return view('customer.search', compact('lawyers', 'specializations', 'cities'));
    }

    public function lawyerProfile($id)
    {
        $lawyerUser = User::where('user_type', 'lawyer')
            ->whereHas('lawyer', function ($q) {
                $q->where('is_approved', 1);
            })
            ->with(['lawyer', 'lawyer.practiceAreas'])
            ->findOrFail($id);

        $timeSlots = TimeSlot::where('lawyer_id', $lawyerUser->lawyer->id)
            ->where('slot_date', '>=', now()->toDateString())
            ->where('is_booked', 0)
            ->orderBy('slot_date')
            ->orderBy('slot_time')
            ->get();

        // Group slots by date
        $slotsByDate = $timeSlots->groupBy(function ($slot) {
            return $slot->slot_date->format('Y-m-d');
        });

        // Related lawyers
        $relatedLawyers = User::where('user_type', 'lawyer')
            ->where('id', '!=', $id)
            ->whereHas('lawyer', function ($q) use ($lawyerUser) {
                $q->where('is_approved', 1)
                  ->where('specialization', $lawyerUser->lawyer->specialization);
            })
            ->with('lawyer')
            ->take(3)
            ->get();

        return view('customer.lawyer-profile-v2', compact('lawyerUser', 'timeSlots', 'slotsByDate', 'relatedLawyers'));
    }

    public function bookAppointment(Request $request, $lawyerId)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required',
            'message' => 'nullable|string|max:500',
        ]);

        $lawyer = Lawyer::where('user_id', $lawyerId)->where('is_approved', 1)->firstOrFail();

        $exists = Appointment::where('lawyer_id', $lawyerId)
            ->where('appointment_date', $request->appointment_date)
            ->where('time_slot', $request->time_slot)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['time_slot' => 'This time slot is already booked.']);
        }

        Appointment::create([
            'customer_id' => Auth::id(),
            'lawyer_id' => $lawyerId,
            'appointment_date' => $request->appointment_date,
            'time_slot' => $request->time_slot,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.appointments')->with('success', 'Appointment booked successfully!');
    }

    public function myAppointments()
    {
        $appointments = Appointment::where('customer_id', Auth::id())
            ->with('lawyer')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('customer.my-appointments', compact('appointments'));
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('customer_id', Auth::id())->findOrFail($id);

        if ($appointment->status === 'completed') {
            return back()->with('error', 'Cannot cancel a completed appointment.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }

    public function chatView($appointmentId)
    {
        $appointment = Appointment::where('customer_id', Auth::id())->with('lawyer', 'chats.sender')->findOrFail($appointmentId);
        return view('customer.chat', compact('appointment'));
    }

    public function getChats($appointmentId)
    {
        $appointment = Appointment::where('customer_id', Auth::id())->findOrFail($appointmentId);
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
        $appointment = Appointment::where('customer_id', Auth::id())->findOrFail($appointmentId);
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
}
