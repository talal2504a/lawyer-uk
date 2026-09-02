@extends('layouts.lawyer')
@section('title', 'Availability')
@section('page-title', 'My Availability')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter mb-stack-lg">
    <div>
        <h1 class="font-headline-xl text-headline-xl text-primary mb-2">Availability</h1>
        <p class="font-body-lg text-on-surface-variant max-w-2xl">Set your available time slots for client consultations.</p>
    </div>
</div>

<!-- Error Messages -->
@if($errors->any())
    <div class="bg-error-container border border-error-container/30 text-on-error-container px-5 py-4 rounded-xl mb-gutter flex items-start gap-3">
        <span class="material-symbols-outlined text-error flex-shrink-0">warning</span>
        <ul class="list-disc list-inside text-sm font-label-md">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Slot Form -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-end mb-gutter">
        <div>
            <span class="text-label-md font-label-md text-primary tracking-[0.2em] uppercase">Schedule Management</span>
            <h2 class="font-headline-lg text-headline-lg mt-2">ADD NEW TIME SLOT</h2>
        </div>
    </div>
    <div class="bg-white border border-outline-variant rounded-xl p-gutter">
        <form action="{{ route('lawyer.availability.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            @csrf
            <div class="space-y-2">
                <label class="block font-label-md text-label-md text-on-surface-variant">Date</label>
                <input type="date" name="slot_date" required min="{{ date('Y-m-d') }}"
                    class="w-full h-[48px] border border-outline-variant rounded-lg px-4 bg-surface-container-low text-on-surface font-body-md focus:ring-primary focus:border-primary">
            </div>
            <div class="space-y-2">
                <label class="block font-label-md text-label-md text-on-surface-variant">Time</label>
                <input type="time" name="slot_time" required
                    class="w-full h-[48px] border border-outline-variant rounded-lg px-4 bg-surface-container-low text-on-surface font-body-md focus:ring-primary focus:border-primary">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-primary-container text-on-primary h-[48px] rounded-lg font-bold hover:bg-primary transition-all flex items-center justify-center gap-2 active:scale-95">
                    <span class="material-symbols-outlined">add</span> Add Slot
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Existing Slots -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-end mb-gutter">
        <div>
            <span class="text-label-md font-label-md text-primary tracking-[0.2em] uppercase">Time Slots</span>
            <h2 class="font-headline-lg text-headline-lg mt-2">YOUR SCHEDULED SLOTS</h2>
        </div>
    </div>

    @if($timeSlots->count() > 0)
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Date</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Time</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeSlots as $slot)
                            <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors">
                                <td class="py-3 px-4 text-on-surface font-label-md">{{ $slot->slot_date->format('M d, Y') }}</td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ $slot->slot_time->format('h:i A') }}</td>
                                <td class="py-3 px-4">
                                    @if($slot->is_booked)
                                        <span class="px-3 py-1 rounded-full font-label-md text-[10px] uppercase font-bold bg-error-container/30 text-on-error-container">Booked</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full font-label-md text-[10px] uppercase font-bold bg-primary-fixed/30 text-on-primary-fixed-variant">Available</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if(!$slot->is_booked)
                                        <form action="{{ route('lawyer.availability.delete', $slot->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-error font-bold hover:underline text-xs flex items-center gap-1" onclick="return confirm('Delete this time slot?')">
                                                <span class="material-symbols-outlined text-[16px]">delete</span> Delete
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-on-surface-variant text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            {{ $timeSlots->links() }}
        </div>
    @else
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg text-center">
            <span class="material-symbols-outlined text-6xl text-outline mb-4 block">calendar_month</span>
@endif
@endsection
