@extends('layouts.lawyer')
@section('title', 'My Profile')
@section('page-title', 'Edit Professional Profile')

@section('content')
<div class="max-w-[850px] mx-auto">
    <header class="mb-stack-md">
        <h1 class="text-headline-lg font-bold text-primary mb-2">Edit Professional Profile</h1>
        <p class="text-on-surface-variant">Update your details to maintain visibility and trust within the legal network.</p>
    </header>

    <form action="{{ route('lawyer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-gutter">
        @csrf

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md flex flex-col items-center sm:flex-row sm:gap-gutter">
            <div class="relative group">
                @if($lawyer->profile_image)
                    <img alt="Profile" class="w-[100px] h-[100px] rounded-full object-cover border-4 border-surface-container" src="{{ Storage::url($lawyer->profile_image) }}">
                @else
                    <div class="w-[100px] h-[100px] rounded-full border-4 border-surface-container bg-primary-container/10 flex items-center justify-center"><span class="material-symbols-outlined text-primary text-4xl">person</span></div>
                @endif
                <label class="absolute bottom-0 right-0 bg-primary text-white p-1.5 rounded-full shadow-lg hover:scale-105 transition-transform cursor-pointer"><span class="material-symbols-outlined text-sm">photo_camera</span><input type="file" name="profile_image" accept="image/*" class="hidden"></label>
            </div>
            <div class="text-center sm:text-left mt-4 sm:mt-0">
                <h3 class="font-headline-md text-on-surface">Profile Picture</h3>
                <p class="text-on-surface-variant text-sm mb-3">Upload a high-resolution professional headshot.</p>
                <span class="text-primary font-bold text-sm border-2 border-primary px-4 py-1.5 rounded-lg">Replace Photo</span>
            </div>
        </section>

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md">
            <div class="flex justify-between items-center mb-stack-sm">
                <h3 class="font-headline-md text-on-surface">Basic Information</h3>
                <label class="flex items-center gap-2 text-sm font-semibold text-on-surface-variant"><span>Verified Badge</span><input type="checkbox" name="is_verified" value="1" {{ $lawyer->is_verified ? 'checked' : '' }} class="text-primary rounded focus:ring-primary"></label>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                <div class="space-y-1"><label class="font-label-md text-on-surface">Full Name</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="text" name="name" value="{{ Auth::user()->name }}"></div>
                <div class="space-y-1"><label class="font-label-md text-on-surface">Professional Title</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="text" name="title" value="{{ $lawyer->title ?? 'High Court Advocate' }}"></div>
            </div>
        </section>

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md space-y-stack-md">
            <h3 class="font-headline-md text-on-surface border-b border-outline-variant pb-2">Professional Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                <div class="space-y-1"><label class="font-label-md text-on-surface">Years of Experience</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="number" name="experience" value="{{ $lawyer->experience }}" required></div>
                <div class="space-y-1"><label class="font-label-md text-on-surface">Education</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="text" name="education" value="{{ $lawyer->education ?? 'LL.M.' }}"></div>
            </div>
            <div class="space-y-1"><label class="font-label-md text-on-surface">Primary Specialization</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="text" name="specialization" value="{{ $lawyer->specialization }}" required></div>
            <div class="space-y-1"><label class="font-label-md text-on-surface">Professional Bio</label><textarea class="w-full border-outline-variant border rounded-lg p-4 focus:border-primary focus:ring-1 focus:ring-primary" name="bio" rows="4">{{ $lawyer->bio }}</textarea></div>
        </section>

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md space-y-stack-md">
            <h3 class="font-headline-md text-on-surface">Contact Information</h3>
            <div class="space-y-1"><label class="font-label-md text-on-surface">Office Address</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="text" name="address" value="{{ $lawyer->address }}"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                <div class="space-y-1"><label class="font-label-md text-on-surface">Helpline / Phone</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="tel" name="phone" value="{{ $lawyer->phone ?? Auth::user()->mobile }}"></div>
                <div class="space-y-1"><label class="font-label-md text-on-surface">Professional Email</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="email" name="email_contact" value="{{ $lawyer->email_contact ?? Auth::user()->email }}"></div>
            </div>
            <div class="space-y-1"><label class="font-label-md text-on-surface">Website</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="url" name="website" value="{{ $lawyer->website }}" placeholder="https://"></div>
        </section>

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md">
            <h3 class="font-headline-md text-on-surface mb-stack-sm">Consultation Fee & Policy</h3>
            <div class="flex flex-col md:flex-row gap-stack-md items-end">
                <div class="flex-1 w-full space-y-1"><label class="font-label-md text-on-surface">Fee (PKR)</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="number" name="consultation_fee" step="0.01" value="{{ $lawyer->consultation_fee ?? 6000 }}" required></div>
                <div class="flex-1 w-full space-y-1"><label class="font-label-md text-on-surface">Session Duration</label><input class="w-full h-12 border-outline-variant border rounded-lg px-4 focus:border-primary focus:ring-1 focus:ring-primary" type="number" name="consultation_duration" value="{{ $lawyer->consultation_duration ?? 45 }}" required></div>
            </div>
            <label class="flex items-center gap-2 mt-4 text-sm text-on-surface-variant"><input type="checkbox" name="has_discount" value="1" {{ $lawyer->has_discount ? 'checked' : '' }} class="text-primary rounded focus:ring-primary"> 10% discount for first consultation</label>
        </section>

        <section class="bg-white border border-outline-variant rounded-xl p-stack-md">
            <h3 class="font-headline-md text-on-surface mb-stack-sm">Practice Areas</h3>
            @if($practiceAreas->count() > 0)
                <ul class="divide-y divide-outline-variant border border-outline-variant rounded-lg overflow-hidden mb-stack-md">
                    @foreach($practiceAreas as $area)
                        <li class="flex justify-between items-center p-4 {{ $loop->odd ? 'bg-white' : 'bg-surface-container-lowest' }} hover:bg-surface-bright transition-colors"><span class="font-label-md text-on-surface">{{ $area->area_name }}</span></li>
                    @endforeach
                </ul>
            @else
                <p class="text-on-surface-variant text-sm">No practice areas added yet.</p>
            @endif
        </section>

        <section class="bg-white border-t-4 border-primary border-x border-b border-outline-variant rounded-xl p-stack-md shadow-sm">
            <h3 class="font-headline-md text-on-surface mb-4">Live Preview</h3>
            <div class="border border-outline-variant rounded-lg p-6 bg-surface-container-low">
                <div class="flex items-center gap-4"><div class="w-16 h-16 rounded-full bg-primary-container/10 flex items-center justify-center"><span class="material-symbols-outlined text-primary text-3xl">person</span></div><div><h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3><p class="text-sm text-on-surface-variant">{{ $lawyer->title ?? 'High Court Advocate' }}</p></div></div>
                <p class="text-sm text-on-surface-variant mt-3 italic">"{{ Str::limit($lawyer->bio ?? 'No bio available', 100) }}"</p>
                <p class="mt-2 font-bold text-primary">PKR {{ number_format($lawyer->consultation_fee ?? 6000) }} — {{ $lawyer->consultation_duration ?? 45 }} min</p>
            </div>
        </section>

        <div class="flex flex-col sm:flex-row-reverse gap-4 pt-stack-md">
            <button class="w-full sm:w-auto bg-primary text-white font-bold py-4 px-12 rounded-lg shadow-sm hover:opacity-90 active:scale-95 transition-all" type="submit">SAVE PROFILE</button>
            <a href="{{ route('lawyer.dashboard') }}" class="w-full sm:w-auto border-2 border-primary text-primary font-bold py-4 px-12 rounded-lg hover:bg-surface-container-high active:scale-95 transition-all text-center">CANCEL</a>
        </div>
    </form>

    <section class="bg-white border border-outline-variant rounded-xl p-stack-md mt-gutter">
        <h3 class="font-headline-md text-on-surface mb-stack-sm">Manage Practice Areas</h3>
        @if($practiceAreas->count() > 0)
            <ul class="divide-y divide-outline-variant border border-outline-variant rounded-lg overflow-hidden mb-stack-md">
                @foreach($practiceAreas as $area)
                    <li class="flex justify-between items-center p-4 {{ $loop->odd ? 'bg-white' : 'bg-surface-container-lowest' }}">
                        <span class="font-label-md text-on-surface">{{ $area->area_name }}</span>
                        <form action="{{ route('lawyer.practice-area.delete', $area->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button type="submit" class="material-symbols-outlined text-error hover:opacity-70 transition-colors">delete</button></form>
                    </li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('lawyer.practice-area.add') }}" method="POST" class="flex gap-2">@csrf<input type="text" name="area_name" required placeholder="Add new practice area" class="flex-1 border-outline-variant border rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary"><button type="submit" class="bg-primary text-white px-5 rounded-lg font-bold hover:opacity-90 flex items-center gap-1"><span class="material-symbols-outlined text-sm">add</span>Add</button></form>
    </section>
</div>
@endsection