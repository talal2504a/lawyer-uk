@extends('layouts.customer')

@section('title', 'Customer Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-primary to-primary-container rounded-2xl p-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-headline-lg text-white font-bold">Welcome back, {{ Auth::user()->name }}!</h2>
                <p class="text-primary-fixed mt-2">Find and book appointments with verified lawyers across Pakistan.</p>
            </div>
            <a href="{{ route('customer.search') }}" class="bg-white text-primary px-6 py-3 rounded-xl font-label-md hover:bg-primary-fixed transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined">search</span>
                Find a Lawyer
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">calendar_month</span>
                </div>
                <div>
                    <p class="text-xs text-secondary font-label-md">Total Appointments</p>
                    <p class="text-2xl font-bold text-on-surface">{{ $totalAppointments }}</p>
                </div>
            </div>
        </div>
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">schedule</span>
                </div>
                <div>
                    <p class="text-xs text-secondary font-label-md">Upcoming</p>
                    <p class="text-2xl font-bold text-on-surface">{{ $upcomingAppointments }}</p>
                </div>
            </div>
        </div>
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-green-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">check_circle</span>
                </div>
                <div>
                    <p class="text-xs text-secondary font-label-md">Completed</p>
                    <p class="text-2xl font-bold text-on-surface">{{ $completedAppointments }}</p>
                </div>
            </div>
        </div>
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-tertiary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">favorite</span>
                </div>
                <div>
                    <p class="text-xs text-secondary font-label-md">Saved Lawyers</p>
                    <p class="text-2xl font-bold text-on-surface">{{ $favoriteLawyers }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content: Upcoming + Sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Upcoming Appointments --}}
        <div class="lg:col-span-2 bg-surface-container-low border border-outline-variant rounded-xl p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-headline-md text-primary font-bold">Upcoming Appointments</h3>
                <a href="{{ route('customer.appointments') }}" class="text-primary font-label-md hover:underline flex items-center gap-1">
                    View All <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            @if($upcoming->count() > 0)
                <div class="space-y-3">
                    @foreach($upcoming as $appointment)
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-xl border border-outline-variant hover:shadow-sm transition">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">
                                    {{ substr($appointment->lawyer->name ?? 'N', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">{{ $appointment->lawyer->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-secondary flex items-center gap-1 mt-0.5">
                                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                        at {{ $appointment->time_slot }}
                                    </p>
                                </div>
                            </div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    'confirmed' => 'bg-green-50 text-green-700 border-green-200',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-outline-variant">event_busy</span>
                    <p class="text-secondary mt-3">No upcoming appointments.</p>
                    <a href="{{ route('customer.search') }}" class="text-primary font-semibold hover:underline mt-2 inline-block text-sm">Find a lawyer</a>
                </div>
            @endif
        </div>

        {{-- Right Sidebar --}}
        <div class="space-y-6">
            {{-- Specializations --}}
            <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
                <h3 class="font-headline-md text-primary font-bold mb-4">Practice Areas</h3>
                <div class="space-y-2">
                    @foreach($topSpecializations as $spec)
                        <a href="{{ route('customer.search', ['specialization' => $spec->name]) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-container transition">
                            <span class="text-sm text-on-surface font-label-md">{{ $spec->name }}</span>
                            <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-full font-label-md">{{ $spec->lawyers_count }} lawyers</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Featured Lawyers --}}
            <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
                <h3 class="font-headline-md text-primary font-bold mb-4">Featured Lawyers</h3>
                <div class="space-y-3">
                    @foreach($featuredLawyers as $lawyer)
<a href="{{ route('customer.lawyer.profile', $lawyer->id) }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container transition">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                {{ substr($lawyer->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $lawyer->name }}</p>
                                <p class="text-xs text-secondary">{{ $lawyer->lawyer->specialization ?? 'General' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    @if($recentActivity->count() > 0)
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
            <h3 class="font-headline-md text-primary font-bold mb-4">Recent Activity</h3>
            <div class="space-y-3">
                @foreach($recentActivity as $activity)
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg border border-outline-variant">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">event</span>
                            <div>
                                <p class="text-sm text-on-surface font-label-md">Appointment with {{ $activity->lawyer->name ?? 'N/A' }}</p>
                                <p class="text-xs text-secondary">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                        @php
                            $actColors = [
                                'pending' => 'bg-yellow-50 text-yellow-700',
                                'confirmed' => 'bg-green-50 text-green-700',
                                'completed' => 'bg-blue-50 text-blue-700',
                                'cancelled' => 'bg-red-50 text-red-700',
                            ];
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $actColors[$activity->status] ?? 'bg-surface text-on-surface' }}">
                            {{ ucfirst($activity->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection