@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Administrative Overview')

@section('content')
<!-- Welcome Section -->
<div class="mb-stack-lg">
    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Administrative Overview</h2>
    <p class="text-secondary">Welcome back. Here is the latest activity across the Justice & Legacy platform.</p>
</div>

<!-- Stat Cards Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-stack-lg">
    <div class="bg-surface border border-outline-variant p-6 rounded-xl custom-shadow stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg">
                <span class="material-symbols-outlined text-primary">gavel</span>
            </div>
            <span class="text-on-primary-fixed-variant font-label-md bg-primary-fixed/30 px-2 py-0.5 rounded text-xs">Total</span>
        </div>
        <h3 class="text-secondary font-label-md mb-1 uppercase tracking-wider">Total Lawyers</h3>
        <p class="font-headline-md text-headline-md">{{ $stats['total_lawyers'] }}</p>
    </div>
    <div class="bg-surface border border-outline-variant p-6 rounded-xl custom-shadow stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-error-container/20 rounded-lg">
                <span class="material-symbols-outlined text-error">pending_actions</span>
            </div>
        </div>
        <h3 class="text-secondary font-label-md mb-1 uppercase tracking-wider">Pending Approvals</h3>
        <p class="font-headline-md text-headline-md text-error">{{ $stats['pending_lawyers'] }}</p>
    </div>
    <div class="bg-surface border border-outline-variant p-6 rounded-xl custom-shadow stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-tertiary-fixed/30 rounded-lg">
                <span class="material-symbols-outlined text-tertiary">group</span>
            </div>
        </div>
        <h3 class="text-secondary font-label-md mb-1 uppercase tracking-wider">Total Customers</h3>
        <p class="font-headline-md text-headline-md">{{ $stats['total_customers'] }}</p>
    </div>
    <div class="bg-surface border border-outline-variant p-6 rounded-xl custom-shadow stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-secondary-container rounded-lg">
                <span class="material-symbols-outlined text-on-secondary-container">calendar_month</span>
            </div>
        </div>
        <h3 class="text-secondary font-label-md mb-1 uppercase tracking-wider">Appointments MTD</h3>
        <p class="font-headline-md text-headline-md">{{ $stats['total_appointments'] }}</p>
    </div>
</div>

<!-- Pending Lawyer Approvals Section -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-center mb-stack-md">
        <h3 class="font-headline-md text-headline-md text-on-surface">Pending Lawyer Approvals</h3>
        <a class="text-primary font-label-md hover:underline" href="{{ route('admin.lawyers') }}">View All Requests</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($pendingLawyers as $lawyer)
        <div class="bg-surface border border-outline-variant rounded-xl p-6 custom-shadow flex items-center justify-between group">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-lg bg-primary-fixed/20 flex items-center justify-center text-primary flex-shrink-0">
                    <span class="material-symbols-outlined text-3xl">account_balance</span>
                </div>
                <div>
                    <h4 class="font-bold text-lg text-on-surface">{{ $lawyer->user->name ?? 'N/A' }}</h4>
                    <p class="text-secondary text-sm">{{ $lawyer->specialization ?? 'Lawyer' }} • {{ $lawyer->experience ?? 0 }} yrs Exp.</p>
                    <span class="text-primary font-label-md text-xs mt-1 inline-block">{{ $lawyer->user->email ?? '' }}</span>
                </div>
            </div>
            <div class="flex gap-2">
                <form action="{{ route('admin.lawyers.approve', $lawyer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary-container transition-all">Approve</button>
                </form>
                <form action="{{ route('admin.lawyers.reject', $lawyer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="border border-outline-variant text-secondary px-4 py-2 rounded-lg text-sm font-bold hover:bg-surface-container-high transition-all">Reject</button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-surface border border-outline-variant rounded-xl p-8 text-center col-span-2">
            <span class="material-symbols-outlined text-5xl text-outline mb-4 block">verified_user</span>
            <p class="text-on-surface-variant font-label-md">No pending approvals. All lawyers are verified.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Recent Appointments Table -->
<section class="bg-surface border border-outline-variant rounded-xl overflow-hidden custom-shadow">
    <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-surface-container-lowest">
        <h3 class="font-bold text-lg text-on-surface">Recent Appointments</h3>
        <a href="{{ route('admin.appointments') }}" class="p-2 hover:bg-surface-container rounded-full transition-colors">
            <span class="material-symbols-outlined text-secondary">arrow_forward</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant">
                    <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Client Name</th>
                    <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Service Type</th>
                    <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Date/Time</th>
                    <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Advocate</th>
                    <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($recentAppointments as $appointment)
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-on-surface">{{ $appointment->customer->name ?? 'N/A' }}</div>
                        <div class="text-xs text-secondary">#APP-{{ $appointment->id }}</div>
                    </td>
                    <td class="px-6 py-4 text-on-surface">{{ $appointment->case_type ?? $appointment->meeting_mode ?? 'Consultation' }}</td>
                    <td class="px-6 py-4 text-secondary">{{ optional($appointment->appointment_date)->format('M d, Y') ?? 'Not set' }}, {{ $appointment->time_slot ? date('h:i A', strtotime($appointment->time_slot)) : '' }}</td>
                    <td class="px-6 py-4 text-on-surface">{{ $appointment->lawyer->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusBadge = [
                                'pending' => 'bg-tertiary/10 text-tertiary',
                                'confirmed' => 'bg-primary/10 text-primary',
                                'completed' => 'bg-secondary-container text-on-secondary-container',
                                'cancelled' => 'bg-error-container/30 text-on-error-container',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusBadge[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">{{ ucfirst($appointment->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-secondary">No appointments yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection