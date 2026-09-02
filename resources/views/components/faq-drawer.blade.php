<!-- FAQ Drawer (Slide-over) -->
<div id="faq-drawer" class="hidden fixed inset-0 z-[60]">
    <!-- Smooth Dark Backdrop -->
    <div id="faq-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-none opacity-0 transition-all duration-500" onclick="toggleFaqDrawer()"></div>
    
    <!-- Drawer Panel sliding from right -->
    <div id="faq-panel" class="absolute top-0 right-0 h-full w-full max-w-2xl bg-[#f8f9fa]/95 backdrop-blur-sm shadow-2xl translate-x-full transition-all duration-500 ease-in-out overflow-y-auto">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-[#bfc9bd] bg-white">
            <h2 class="font-['Playfair_Display'] text-xl font-bold text-[#004b24]">FAQs</h2>
            <button onclick="toggleFaqDrawer()" class="p-2 hover:bg-[#f3f4f5] rounded-full transition-all">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-8 md:p-12 space-y-6">
            <div class="bg-white border border-[#bfc9bd] rounded-xl p-8 shadow-sm">
                <h1 class="font-['Playfair_Display'] text-2xl md:text-3xl font-bold text-[#004b24] text-center mb-2">Frequently Asked Questions</h1>
                <p class="font-['Inter'] text-center text-gray-600 mb-8">Find answers to common questions about LegalConnect Pakistan</p>

                <div class="space-y-6">
                    <!-- Customer FAQs -->
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">1. How do I find a lawyer?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Simply go to the "Find Lawyers" section, filter by city, specialization, or rating, and browse lawyer profiles. Click "View Profile" to see full details and book a consultation.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">2. Is it free to search for lawyers?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Yes, searching and viewing lawyer profiles is completely free. You only pay the consultation fee when you book an appointment.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">3. How are lawyers verified?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Every lawyer undergoes a verification process where we check their bar council ID, experience documents, and credentials. Verified lawyers receive a gold badge on their profile.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">4. Can I cancel or reschedule an appointment?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Yes, you can cancel or request reschedule from your "My Appointments" page. Cancellation policies depend on the lawyer’s terms, but most allow free cancellation up to 24 hours before the meeting.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">5. How do I pay for a consultation?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Payments are made online via credit card, debit card, or bank transfer. Some lawyers may also accept cash for in-person meetings. You’ll receive a payment receipt after booking.</p>
                    </div>

                    <!-- Lawyer FAQs -->
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">6. How can I register as a lawyer?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Click "Register" on the homepage, select "Lawyer Registration", fill in your details (name, bar council ID, experience, specialization, etc.), and upload your profile photo. Our admin team will verify and approve your account within 2-3 working days.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">7. Is there any registration fee for lawyers?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Currently, registration is free for lawyers. We may introduce nominal verification fees in the future, but you will be notified in advance.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">8. How do I manage my appointments as a lawyer?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">After logging into your lawyer dashboard, go to "Appointments" to see all booking requests. You can accept, reject, or reschedule appointments and update their status (pending/confirmed/completed).</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">9. Can I chat with clients before accepting a case?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">Yes, each case request has a built-in chat feature. You can discuss case details, ask questions, and clarify requirements before accepting or rejecting the case.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-['Playfair_Display'] text-base font-bold text-[#004b24]">10. What if I have more questions?</h3>
                        <p class="font-['Inter'] text-sm text-gray-700 mt-2 leading-relaxed">You can contact our support team at <a href="mailto:support@legalconnect.pk" class="text-[#004b24] hover:underline font-bold">support@legalconnect.pk</a> or call our helpline at +92 42 1234567. We’re available Monday to Friday, 9 AM – 6 PM.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openFaqDrawer() {
        const drawer = document.getElementById('faq-drawer');
        const overlay = document.getElementById('faq-overlay');
        const panel = document.getElementById('faq-panel');
        
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

    function toggleFaqDrawer() {
        const drawer = document.getElementById('faq-drawer');
        const overlay = document.getElementById('faq-overlay');
        const panel = document.getElementById('faq-panel');

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
