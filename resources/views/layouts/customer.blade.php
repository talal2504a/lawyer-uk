<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LegalConnect | @yield('title', 'Customer Portal')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#004b24",
                        "primary-container": "#006633",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#8ce1a1",
                        "primary-fixed": "#9ff6b4",
                        "primary-fixed-dim": "#84d999",
                        "on-primary-fixed": "#00210c",
                        "on-primary-fixed-variant": "#005228",
                        "secondary": "#5d5f5f",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#dfe0e0",
                        "on-secondary-container": "#616363",
                        "surface": "#f8f9fa",
                        "surface-dim": "#d9dadb",
                        "surface-bright": "#f8f9fa",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f4f5",
                        "surface-container": "#edeeef",
                        "surface-container-high": "#e7e8e9",
                        "surface-container-highest": "#e1e3e4",
                        "on-surface": "#191c1d",
                        "on-surface-variant": "#3f4940",
                        "surface-variant": "#e1e3e4",
                        "background": "#f8f9fa",
                        "on-background": "#191c1d",
                        "outline": "#6f7a6f",
                        "outline-variant": "#bfc9bd",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "tertiary": "#553c00",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#705313",
                        "tertiary-fixed": "#ffdea5",
                        "tertiary-fixed-dim": "#e9c176",
                        "on-tertiary-fixed": "#261900",
                        "on-tertiary-fixed-variant": "#5d4201"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1200px",
                        "gutter": "24px",
                        "stack-sm": "12px",
                        "stack-md": "24px",
                        "margin-desktop": "48px",
                        "base": "8px",
                        "margin-mobile": "16px",
                        "stack-lg": "48px"
                    },
                    "fontFamily": {
                        "headline-md": ["Playfair Display"],
                        "headline-lg-mobile": ["Playfair Display"],
                        "caption": ["Inter"],
                        "headline-xl": ["Playfair Display"],
                        "body-md": ["Inter"],
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Playfair Display"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "caption": ["12px", {"lineHeight": "1.4", "fontWeight": "400"}],
                        "headline-xl": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .active-nav {
            background-color: #006633 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }
        .page-enter {
            animation: slideIn 0.35s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideOutRight {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(30px); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .dashboard-slide-in {
            animation: slideInRight 0.4s ease-out forwards;
        }
        .lawyer-card-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #004b24;
            border-radius: 4px;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">

<!-- Whole Dashboard Wrapper - slides as one unit -->
<div id="dashboard-wrapper" class="flex flex-col md:flex-row dashboard-slide-in">

    <!-- Sidebar -->
    <aside id="sidebar" class="hidden md:block bg-surface-container-low border-r border-outline-variant h-screen w-64 flex flex-col flex-shrink-0 sticky top-0 z-30">
        <div class="px-6 pt-6 pb-4 border-b border-outline-variant">
            <a id="logo-link" href="#" class="text-[24px] font-bold text-primary font-['Playfair_Display'] hover:opacity-80 transition-opacity">
                LegalConnect
            </a>
            <p class="text-sm text-secondary opacity-70 mt-1 font-['Inter']">Customer Portal</p>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-label-md text-label-md {{ request()->routeIs('customer.dashboard') ? 'active-nav shadow-sm' : 'text-secondary hover:bg-surface-variant hover:text-primary' }}" data-url="{{ route('customer.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-label-md text-label-md {{ request()->routeIs('customer.search') ? 'active-nav shadow-sm' : 'text-secondary hover:bg-surface-variant hover:text-primary' }}" data-url="{{ route('customer.search') }}">
                <span class="material-symbols-outlined">gavel</span>
                <span>Find Lawyers</span>
            </a>
            <a class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-label-md text-label-md {{ request()->routeIs('customer.appointments') ? 'active-nav shadow-sm' : 'text-secondary hover:bg-surface-variant hover:text-primary' }}" data-url="{{ route('customer.appointments') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>My Appointments</span>
            </a>
            <a class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-label-md text-label-md {{ request()->routeIs('customer.profile') ? 'active-nav shadow-sm' : 'text-secondary hover:bg-surface-variant hover:text-primary' }}" data-url="{{ route('customer.dashboard') }}">
                <span class="material-symbols-outlined">person</span>
                <span>My Profile</span>
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-outline-variant">
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-secondary hover:bg-surface-variant hover:text-primary font-label-md text-label-md" href="{{ route('home') }}" target="_blank">
                <span class="material-symbols-outlined">web</span>
                <span>View Site</span>
            </a>
            <div class="mt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-error hover:bg-error-container font-label-md text-label-md">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main id="main-content" class="flex-1 min-h-screen flex flex-col">
        <!-- TopNavBar -->
        <header class="flex justify-between items-center px-gutter w-full h-16 sticky top-0 z-40 bg-surface border-b border-outline-variant">
            <div class="flex items-center gap-4 flex-1">
                <h2 class="font-headline-md text-headline-md font-bold text-primary page-enter" id="page-title-text">@yield('page-title', 'Customer Portal')</h2>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative cursor-pointer">
                    <div class="md:hidden">
                        <button id="sidebar-toggle" class="text-primary focus:outline-none p-1 rounded hover:bg-[#f3f4f5] transition-colors">
                            <span class="material-symbols-outlined text-2xl" id="sidebar-icon">menu</span>
                        </button>
                    </div>
                    <span id="notifications-icon" class="material-symbols-outlined text-primary text-[28px] cursor-pointer">notifications</span>
                    <!-- Notifications Dropdown -->
                    <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900">Recent Notifications</h3>
                            <ul class="mt-2 space-y-2">
                                @php $notifications = Auth::user()?->notifications()?->latest()?->take(5)?->get(); @endphp
                                @if($notifications && $notifications->count())
                                    @foreach($notifications as $notification)
                                        <li class="text-xs text-gray-700">{{ $notification->data['message'] ?? 'Notification' }}</li>
                                    @endforeach
                                @else
                                    <li class="text-xs text-gray-500">No new notifications</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <span class="absolute -top-1 -right-1 bg-error text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-surface">2</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="font-label-md text-on-surface">{{ Auth::user()->name ?? 'Customer' }}</p>
                        <p class="text-caption text-secondary">Standard Account</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary border border-outline-variant">
                        <span class="material-symbols-outlined">account_circle</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div id="flash-messages" class="px-gutter pt-4 max-w-container-max mx-auto w-full">
            @if(session('success'))
                <div class="bg-primary-fixed/30 border border-primary-fixed text-on-primary-fixed-variant px-5 py-4 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">check_circle</span>
                    <span class="font-label-md">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-error-container             <button id="sidebar-toggle" class="md:hidden text-[#004b24] focus:outline-none p-1 rounded hover:bg-[#f3f4f5] transition-colors mr-2" aria-label="Toggle sidebar">
                <span class="material-symbols-outlined text-2xl block" id="sidebar-icon">menu</span>
            </button>        <span class="font-label-md">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <div id="page-content" class="p-gutter max-w-container-max mx-auto w-full flex-1 page-enter">
            @yield('content')
        </div>
    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarIcon = document.getElementById('sidebar-icon');

        if (mobileMenuBtn && mobileMenu && menuIcon) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                menuIcon.textContent = mobileMenu.classList.contains('hidden') ? 'menu' : 'close';
            });
        }

        if (sidebarToggle && sidebar && sidebarIcon) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebarIcon.textContent = sidebar.classList.contains('hidden') ? 'menu' : 'close';
            });
        }
    });

document.addEventListener('DOMContentLoaded', function() {
    const dashboardWrapper = document.getElementById('dashboard-wrapper');
    const logoLink = document.getElementById('logo-link');
    const navLinks = document.querySelectorAll('.nav-link');

    // Logo click - slide entire dashboard out to right, then redirect
    logoLink.addEventListener('click', function(e) {
        e.preventDefault();
        dashboardWrapper.style.animation = 'slideOutRight 0.3s ease-in forwards';
        setTimeout(function() {
            window.location.href = '{{ route("home") }}';
        }, 300);
    });

    // Nav links - AJAX load with slide animation
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            if (!url) return;

            // Update active states
            navLinks.forEach(function(l) {
 l.classList.remove('active-nav', 'shadow-sm');
            });
            this.classList.add('active-nav', 'shadow-sm');

            var contentDiv = document.getElementById('page-content');
            contentDiv.style.animation = 'slideOutRight 0.2s ease-in forwards';

            setTimeout(function() {
                contentDiv.innerHTML = '<div class="flex justify-center items-center h-64"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>';
                contentDiv.style.animation = 'none';

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' }
                })
                .then(function(response) { return response.text(); })
                .then(function(html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newTitle = doc.querySelector('title')?.textContent || 'Customer Portal';
                    var newPageTitle = doc.querySelector('[id="page-title"]')?.textContent || 'Customer Portal';
                    var newContent = doc.querySelector('#page-content')?.innerHTML || doc.body.innerHTML;
                    document.title = newTitle;
                    var h2 = document.querySelector('h2.font-headline-md');
                    if (h2) h2.textContent = newPageTitle;
                    contentDiv.innerHTML = newContent;

                    // Manually execute any scripts in the new content
                    var scripts = contentDiv.querySelectorAll('script');
                    scripts.forEach(function(oldScript) {
                        var newScript = document.createElement('script');
                        Array.from(oldScript.attributes).forEach(function(attr) {
                            newScript.setAttribute(attr.name, attr.value);
                        });
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                        oldScript.parentNode.replaceChild(newScript, oldScript);
                    });

                    contentDiv.style.animation = 'slideInRight 0.35s ease-out forwards';
                })
                .catch(function(error) {
                    console.error('Error loading page:', error);
                    contentDiv.innerHTML = '<div class="text-center py-8 text-error">Error loading page. Please refresh.</div>';
                    contentDiv.style.animation = 'slideInRight 0.35s ease-out forwards';
                });
            }, 200);
        });
    });
    // Notifications toggle
    const notifIcon = document.getElementById('notifications-icon');
    const notifDropdown = document.getElementById('notifications-dropdown');
    if (notifIcon && notifDropdown) {
        notifIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            notifDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!notifDropdown.contains(e.target) && e.target !== notifIcon) {
                notifDropdown.classList.add('hidden');
            }
        });
    }
});
</script>

@stack('scripts')
</body>
</html>