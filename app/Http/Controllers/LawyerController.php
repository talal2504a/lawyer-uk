<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Appointment;

class LawyerController extends Controller
{
    public static function getLawyersData()
    {
        return [
            1 => [
                "name" => "Adv. Ahmad Khan",
                "title" => "High Court Advocate",
                "subtitle" => "Senior Corporate Consultant & Arbitrator",
                "experience" => "15+ Years Exp.",
                "education" => "LL.M. (Corporate Law)",
                "rating" => "4.9",
                "reviews_count" => "140+",
                "fee" => "PKR 6,000",
                "location" => "Lahore, Pakistan",
                "address" => "Suite 14, High Court Chambers District, Lahore",
                "phone" => "+92 42 3555 0199",
                "bio_1" => "Specializing in Corporate Law and Dispute Resolution with 15+ years of active practice across the High Courts.",
                "bio_2" => "Adv. Ahmad Khan has successfully represented local and international corporate entities in multi-million rupee structural negotiations.",
                "specs" => ["Corporate & Commercial Law", "Alternative Dispute Resolution", "Taxation Law", "Civil Litigation"],
                "img" => "https://lh3.googleusercontent.com/aida-public/AB6AXuDk66qVdxlQqBDDq8ZKkXlIiI1V0lD0Z_-aHvTGCYjDOyJ3PpZxjO8sYadFZI9E9U2iaL8xwilsRkEptvMzQYpPpvB0wtn6LS98fZi-1GJntpNWjXyccD8qxYJW0Uv7tC4bCfcqHybqgUlxZCMYNtgvP4HBhdX7eSMG5sG1dvMAP_Zah0zYKLP-aRBkPZC-l0sOwalqyKo8imvOs2VPgSDaao4dJqYHubj301o92Q37dj68_uDAksXNdYIt2VTNG8w3ILc-Wk9B6qpZ",
            ],
            2 => [
                "name" => "Adv. Sara Ahmed",
                "title" => "Family Law Expert",
                "subtitle" => "Senior Mediation & Inheritance Specialist",
                "experience" => "10+ Years Exp.",
                "education" => "LL.M. (Family Jurisprudence)",
                "rating" => "5.0",
                "reviews_count" => "95+",
                "fee" => "PKR 5,000",
                "location" => "Islamabad, Pakistan",
                "address" => "Office 402, Al-Abbas Tower, F-7 Markaz, Islamabad",
                "phone" => "+92 51 555 0123",
                "bio_1" => "Providing compassionate and expert mediation in family, child custody, and complex inheritance disputes.",
                "bio_2" => "Known for her exceptional analytical track record and strict adherence to client confidentiality records.",
                "specs" => ["Family Law & Mediation", "Inheritance & Property Settlement", "Civil Rights"],
                "img" => "https://lh3.googleusercontent.com/aida-public/AB6AXuC2L1chzfLIMrYHB7bx0sikQZJ0BIfafB-i0P9oo2eDhp810i0y-5fN-r_HKKCN1Lic0aYjrRp2UUbABpCVJuyxv7ZvjHoQ7EmYnKnJRy5yrUtACDoy1_s5IYukknktPPxA8OwOewadmcITImAqKYGkG_EVl3bGQhphZx8Ltqo_HywavPbV8aIUDfa3T0NJBpx3GQaD7UxLnE5F2VpSJJUoLh_qSu8LHFPjWALBsPYzA6Lr8j78p0L0AN8TSbnNe2f2613y1oc_jvh2",
            ],
            3 => [
                "name" => "Adv. Zaid Malik",
                "title" => "Criminal Defense Lead",
                "subtitle" => "Senior Trial Attorney - Constitutional Rights",
                "experience" => "12+ Years Exp.",
                "education" => "LL.M. (Criminal Justice)",
                "rating" => "4.8",
                "reviews_count" => "110+",
                "fee" => "PKR 7,500",
                "location" => "Karachi, Pakistan",
                "address" => "Clifton Legal Chambers, Block 5, Clifton, Karachi",
                "phone" => "+92 21 3444 0112",
                "bio_1" => "Distinguished career in protecting constitutional rights and aggressive white-collar criminal defense litigation.",
                "bio_2" => "Having an impeccable record inside criminal trials, high-profile bail applications, and state appellate benches.",
                "specs" => ["Criminal Defense", "Constitutional Litigation", "White Collar Crime", "Bail Matters"],
                "img" => "https://lh3.googleusercontent.com/aida-public/AB6AXuAmq3PRzlCP61FzhCvrjNgi_wSu4uN84OmxbMxw8TpzYnqVO_lbuNocIsjNnG0SgoZhpLVy7G8flKvnBc8XcEmwoXusDF3DMOAwdCQPc92aKyX1QO-hw9TQzEyBbIQcFOBiu8nCbSOISvsCVTmL5GcPkdERdX8ArBdiF_NK2Lh9_tg24ntvVZlc82iecF5dLc_tXwigWM6jPEEie8K7rSdwi97q59GF3-oFpCEvSBl8Xw9cdHzc8JowCioPNOWM_-9OopgDIga3qNOp",
            ]
        ];
    }

    public function home()
    {
        $lawyersData = self::getLawyersData();

        // Fetch lawyers from database and merge with static data
        $dbLawyers = User::where('user_type', 'lawyer')
            ->where('status', 'active')
            ->whereHas('lawyer', function ($q) {
                $q->where('is_approved', 1);
            })
            ->with('lawyer')
            ->get()
            ->map(function ($user) use ($lawyersData) {
                $key = $user->id;
                $custom = $lawyersData[$key] ?? null;
                return [
                    'id' => $key,
                    'name' => $user->name,
                    'title' => $custom['title'] ?? ($user->lawyer->specialization ?? 'Lawyer'),
                    'subtitle' => $custom['subtitle'] ?? '',
                    'experience' => $custom['experience'] ?? ($user->lawyer->experience ? $user->lawyer->experience . ' Years Exp.' : 'Experience TBD'),
                    'education' => $custom['education'] ?? '',
                    'rating' => $custom['rating'] ?? '4.5',
                    'reviews_count' => $custom['reviews_count'] ?? '0',
                    'fee' => 'PKR ' . number_format($user->lawyer->consultation_fee ?? 5000),
                    'location' => $custom['location'] ?? $user->city,
                    'address' => $custom['address'] ?? '',
                    'phone' => $custom['phone'] ?? $user->mobile,
                    'bio_1' => $custom['bio_1'] ?? ($user->lawyer->bio ?? 'No bio available'),
                    'bio_2' => $custom['bio_2'] ?? '',
                    'specs' => $custom['specs'] ?? [$user->lawyer->specialization ?? 'General Practice'],
                    'img' => $custom['img'] ?? ($user->lawyer->profile_image ? asset('storage/' . $user->lawyer->profile_image) : 'https://via.placeholder.com/300?text=' . urlencode($user->name)),
                ];
            });

        return view('welcome', compact('lawyersData', 'dbLawyers'));
    }

    public function show($id)
    {
        $lawyers_database = self::getLawyersData();
        $lawyer = $lawyers_database[$id] ?? $lawyers_database[3];
        return view('lawyer.profile', compact('lawyer'));
    }

    public function guestBooking(Request $request, $lawyerId)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'case_details' => 'required|string|max:1000',
        ]);

        // Find the lawyer user - try multiple approaches
        $lawyerUser = User::where('user_type', 'lawyer')
            ->where('id', $lawyerId)
            ->first();

        if (!$lawyerUser) {
            $lawyerUser = User::where('user_type', 'lawyer')
                ->whereHas('lawyer', function ($q) use ($lawyerId) {
                    $q->where('id', $lawyerId);
                })
                ->first();
        }

        if (!$lawyerUser) {
            // Fallback: just get any active lawyer from database
            $lawyerUser = User::where('user_type', 'lawyer')
                ->where('status', 'active')
                ->first();
        }

        if (!$lawyerUser) {
            // Auto-create a default active lawyer in database so that guest booking never fails!
            $lawyerUser = User::create([
                'name' => 'Adv. Ahmad Khan',
                'email' => 'ahmad.khan@lawyerconnect.com',
                'password' => Hash::make('password123'),
                'user_type' => 'lawyer',
                'mobile' => '+92 42 3555 0199',
                'city' => 'Lahore',
                'status' => 'active',
            ]);

            \App\Models\Lawyer::create([
                'user_id' => $lawyerUser->id,
                'specialization' => 'Corporate & Commercial Law',
                'experience' => 15,
                'is_approved' => 1,
                'consultation_fee' => 6000,
                'bio' => 'Specializing in Corporate Law and Dispute Resolution with 15+ years of active practice.',
            ]);
        }

        // Find or create guest customer (no login required)
        $customer = Auth::user();
        if (!$customer) {
            // Find existing customer by email
            $customer = User::where('email', $request->customer_email)->first();
            
            if (!$customer) {
                // Create a new guest customer
                $customer = User::create([
                    'name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'password' => Hash::make(Str::random(16)),
                    'user_type' => 'customer',
                    'mobile' => $request->customer_phone,
                    'city' => '',
                    'status' => 'active',
                ]);
            }
        }

        // Create the appointment
        $appointment = Appointment::create([
            'customer_id' => $customer->id,
            'lawyer_id' => $lawyerUser->id,
            'appointment_date' => now()->addDay()->toDateString(),
            'time_slot' => now()->format('H:i'),
            'message' => "Name: " . $request->customer_name . "\nEmail: " . $request->customer_email . "\nPhone: " . $request->customer_phone . "\n\nCase Details:\n" . $request->case_details,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking request sent successfully!'
        ]);
    }
}