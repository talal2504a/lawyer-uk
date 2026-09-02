<!-- About Drawer (Slide-over) -->
<div id="about-drawer" class="hidden fixed inset-0 z-[60]">
    <!-- Smooth Dark Backdrop -->
    <div id="about-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-none opacity-0 transition-all duration-500" onclick="toggleAboutDrawer()"></div>
    
    <!-- Drawer Panel sliding from right -->
    <div id="about-panel" class="absolute top-0 right-0 h-full w-full max-w-2xl bg-[#f8f9fa]/95 backdrop-blur-sm shadow-2xl translate-x-full transition-all duration-500 ease-in-out overflow-y-auto">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-[#bfc9bd] bg-white">
            <h2 class="font-['Playfair_Display'] text-xl font-bold text-[#004b24]">About Us</h2>
            <button onclick="toggleAboutDrawer()" class="p-2 hover:bg-[#f3f4f5] rounded-full transition-all">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-8 md:p-12 space-y-6">
            <div class="bg-white border border-[#bfc9bd] rounded-xl p-8 shadow-sm">
                <h1 class="font-['Playfair_Display'] text-2xl md:text-3xl font-bold text-[#004b24] mb-6">About LegalConnect Pakistan</h1>
                
                <p class="font-['Inter'] text-sm md:text-base text-gray-700 leading-relaxed">
                    LegalConnect Pakistan is Pakistan’s trusted digital platform that bridges the gap between 
                    individuals seeking legal help and experienced lawyers across the country. 
                    We understand that finding the right lawyer – whether for corporate disputes, family matters, 
                    criminal defense, or property cases – can be overwhelming. That’s why we created a 
                    transparent, easy‑to‑use system where you can search by city, specialization, and experience, 
                    view verified profiles, and book consultations online.
                </p>
                
                <p class="font-['Inter'] text-sm md:text-base text-gray-700 leading-relaxed mt-4">
                    Our mission is to make legal assistance accessible, efficient, and stress‑free. 
                    Every lawyer on our platform undergoes a verification process, and we provide secure 
                    chat, appointment scheduling, and payment options. Whether you are a client looking 
                    for justice or a lawyer wanting to grow your practice, LegalConnect Pakistan is here to 
                    serve you with integrity and excellence.
                </p>
                
                <p class="font-['Inter'] text-sm md:text-base text-gray-700 leading-relaxed mt-4">
                    Based in Lahore and serving clients nationwide, we are committed to upholding the 
                    highest standards of legal professionalism. Trust us to connect you with the expertise 
                    you need, when you need it most.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function openAboutDrawer() {
        const drawer = document.getElementById('about-drawer');
        const overlay = document.getElementById('about-overlay');
        const panel = document.getElementById('about-panel');
        
        // Hide mobile menu if open
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            if (menuIcon) menuIcon.textContent = 'menu';
        }

        drawer.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'backdrop-blur-none');
            overlay.classList.add('opacity-100', 'backdrop-blur-md');
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }, 30);
    }

    function toggleAboutDrawer() {
        const drawer = document.getElementById('about-drawer');
        const overlay = document.getElementById('about-overlay');
        const panel = document.getElementById('about-panel');

        overlay.classList.remove('opacity-100', 'backdrop-blur-md');
        overlay.classList.add('opacity-0', 'backdrop-blur-none');
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        setTimeout(() => {
            drawer.classList.add('hidden');
            document.body.style.overflow = '';
        }, 500);
    }
</script>
