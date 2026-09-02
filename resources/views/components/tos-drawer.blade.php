<!-- Terms of Service Drawer (Slide-over) -->
<div id="tos-drawer" class="hidden fixed inset-0 z-[60]">
    <!-- Smooth Dark Backdrop -->
    <div id="tos-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-none opacity-0 transition-all duration-500" onclick="toggleTosDrawer()"></div>
    
    <!-- Drawer Panel sliding from right -->
    <div id="tos-panel" class="absolute top-0 right-0 h-full w-full max-w-2xl bg-[#f8f9fa]/95 backdrop-blur-sm shadow-2xl translate-x-full transition-all duration-500 ease-in-out overflow-y-auto">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-[#bfc9bd] bg-white">
            <h2 class="font-['Playfair_Display'] text-xl font-bold text-[#004b24]">Terms of Service</h2>
            <button onclick="toggleTosDrawer()" class="p-2 hover:bg-[#f3f4f5] rounded-full transition-all">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-8 md:p-12 space-y-6">
            <div class="bg-white border border-[#bfc9bd] rounded-xl p-8 shadow-sm">
                <div class="tos-section">
                  <h1 class="font-['Playfair_Display'] text-2xl md:text-3xl font-bold text-[#004b24] text-center">Terms of Service</h1>
                  <p class="font-['Inter'] text-center text-gray-500 mt-2">Last updated: 15 June 2026</p>

                  <div class="mt-10 space-y-6 font-['Inter'] text-sm text-gray-700 leading-relaxed">
                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">1. Acceptance of Terms</h2>
                      <p class="mt-1">By accessing or using the LegalConnect Pakistan website (the “Platform”), you agree to be bound by these Terms of Service. If you do not agree, please do not use the Platform.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">2. Definitions</h2>
                      <p class="mt-1"><strong>“Customer”</strong> – any individual seeking legal services through the Platform.<br>
                      <strong>“Lawyer”</strong> – a verified legal professional who offers consultations via the Platform.<br>
                      <strong>“Admin”</strong> – the Platform operator responsible for verification and management.<br>
                      <strong>“Appointment”</strong> – a scheduled consultation between a Customer and a Lawyer.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">3. Eligibility</h2>
                      <p class="mt-1">You must be at least 18 years old to use the Platform. Lawyers must hold a valid bar council license in Pakistan and provide accurate credentials for verification.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">4. Customer Responsibilities</h2>
                      <p class="mt-1">Customers agree to provide truthful information when registering and booking appointments. Any misuse of the Platform, including harassment of lawyers, may result in account suspension.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">5. Lawyer Responsibilities</h2>
                      <p class="mt-1">Lawyers must maintain accurate profile information, respond to case requests in a timely manner, and honor confirmed appointments. Failure to do so may lead to removal from the Platform.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">6. Appointment & Payment</h2>
                      <p class="mt-1">Consultation fees are set by individual lawyers. Customers pay an advance (if required) at the time of booking. The remaining fee is paid as agreed with the lawyer. Refunds are subject to the lawyer’s cancellation policy.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">7. Cancellation & Rescheduling</h2>
                      <p class="mt-1">Customers may cancel or reschedule an appointment up to 24 hours before the scheduled time without penalty. Late cancellations may forfeit the advance payment. Lawyers may reschedule with customer consent.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">8. Verification & Liability</h2>
                      <p class="mt-1">LegalConnect Pakistan verifies lawyer credentials but does not guarantee legal outcomes. We act as an intermediary; any legal advice given by lawyers is solely their responsibility. Customers are advised to exercise due diligence.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">9. Prohibited Conduct</h2>
                      <p class="mt-1">You shall not: (a) use the Platform for any illegal purpose; (b) share false or misleading information; (c) attempt to hack, scrape, or disrupt the Platform; (d) impersonate another person or entity.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">10. Intellectual Property</h2>
                      <p class="mt-1">All content on the Platform (logos, text, graphics, code) is owned by LegalConnect Pakistan. You may not copy, modify, or distribute without written permission.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">11. Limitation of Liability</h2>
                      <p class="mt-1">To the maximum extent permitted by law, LegalConnect Pakistan shall not be liable for any indirect, incidental, or consequential damages arising from your use of the Platform.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">12. Termination</h2>
                      <p class="mt-1">We reserve the right to suspend or terminate accounts that violate these Terms. You may delete your account at any time by contacting support.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">13. Changes to Terms</h2>
                      <p class="mt-1">We may update these Terms from time to time. Continued use of the Platform constitutes acceptance of the revised Terms.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">14. Governing Law</h2>
                      <p class="mt-1">These Terms shall be governed by the laws of the Islamic Republic of Pakistan. Any disputes shall be resolved in the courts of Lahore.</p>
                    </div>

                    <div>
                      <h2 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">15. Contact Us</h2>
                      <p class="mt-1">For questions about these Terms, email us at <a href="mailto:legal@legalconnect.pk" class="text-[#004b24] hover:underline font-bold">legal@legalconnect.pk</a>.</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openTosDrawer() {
        const drawer = document.getElementById('tos-drawer');
        const overlay = document.getElementById('tos-overlay');
        const panel = document.getElementById('tos-panel');
        
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

    function toggleTosDrawer() {
        const drawer = document.getElementById('tos-drawer');
        const overlay = document.getElementById('tos-overlay');
        const panel = document.getElementById('tos-panel');

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
