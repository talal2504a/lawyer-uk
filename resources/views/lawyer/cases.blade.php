@extends('layouts.lawyer')
@section('title', 'My Cases')
@section('page-title', 'My Cases')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter mb-stack-lg">
    <div>
        <h1 class="font-headline-xl text-headline-xl text-primary mb-2">My Cases</h1>
        <p class="font-body-lg text-on-surface-variant max-w-2xl">Manage your active legal matters, track hearing schedules, and communicate with clients through our centralized ledger system.</p>
    </div>
</div>

<!-- Tab Navigation -->
<div class="border-b border-outline-variant mb-gutter">
    <nav class="flex gap-gutter overflow-x-auto no-scrollbar">
        <a href="{{ route('lawyer.cases', ['filter' => 'all']) }}" class="px-4 py-3 font-label-md text-on-surface-variant hover:text-primary transition-all whitespace-nowrap {{ $currentFilter === 'all' ? 'active-tab text-primary' : '' }}">All Cases</a>
        <a href="{{ route('lawyer.cases', ['filter' => 'pending']) }}" class="px-4 py-3 font-label-md text-on-surface-variant hover:text-primary transition-all whitespace-nowrap {{ $currentFilter === 'pending' ? 'active-tab text-primary' : '' }}">Pending</a>
        <a href="{{ route('lawyer.cases', ['filter' => 'active']) }}" class="px-4 py-3 font-label-md text-on-surface-variant hover:text-primary transition-all whitespace-nowrap {{ $currentFilter === 'active' ? 'active-tab text-primary' : '' }}">Active</a>
        <a href="{{ route('lawyer.cases', ['filter' => 'completed']) }}" class="px-4 py-3 font-label-md text-on-surface-variant hover:text-primary transition-all whitespace-nowrap {{ $currentFilter === 'completed' ? 'active-tab text-primary' : '' }}">Completed</a>
        <a href="{{ route('lawyer.cases', ['filter' => 'rejected']) }}" class="px-4 py-3 font-label-md text-on-surface-variant hover:text-primary transition-all whitespace-nowrap {{ $currentFilter === 'rejected' ? 'active-tab text-primary' : '' }}">Rejected</a>
    </nav>
</div>

<!-- Search & Filters -->
<div class="flex flex-col md:flex-row gap-base mb-gutter">
    <div class="relative flex-1">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">filter_list</span>
        <input class="w-full pl-12 pr-4 py-3 rounded-lg border border-outline-variant bg-white focus:ring-primary focus:border-primary" placeholder="Filter by client name or ID..." type="text"/>
    </div>
    <select class="px-gutter py-3 rounded-lg border border-outline-variant bg-white text-label-md font-label-md">
        <option>Latest First</option>
        <option>Oldest First</option>
        <option>Priority High</option>
    </select>
</div>

<!-- Case Cards -->
<div class="grid grid-cols-1 gap-gutter">
    @if($appointments->count() > 0)
        @foreach($appointments as $appointment)
        <div class="group">
            <div class="bg-white border border-outline-variant rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="p-gutter flex flex-col md:flex-row justify-between gap-gutter">
                    <div class="flex gap-gutter items-start">
                        @php
                            $iconBg = match($appointment->status) {
                                'pending' => 'bg-surface-container-high text-tertiary',
                                'confirmed' => 'bg-primary-container text-on-primary',
                                'completed' => 'bg-primary-fixed/20 text-primary',
                                'cancelled' => 'bg-error-container/30 text-error',
                                default => 'bg-surface-container-high text-on-surface-variant',
                            };
                        @endphp
                        <div class="w-16 h-16 {{ $iconBg }} flex items-center justify-center rounded-lg flex-shrink-0">
                            <span class="material-symbols-outlined text-4xl">gavel</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-base mb-1">
                                <span class="font-label-md text-primary">Case #C{{ $appointment->id }}</span>
                                @if($appointment->status === 'confirmed')
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold bg-primary-fixed/30 text-on-primary-fixed-variant">Confirmed</span>
                                @elseif($appointment->status === 'pending')
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold bg-tertiary-fixed/30 text-tertiary">Pending</span>
                                @elseif($appointment->status === 'completed')
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold bg-primary-container/10 text-primary-container">Completed</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold bg-error-container/30 text-on-error-container">Cancelled</span>
                                @endif
                                @if($appointment->consultation_fee)
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold bg-tertiary-fixed/30 text-tertiary">Fee: PKR {{ number_format($appointment->consultation_fee) }}</span>
                                @endif
                            </div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-1">{{ $appointment->case_type ?? 'Legal Consultation' }} — {{ $appointment->customer->name ?? 'N/A' }}</h3>
                            <div class="flex flex-wrap items-center gap-gutter text-on-surface-variant">
                                <div class="flex items-center gap-1 font-body-md">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    {{ $appointment->customer->name ?? 'N/A' }}
                                </div>
                                <div class="flex items-center gap-1 font-body-md">
                                    <span class="material-symbols-outlined text-sm">balance</span>
                                    {{ $appointment->case_type ?? 'General' }}
                                </div>
                                @if($appointment->status === 'confirmed' && $appointment->appointment_date)
                                    <div class="flex items-center gap-1 font-body-md text-primary font-bold">
                                        <span class="material-symbols-outlined text-sm">event</span>
                                        Meeting: {{ $appointment->appointment_date->format('d M') }}
                                    </div>
                                @else
                                    <div class="flex items-center gap-1 font-body-md">
                                        <span class="material-symbols-outlined text-sm">event</span>
                                        {{ $appointment->created_at->format('d M Y') }}
                                    </div>
                                @endif
                            </div>
                            @if($appointment->status === 'cancelled' && $appointment->rejection_reason)
                                <p class="text-xs text-error mt-1">Rejected: {{ $appointment->rejection_reason }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex md:flex-col justify-end gap-base border-t md:border-t-0 md:border-l border-outline-variant pt-base md:pt-0 md:pl-gutter">
                        @if($appointment->status !== 'cancelled')
                            <a href="{{ route('lawyer.case.detail', $appointment->id) }}#chat" class="flex items-center gap-2 text-primary font-bold hover:underline py-1">
                                <span class="material-symbols-outlined text-[18px]">chat</span>
                                Chat
                            </a>
                        @endif
                        <a href="{{ route('lawyer.case.detail', $appointment->id) }}" class="flex items-center gap-2 text-primary font-bold hover:underline py-1">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="mt-6">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-xl flex flex-col items-center justify-center text-on-surface-variant p-stack-lg h-64">
            <span class="material-symbols-outlined text-5xl mb-4 text-outline">folder_open</span>
            <span class="font-headline-md">No Cases Found</span>
            <p class="text-center font-caption mt-2">No cases match this filter. Try a different category.</p>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .active-tab {
        border-bottom: 2px solid #006633;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush