@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white border border-outline rounded-xl p-8 shadow-sm">
        <div class="text-center mb-8">
            <h1 class="font-playfair text-3xl font-bold text-primary tracking-tight">Welcome Back</h1>
            <p class="text-on-surface-variant text-sm mt-2">Login to your LawyerConnect account</p>
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

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-on-surface-variant mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com"
                    class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-on-surface-variant mb-2">Password</label>
                <input type="password" name="password" required placeholder="Enter your password"
                    class="w-full h-12 border border-outline rounded-lg px-4 focus:ring-2 focus:ring-primary focus:border-primary transition text-sm">
            </div>

            <button type="submit" class="w-full bg-primary text-on-primary h-12 rounded-lg font-bold hover:bg-primary-container transition shadow-sm text-sm">
                Login
            </button>
        </form>

        <p class="text-center text-on-surface-variant mt-6 text-sm">
            Don't have an account? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Register</a>
        </p>
    </div>
</div>
@endsection