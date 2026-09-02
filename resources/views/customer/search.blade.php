@extends('layouts.customer')

@section('title', 'Find Lawyers')
@section('page-title', 'Find Lawyers')

@section('content')
<div class="space-y-6">
    {{-- Search Filters --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
        <form action="{{ route('customer.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="text-xs text-secondary font-label-md block mb-1">Lawyer Name</label>
                <input type="text" name="name" placeholder="Search by name..." value="{{ request('name') }}"
                    class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
            </div>
            <div>
                <label class="text-xs text-secondary font-label-md block mb-1">City</label>
                <select name="city" class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                    <option value="">All Cities</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs text-secondary font-label-md block mb-1">Specialization</label>
                <select name="specialization" class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                    <option value="">All Specializations</option>
                    @foreach($specializations as $spec)
                        <option value="{{ $spec->name }}" {{ request('specialization') == $spec->name ? 'selected' : '' }}>{{ $spec->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs text-secondary font-label-md block mb-1">Gender</label>
                <select name="gender" class="h-11 border border-outline-variant rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-surface text-on-surface w-full">
                    <option value="">All</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-primary text-on-primary h-11 rounded-lg font-label-md hover:bg-on-primary-container transition-colors flex items-center gap-2 px-6 w-full justify-center">
                    <span class="material-symbols-outlined text-lg">search</span>
                    Search
                </button>
            </div>
        </form>
    </div>

    {{-- Results Count --}}
    <div class="flex items-center justify-between">
        <p class="text-secondary text-sm font-label-md">{{ $lawyers->total() }} lawyers found</p>
        @if(request()->hasAny(['name', 'city', 'specialization', 'gender']))
            <a href="{{ route('customer.search') }}" class="text-primary text-sm font-label-md hover:underline flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">close</span>
                Clear Filters
            </a>
        @endif
    </div>

    {{-- Results Grid --}}
    @if($lawyers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($lawyers as $lawyerUser)
                <div class="bg-surface-container-low border border-outline-variant rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 lawyer-card-shadow">
                    {{-- Card Header --}}
                    <div class="h-44 bg-gradient-to-br from-primary to-primary-container flex items-center justify-center relative">
                        @if($lawyerUser->lawyer && $lawyerUser->lawyer->profile_image)
                            <img src="{{ asset('storage/' . $lawyerUser->lawyer->profile_image) }}" alt="{{ $lawyerUser->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-md">
                        @else
                            <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-white text-3xl font-bold shadow-md">
                                {{ substr($lawyerUser->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-full font-label-md">
                            {{ $lawyerUser->lawyer->specialization ?? 'General' }}
                        </div>
                    </div>
                    {{-- Card Body --}}
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-on-surface font-headline-md">{{ $lawyerUser->name }}</h3>
                        <p class="text-primary text-sm font-label-md mt-0.5">{{ $lawyerUser->lawyer->specialization ?? 'General Practice' }}</p>
                        <div class="mt-3 space-y-1.5 text-sm text-secondary">
                            @if($lawyerUser->city)
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span>{{ $lawyerUser->city }}</span>
                                </div>
                            @endif
                            @if($lawyerUser->lawyer->experience)
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">work_history</span>
                                    <span>{{ $lawyerUser->lawyer->experience }} years experience</span>
                                </div>
                            @endif
                            @if($lawyerUser->lawyer->consultation_fee)
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">payments</span>
                                    <span>Rs. {{ number_format($lawyerUser->lawyer->consultation_fee) }} / session</span>
                                </div>
                            @endif
                        </div>
<a href="{{ route('customer.lawyer.profile', $lawyerUser->id) }}" class="mt-5 block text-center bg-primary text-on-primary py-2.5 rounded-lg font-label-md hover:bg-on-primary-container transition-colors text-sm">
                            View Profile
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $lawyers->links() }}
        </div>
    @else
        <div class="bg-surface-container-low border border-outline-variant rounded-xl p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant">search_off</span>
            <p class="text-secondary text-lg mt-4">No lawyers found matching your criteria.</p>
            <a href="{{ route('customer.search') }}" class="text-primary font-semibold hover:underline mt-3 inline-block text-sm">Clear filters and try again</a>
        </div>
    @endif
</div>
@endsection