@extends('layouts.admin')
@section('title', 'Appointments')
@section('page-title', 'Appointments Ledger')

@section('content')
<!-- Page Header -->
<section class="mb-stack-lg">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter mb-stack-md">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Appointments Ledger</h2>
            <p class="text-body-md text-secondary max-w-2xl">A comprehensive log of all legal consultations, case reviews, and mediation sessions within the Justice & Legacy network.</p>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            @if($appointments->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary text-on-primary">
                        <th class="px-6 py-4 font-label-md">Date & Time</th>
                        <th class="px-6 py-4 font-label-md">Participants</th>
                        <th class="px-6 py-4 font-label-md">Type</th>
                        <th class="px-6 py-4 font-label-md">Status</th>
                        <th class="px-6 py-4 font-label-md text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($appointments as $appointment)
                    <tr class="hover:bg-surface-container transition-colors group {{ $loop->even ? 'bg-surface-bright' : '' }}">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-on-surface">{{ optional($appointment->appointment_date)->format('d M Y') ?? 'Not set' }}</span>
                                <span class="text-caption text-secondary">{{ $appointment->time_slot ? date('h:i A', strtotime($appointment->time_slot)) : 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-on-surface">{{ $appointment->customer->name ?? 'N/A' }}</span>
                                    <span class="text-caption text-secondary">(Client)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-primary font-medium">{{ $appointment->lawyer->name ?? 'N/A' }}</span>
                                    <span class="text-caption text-secondary">(Counsel)</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2 text-secondary">
                                <span class="material-symbols-outlined text-[18px]">person</span>
                                <span class="text-label-md">{{ $appointment->meeting_mode ?? 'In-Person' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @php
                                $statusStyles = [
                                    'confirmed' => 'bg-[#d1e7dd] text-[#0f5132] border border-[#badbcc]',
                                    'pending' => 'bg-[#fff3cd] text-[#664d03] border border-[#ffecb5]',
                                    'completed' => 'bg-primary-fixed text-on-primary-fixed border border-outline-variant',
                                    'cancelled' => 'bg-error-container text-on-error-container border border-error/20',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-caption font-bold {{ $statusStyles[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">{{ ucfirst($appointment->status) }}</span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <span class="text-primary font-bold text-xs">#APP-{{ $appointment->id }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4 bg-surface-container-low flex items-center justify-between border-t border-outline-variant">
                <span class="text-caption text-secondary">Showing {{ $appointments->firstItem() }} to {{ $appointments->lastItem() }} of {{ $appointments->total() }} appointments</span>
                <div class="flex items-center gap-2">
                    {{ $appointments->links() }}
                </div>
            </div>
            @else
            <div class="p-stack-lg text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4 block">calendar_month</span>
                <p class="text-secondary text-lg">No appointments yet.</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection