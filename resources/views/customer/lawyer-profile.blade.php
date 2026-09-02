@extends('layouts.customer')

@section('title', $lawyerUser->name . ' - Profile')
@section('page-title', 'Lawyer Profile')

@section('content')
<div class="space-y-6">
    {{-- Back Link --}}
    <a href="{{ route('customer.search') }}" class="inline-flex items-center gap-1 text-primary font-label-md hover:underline">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Back to Search
    </a>

    {{-- Profile Header --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-2xl overflow-hidden">
        {{-- Banner --}}
        <div class="h-36 bg-gradient-to-r from-primary to-primary-container relative">
            <div class="absolute -bottom-12 left-8">
                <div class="w-24 h-24 rounded-2xl bg-surface-container-low border-4 border-white shadow-lg flex items-center justify-center text-primary text-3xl font-bold overflow-hidden">
                    @if($lawyerUser->lawyer && $lawyerUser->lawyer->profile_image)
                        <img src="{{ asset('storage/' . $lawyerUser->lawyer->profile_image) }}" alt="{{ $lawyerUser->name }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($lawyerUser->name, 0, 1) }}
                    @endif
                </div>
            </div>
        </div>

        {{-- Info --}}
        <div class="pt-14 px-8 pb-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div>
                    <h1 class="font-headline-lg text-on-surface font-bold">{{ $lawyerUser->name }}</h1>
                    <p class="text-primary font-label-md mt-1">{{ $lawyerUser->lawyer->specialization ?? 'General Practice' }}</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($lawyerUser->city)
                            <span class="bg-surface-container flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm text-on-surface">
                                <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                                {{ $lawyerUser->city }}
                            </span>
                        @endif
                        @if($lawyerUser->lawyer->experience)
                            <span class="bg-surface-container flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm text-on-surface">
                                <span class="material-symbols-outlined text-sm text-primary">work_history</span>
                                {{ $lawyerUser->lawyer->experience }} years experience
                            </span>
                        @endif
                        @if($lawyerUser->lawyer->consultation_fee)
                            <span class="bg-surface-container flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm text-on-surface">
                                <span class="material-symbols-outlined text-sm text-primary">payments</span>
                                Rs. {{ number_format($lawyerUser->lawyer->consultation_fee) }} / session
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="bg-green-50 text-green-700 border border-green-200 px-3 py-1.5 rounded-full text-xs font-semibold flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">verified</span>
                        Verified Lawyer
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: About + Practice Areas --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- About --}}
            @if($lawyerUser->lawyer && $lawyerUser->lawyer->bio)
                <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
                    <h3 class="font-headline-md text-primary font-bold mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">person</span>
                        About
                    </h3>
                    <p class="text-body-md text-on-surface leading-relaxed">{{ $lawyerUser->lawyer->bio }}</p>
                </div>
            @endif

            {{-- Practice Areas --}}
            @if(isset($lawyerUser->lawyer->practiceAreas) && $lawyerUser->lawyer->practiceAreas->count() > 0)
                <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
                    <h3 class="font-headline-md text-primary font-bold mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">gavel</span>
                        Practice Areas
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($lawyerUser->lawyer->practiceAreas as $area)
                            <span class="bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-sm font-label-md">{{ $area->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Related Lawyers --}}
            @if(isset($relatedLawyers) && $relatedLawyers->count() > 0)
                <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
                    <h3 class="font-headline-md text-primary font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">people</span>
                        Similar Lawyers
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach($relatedLawyers as $related)
                            <a href="{{ route('lawyer.profile', $related->id) }}" class="bg-surface-container rounded-xl p-4 hover:shadow-md transition text-center border border-outline-variant">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg mx-auto">
                                    {{ substr($related->name, 0, 1) }}
                                </div>
                                <p class="text-sm font-bold text-on-surface mt-2">{{ $related->name }}</p>
                                <p class="text-xs text-secondary">{{ $related->lawyer->specialization ?? 'General' }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Right: Booking Form --}}
        <div class="space-y-6">
            <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6 sticky top-20">
                <h3 class="font-headline-md text-primary font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">calendar_month</span>
                    Book Appointment
                </h3>

                @if($errors->any())
                    <div class="bg-error-container border border-error text-on-error-container px-4 py-3 rounded-xl mb-4 text-sm">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('customer.book', $lawyerUser->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-xs text-secondary font-label-md block mb-1">Select Date</label>
                        <input type="date" name="appointment_date" required min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}"
                            class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                    </div>
                    <div>
                        <label class="text-xs text-secondary font-label-md block mb-1">Available Time Slots</label>
                        @if(isset($timeSlots) && $timeSlots->count() > 0)
                        <select name="time_slot" required class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                            <option value="">Select a time slot</option>
                            @if(isset($slotsByDate))
                                @foreach($slotsByDate as $date => $slots)
                                    <optgroup label="{{ \Carbon\Carbon::parse($date)->format('l, M d, Y') }}">
                                        @foreach($slots as $slot)
                                            <option value="{{ $slot->slot_time }}" {{ old('time_slot') == $slot->slot_time ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::parse($slot->slot_time)->format('h:i A') }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @else
                                @foreach($timeSlots as $slot)
                                    <option value="{{ $slot->slot_time }}" {{ old('time_slot') == $slot->slot_time ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($slot->slot_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($slot->slot_time)->format('h:i A') }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @else
                        <input type="text" name="time_slot" required placeholder="e.g. 10:30 AM — enter your preferred time"
                            class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                        <p class="text-xs text-secondary mt-1">This lawyer hasn't added availability slots yet — type your preferred time and they will confirm.</p>
                        @endif
                    </div>
                    <div>
                        <label class="text-xs text-secondary font-label-md block mb-1">Describe Your Legal Issue (Optional)</label>
                        <textarea name="message" rows="4" placeholder="Briefly describe your case or legal question..."
                            class="border border-outline-variant rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full resize-none">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary text-on-primary h-12 rounded-xl font-label-md hover:bg-on-primary-container transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">event</span>
                        Book Appointment
                    </button>
                </form>

                @if($lawyerUser->lawyer->consultation_fee)
                    <div class="mt-4 pt-4 border-t border-outline-variant text-center">
                        <p class="text-xs text-secondary">Consultation Fee</p>
                        <p class="text-2xl font-bold text-primary">Rs. {{ number_format($lawyerUser->lawyer->consultation_fee) }}</p>
                        <p class="text-xs text-secondary">per session</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection