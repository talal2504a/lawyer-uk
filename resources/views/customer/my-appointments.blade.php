@extends('layouts.customer')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-headline-md text-on-surface font-bold">Your Appointments</h2>
            <p class="text-secondary text-sm mt-1">View and manage all your appointments with lawyers.</p>
        </div>
        <a href="{{ route('customer.search') }}" class="bg-primary text-on-primary px-5 py-2.5 rounded-xl font-label-md hover:bg-on-primary-container transition-colors flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-lg">add</span>
            Book New
        </a>
    </div>

    {{-- Appointments List --}}
    @if($appointments->count() > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                @php
                    $statusConfig = [
                        'pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200', 'icon' => 'schedule', 'label' => 'Pending'],
                        'confirmed' => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'check_circle', 'label' => 'Confirmed'],
                        'completed' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'task_alt', 'label' => 'Completed'],
                        'cancelled' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'cancel', 'label' => 'Cancelled'],
                    ];
                    $config = $statusConfig[$appointment->status] ?? $statusConfig['pending'];
                @endphp
                <div class="bg-surface-container-low border border-outline-variant rounded-xl overflow-hidden hover:shadow-sm transition">
                    <div class="flex flex-col md:flex-row">
                        {{-- Left: Date Block --}}
                        <div class="w-full md:w-24 bg-primary/5 flex flex-col items-center justify-center py-4 md:py-0 border-b md:border-b-0 md:border-r border-outline-variant">
                            <span class="text-xs text-secondary font-label-md uppercase">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</span>
                            <span class="text-2xl font-bold text-primary">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d') }}</span>
                            <span class="text-xs text-secondary font-label-md">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y') }}</span>
                        </div>

                        {{-- Right: Details --}}
                        <div class="flex-1 p-5">
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold">
                                        {{ substr($appointment->lawyer->name ?? 'N', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-surface">{{ $appointment->lawyer->name ?? 'N/A' }}</p>
                                        <p class="text-sm text-secondary flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">schedule</span>
                                            {{ \Carbon\Carbon::parse($appointment->time_slot)->format('h:i A') }}
                                            @if($appointment->lawyer->city)
                                                <span class="mx-1">·</span>
                                                <span class="material-symbols-outlined text-sm">location_on</span>
                                                {{ $appointment->lawyer->city }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">{{ $config['icon'] }}</span>
                                    {{ $config['label'] }}
                                </span>
                            </div>

                            {{-- Case Details --}}
                            @if($appointment->message)
                                <div class="mt-3 bg-surface-container rounded-lg p-3 border border-outline-variant">
                                    <p class="text-xs text-secondary font-label-md uppercase tracking-wider mb-1">Case Details</p>
                                    <p class="text-sm text-on-surface">{{ $appointment->message }}</p>
                                </div>
                            @endif

                            {{-- Lawyer Response --}}
                            @if($appointment->lawyer_response)
                                <div class="mt-3 bg-green-50 border border-green-200 rounded-lg p-3">
                                    <p class="text-xs text-green-700 font-label-md uppercase tracking-wider mb-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">reply</span>
                                        Lawyer Response
                                    </p>
                                    <p class="text-sm text-green-800">{{ $appointment->lawyer_response }}</p>
                                </div>
                            @endif

                            {{-- Actions --}}
                            <div class="mt-4 flex items-center gap-3">
                                <a href="{{ route('customer.chat', $appointment->id) }}" class="text-primary hover:bg-primary/10 px-3 py-1.5 rounded-lg text-xs font-label-md flex items-center gap-1 transition-colors border border-primary/20">
                                    <span class="material-symbols-outlined text-sm">forum</span>
                                    Chat
                                </a>
                                @if(in_array($appointment->status, ['pending', 'confirmed']))
                                    <form action="{{ route('customer.appointments.cancel', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                        @csrf
                                        <button type="submit" class="text-error hover:bg-error-container px-3 py-1.5 rounded-lg text-xs font-label-md flex items-center gap-1 transition-colors">
                                            <span class="material-symbols-outlined text-sm">close</span>
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant">event_busy</span>
            <p class="text-secondary text-lg mt-4">No appointments yet.</p>
            <p class="text-secondary text-sm mt-1">Find a lawyer and book your first appointment.</p>
            <a href="{{ route('customer.search') }}" class="mt-4 inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-label-md hover:bg-on-primary-container transition-colors text-sm">
                <span class="material-symbols-outlined text-lg">search</span>
                Find a Lawyer
            </a>
        </div>
    @endif
</div>
@endsection