@extends('layouts.lawyer')
@section('title', 'Dashboard')
@section('page-title', 'Adv. ' . Auth::user()->name)

@section('content')
<!-- Statistics Bento Grid -->
<section class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-stack-lg">
    <!-- New Requests -->
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary/5 rounded-lg group-hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined text-primary">list</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">New Requests</p>
        <h3 class="text-headline-xl font-headline-xl text-primary mt-1">{{ $stats['new_requests'] }}</h3>
    </div>
    <!-- Pending Cases -->
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-tertiary/5 rounded-lg group-hover:bg-tertiary/10 transition-colors">
                <span class="material-symbols-outlined text-tertiary">schedule</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Pending Cases</p>
        <h3 class="text-headline-xl font-headline-xl text-tertiary mt-1">{{ $stats['pending'] }}</h3>
    </div>
    <!-- Accepted Cases -->
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary-container/5 rounded-lg group-hover:bg-primary-container/10 transition-colors">
                <span class="material-symbols-outlined text-primary-container">check_circle</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Accepted Cases</p>
        <h3 class="text-headline-xl font-headline-xl text-primary-container mt-1">{{ $stats['accepted'] }}</h3>
    </div>
    <!-- Rejected Cases -->
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-error/5 rounded-lg group-hover:bg-error/10 transition-colors">
                <span class="material-symbols-outlined text-error">close</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Rejected Cases</p>
        <h3 class="text-headline-xl font-headline-xl text-error mt-1">{{ $stats['rejected'] }}</h3>
    </div>
</section>

<!-- Case Requests Section -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-end mb-gutter">
        <div>
            <span class="text-label-md font-label-md text-primary tracking-[0.2em] uppercase">Incoming Matters</span>
            <h2 class="font-headline-lg text-headline-lg mt-2">NEW CASE REQUESTS (Pending Approval)</h2>
        </div>
        <a class="text-primary font-bold border-b-2 border-primary pb-1 hover:text-primary-container hover:border-primary-container transition-all flex items-center gap-2" href="{{ route('lawyer.cases', ['filter' => 'pending']) }}">
            View All <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-gutter">
        @if($pendingRequests->count() > 0)
            @foreach($pendingRequests as $appointment)
            <div class="bg-white border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-stack-md md:p-gutter flex flex-col md:flex-row gap-gutter">
                    <!-- Client Info -->
                    <div class="flex-shrink-0 flex md:flex-col items-center md:items-start gap-4">
                        <div class="w-16 h-16 rounded-full bg-surface-container-high overflow-hidden border border-outline-variant">
                            <div class="w-full h-full flex items-center justify-center bg-primary-container/20 text-primary">
                                <span class="material-symbols-outlined text-2xl">person</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-on-surface">{{ $appointment->customer->name ?? 'N/A' }}</h4>
                            <p class="text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                {{ $appointment->city ?? $appointment->customer->city ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <!-- Case Details -->
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-caption font-bold text-primary-container bg-primary-container/10 px-3 py-1 rounded-full uppercase tracking-tighter">Case #C{{ $appointment->id }}</span>
                            <span class="text-caption font-semibold text-tertiary-container bg-tertiary-fixed/30 px-3 py-1 rounded-full">{{ $appointment->case_type ?? 'General' }}</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-2">{{ $appointment->case_type ?? 'Legal Consultation Request' }}</h3>
                        <p class="text-body-md text-on-surface-variant line-clamp-2">{{ Str::limit($appointment->message, 200) }}</p>
                        <div class="flex flex-wrap gap-stack-sm mt-stack-md">
                            <a href="{{ route('lawyer.case.detail', $appointment->id) }}" class="bg-primary-container text-on-primary px-6 py-2.5 rounded-lg font-bold hover:bg-primary transition-all flex items-center gap-2 active:scale-95">
                                <span class="material-symbols-outlined text-[20px]">check_circle</span> Accept Case
                            </a>
                            <a href="{{ route('lawyer.case.detail', $appointment->id) }}#chat" class="border-2 border-primary-container text-primary-container px-6 py-2.5 rounded-lg font-bold hover:bg-primary-container/5 transition-all flex items-center gap-2 active:scale-95">
                                <span class="material-symbols-outlined text-[20px]">chat</span> Chat with Customer
                            </a>
                            <a href="{{ route('lawyer.case.detail', $appointment->id) }}#reject" class="border-2 border-error text-error px-6 py-2.5 rounded-lg font-bold hover:bg-error/5 transition-all flex items-center gap-2 active:scale-95">
                                <span class="material-symbols-outlined text-[20px]">block</span> Reject Case
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4 block">inbox</span>
                <h3 class="font-headline-md text-headline-md text-on-surface-variant mb-2">No New Case Requests</h3>
                <p class="text-body-md text-on-surface-variant">You're all caught up! New requests will appear here.</p>
            </div>
        @endif
    </div>
</section>

<!-- Recent Appointments Table -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-end mb-gutter">
        <div>
            <span class="text-label-md font-label-md text-primary tracking-[0.2em] uppercase">Consultation History</span>
            <h2 class="font-headline-lg text-headline-lg mt-2">RECENT APPOINTMENTS</h2>
        </div>
        <a class="text-primary font-bold border-b-2 border-primary pb-1 hover:text-primary-container hover:border-primary-container transition-all flex items-center gap-2" href="{{ route('lawyer.cases') }}">
            All Cases <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
        </a>
    </div>

    @if($recentAppointments->count() > 0)
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Customer</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Date</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Time</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Type</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAppointments as $appointment)
                            <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors">
                                <td class="py-3 px-4 text-on-surface font-label-md">{{ $appointment->customer->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ optional($appointment->appointment_date)->format('M d, Y') ?? 'Not scheduled' }}</td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ $appointment->time_slot ? date('h:i A', strtotime($appointment->time_slot)) : 'N/A' }}</td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ $appointment->meeting_mode ?? 'In-Person' }}</td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-tertiary-fixed/30 text-tertiary',
                                            'confirmed' => 'bg-primary-fixed/30 text-on-primary-fixed-variant',
                                            'completed' => 'bg-primary-container/10 text-primary-container',
                                            'cancelled' => 'bg-error-container/30 text-on-error-container',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full font-label-md text-[10px] uppercase font-bold {{ $statusColors[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg text-center">
            <span class="material-symbols-outlined text-6xl text-outline mb-4 block">event_busy</span>
            <h3 class="font-headline-md text-headline-md text-on-surface-variant mb-2">No Appointments Yet</h3>
            <p class="text-body-md text-on-surface-variant">Your upcoming consultations will appear here.</p>
        </div>
    @endif
</section>
@endsection