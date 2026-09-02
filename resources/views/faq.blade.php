<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQ - LegalConnect Pakistan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004b24',
                    },
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-[#f8f9fa]">
    <div id="page-shell" class="transition-transform duration-500 ease-in-out will-change-transform">
        @include('components.navbar')
        <main class="pt-16">
            @include('components.hero')
            
            <div class="max-w-4xl mx-auto px-4 py-16 bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-[#bfc9bd] my-16">
                <div class="faq-section">
                  <h1 class="font-playfair text-3xl md:text-4xl font-bold text-primary text-center">Frequently Asked Questions</h1>
                  <p class="font-inter text-center text-gray-600 mt-2">Find answers to common questions about LegalConnect Pakistan</p>

                  <div class="mt-10 space-y-6">
                    <!-- Customer FAQs -->
                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">1. How do I find a lawyer?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Simply go to the "Find Lawyers" page, filter by city, specialization, or rating, and browse lawyer profiles. Click "View Profile" to see full details and book a consultation.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">2. Is it free to search for lawyers?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Yes, searching and viewing lawyer profiles is completely free. You only pay the consultation fee when you book an appointment.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">3. How are lawyers verified?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Every lawyer undergoes a verification process where we check their bar council ID, experience documents, and credentials. Verified lawyers receive a gold badge on their profile.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">4. Can I cancel or reschedule an appointment?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Yes, you can cancel or request reschedule from your "My Appointments" page. Cancellation policies depend on the lawyer’s terms, but most allow free cancellation up to 24 hours before the meeting.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">5. How do I pay for a consultation?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Payments are made online via credit card, debit card, or bank transfer. Some lawyers may also accept cash for in-person meetings. You’ll receive a payment receipt after booking.</p>
                    </div>

                    <!-- Lawyer FAQs -->
                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">6. How can I register as a lawyer?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Click "Register" on the homepage, select "Lawyer Registration", fill in your details (name, bar council ID, experience, specialization, etc.), and upload your profile photo. Our admin team will verify and approve your account within 2-3 working days.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">7. Is there any registration fee for lawyers?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Currently, registration is free for lawyers. We may introduce nominal verification fees in the future, but you will be notified in advance.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">8. How do I manage my appointments as a lawyer?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">After logging into your lawyer dashboard, go to "Appointments" to see all booking requests. You can accept, reject, or reschedule appointments and update their status (pending/confirmed/completed).</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">9. Can I chat with clients before accepting a case?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">Yes, each case request has a built-in chat feature. You can discuss case details, ask questions, and clarify requirements before accepting or rejecting the case.</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                      <h3 class="font-playfair text-xl font-semibold text-primary">10. What if I have more questions?</h3>
                      <p class="font-inter text-gray-700 mt-2 leading-relaxed">You can contact our support team at <a href="mailto:support@justicelegacy.pk" class="text-primary hover:underline">support@justicelegacy.pk</a> or call our helpline at +92 42 1234567. We’re available Monday to Friday, 9 AM – 6 PM.</p>
                    </div>
                  </div>
                </div> 
            </div>
        </main>

        @include('components.footer')
    </div>

    @include('components.auth-drawer')
    @include('components.lawyers-directory')
    @include('components.about-drawer')
    @include('components.faq-drawer')
    @include('components.tos-drawer')
</body>
</html>
