<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LawyerConnect - @yield('title', 'Home')</title>
    <meta name="description" content="@yield('description', 'Find and book verified, experienced lawyers across Pakistan — criminal, family, corporate and property law advocates. Legal services now digitally accessible.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="-RjVOo5LUxC08Hu67VgStmjXwDptaGtury-RZdeHwwA">
    <!-- Adsterra Popunder -->
    <script src="https://pl31149123.profitableratecpmnetwork.com/a6/c7/d0/a6c7d0586688616d7f2c4da41dc9f7df.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004b24',
                        'primary-container': '#006633',
                        'on-primary': '#ffffff',
                        'on-primary-container': '#8ce1a1',
                        accent: '#C5A059',
                        surface: '#f8f9fa',
                        'surface-container': '#f3f4f5',
                        'surface-container-high': '#e7e8e9',
                        'on-surface': '#191c1d',
                        'on-surface-variant': '#3f4940',
                        outline: '#bfc9bd',
                        'outline-variant': '#e0e0e0',
                    },
                    fontFamily: {
                        playfair: ['Playfair Display', 'serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'sm': '0.25rem',
                        'DEFAULT': '0.5rem',
                        'md': '0.75rem',
                        'lg': '1rem',
                        'xl': '1.5rem',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .font-playfair { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body x-data="{ loginOpen: {{ $errors->any() || session('error') ? 'true' : 'false' }} }" class="bg-surface text-on-surface min-h-screen flex flex-col">
    <!-- Adsterra Social Bar -->
    <script src="https://pl31149124.profitableratecpmnetwork.com/02/6f/8c/026f8cab1c38dfdcb3c1e352e8b16bc7.js"></script>
    <!-- Navbar -->
    <nav class="bg-primary text-on-primary shadow-sm sticky top-0 z-50 border-b border-primary-container">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="font-playfair text-xl font-bold tracking-tight">LawyerConnect</a>
                <div class="hidden md:flex items-center gap-6">
                    @auth
                        <a href="{{ route('customer.search') }}" class="hover:text-on-primary-container transition text-sm font-medium">Find Lawyers</a>
                        @if(Auth::user()->isCustomer())
                            <a href="{{ route('customer.dashboard') }}" class="hover:text-on-primary-container transition text-sm font-medium">Dashboard</a>
                            <a href="{{ route('customer.appointments') }}" class="hover:text-on-primary-container transition text-sm font-medium">My Appointments</a>
                        @elseif(Auth::user()->isLawyer())
                            <a href="{{ route('lawyer.dashboard') }}" class="hover:text-on-primary-container transition text-sm font-medium">Dashboard</a>
                            <a href="{{ route('lawyer.appointments') }}" class="hover:text-on-primary-container transition text-sm font-medium">Appointments</a>
                            <a href="{{ route('lawyer.availability') }}" class="hover:text-on-primary-container transition text-sm font-medium">Availability</a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-on-primary-container transition text-sm font-medium">Dashboard</a>
                            <a href="{{ route('admin.lawyers') }}" class="hover:text-on-primary-container transition text-sm font-medium">Lawyers</a>
                            <a href="{{ route('admin.customers') }}" class="hover:text-on-primary-container transition text-sm font-medium">Customers</a>
                        @endif
                        <div class="flex items-center gap-3 pl-4 border-l border-primary-container">
                            <span class="text-sm text-on-primary-container font-medium">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-primary-container hover:bg-[#007744] px-4 py-2 rounded-lg text-sm font-semibold transition">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="javascript:void(0)" @click="loginOpen = true" class="hover:text-on-primary-container transition text-sm font-medium cursor-pointer">Login</a>
                        <a href="{{ route('register') }}" class="bg-on-primary text-primary px-5 py-2 rounded-lg text-sm font-bold hover:bg-on-primary-container hover:text-primary transition">Register</a>
                    @endauth
                </div>
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-primary-container" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-2">
                @auth
                    <a href="{{ route('customer.search') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Find Lawyers</a>
                    @if(Auth::user()->isCustomer())
                        <a href="{{ route('customer.dashboard') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Dashboard</a>
                        <a href="{{ route('customer.appointments') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">My Appointments</a>
                    @elseif(Auth::user()->isLawyer())
                        <a href="{{ route('lawyer.dashboard') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Dashboard</a>
                        <a href="{{ route('lawyer.appointments') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Appointments</a>
                    @elseif(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Dashboard</a>
                        <a href="{{ route('admin.lawyers') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Lawyers</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Logout ({{ Auth::user()->name }})</button>
                    </form>
                @else
                    <a href="javascript:void(0)" @click="loginOpen = true" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm cursor-pointer">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 px-4 rounded-lg hover:bg-primary-container text-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>
<div x-show="loginOpen" class="fixed inset-y-0 right-0 w-80 bg-white shadow-lg p-6 transform transition-transform duration-300" x-transition:enter="transform translate-x-full" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
    <button @click="loginOpen = false" class="text-gray-500 hover:text-gray-700 mb-4">Close</button>
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required placeholder="Enter your password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        @if($errors->any())
            <div class="bg-[#ffdad6] border border-[#ffb4ab] text-[#93000a] px-3 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="w-full bg-primary text-on-primary py-2 rounded font-bold hover:bg-primary-container">Login</button>
    </form>
</div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-[1200px] mx-auto px-4 mt-6">
            <div class="bg-[#e8f5e9] border border-[#8ce1a1] text-primary px-5 py-4 rounded-lg flex items-center gap-3">
                <span class="material-symbols-outlined text-primary-container">check_circle</span>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-[1200px] mx-auto px-4 mt-6">
            <div class="bg-[#ffdad6] border border-[#ffb4ab] text-[#93000a] px-5 py-4 rounded-lg flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Content -->
    <main class="flex-1 max-w-[1200px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-on-primary mt-12 py-12">
        <!-- Adsterra Banner 468x60 -->
        <div class="text-center mb-6">
            <script>
              atOptions = {
                'key' : '6d6fb04db46d17c22e00ce46ec4ebc68',
                'format' : 'iframe',
                'height' : 60,
                'width' : 468,
                'params' : {}
              };
            </script>
            <script src="https://www.highrevenueformat.com/6d6fb04db46d17c22e00ce46ec4ebc68/invoke.js"></script>
        </div>
        <div class="max-w-[1200px] mx-auto px-4 text-center">
            <p class="font-playfair text-2xl font-bold tracking-tight">LawyerConnect</p>
            <p class="text-on-primary-container text-sm mt-3 max-w-md mx-auto">Connecting Pakistan with trusted legal professionals. Your justice, our legacy.</p>
            <div class="border-t border-primary-container mt-8 pt-6">
                <p class="text-on-primary-container/60 text-xs">&copy; {{ date('Y') }} LawyerConnect. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>