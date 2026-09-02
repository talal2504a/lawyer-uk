@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-outline rounded-xl p-8 shadow-sm">
        <div class="text-center mb-8">
            <h1 class="font-playfair text-3xl font-bold text-primary tracking-tight">Create Account</h1>
            <p class="text-on-surface-variant text-sm mt-2">Join LawyerConnect today</p>
        </div>

        @if($errors->any())
            <div class="bg-[#ffdad6] border border-[#ffb4ab] text-[#93000a] px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your full name"
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com"
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Password</label>
                    <input type="password" name="password" required placeholder="Min 6 characters"
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required placeholder="Repeat password"
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Mobile</label>
                    <input type="text" name="mobile" value="{{ old('mobile') }}" required placeholder="+92 300 1234567"
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" required placeholder="Lahore, Karachi..."
                        class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-on-surface-variant mb-2">Register As</label>
                <select name="user_type" id="userType" required onchange="toggleLawyerFields()"
                    class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm bg-white">
                    <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer (Find Lawyers)</option>
                    <option value="lawyer" {{ old('user_type') == 'lawyer' ? 'selected' : '' }}>Lawyer (Offer Services)</option>
                </select>
            </div>

            <!-- Lawyer-specific fields -->
            <div id="lawyerFields" class="hidden space-y-5 pt-5 border-t border-outline">
                <h3 class="font-semibold text-primary">Lawyer Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization') }}" placeholder="Criminal Law, Family Law, etc."
                            class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Experience (Years)</label>
                        <input type="number" name="experience" value="{{ old('experience') }}" min="0" placeholder="5"
                            class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-2">Bio</label>
                    <textarea name="bio" rows="3" placeholder="Tell us about yourself..."
                        class="w-full border border-outline rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">{{ old('bio') }}</textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-on-primary h-12 rounded-lg font-bold hover:bg-primary-container transition shadow-sm text-sm">
                Create Account
            </button>
        </form>

        <p class="text-center text-on-surface-variant mt-6 text-sm">
            Already have an account? <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Login</a>
        </p>
    </div>
</div>

<script>
function toggleLawyerFields() {
    const userType = document.getElementById('userType').value;
    const lawyerFields = document.getElementById('lawyerFields');
    if (userType === 'lawyer') {
        lawyerFields.classList.remove('hidden');
    } else {
        lawyerFields.classList.add('hidden');
    }
}
toggleLawyerFields();
</script>
@endsection