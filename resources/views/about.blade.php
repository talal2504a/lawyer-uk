<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About - LegalConnect Pakistan</title>
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
            
            <div class="max-w-4xl mx-auto px-4 py-16">
                <div class="about-section bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-[#bfc9bd] transform transition-all duration-700 hover:shadow-md">
                  <h1 class="font-playfair text-3xl md:text-4xl font-bold text-primary mb-6">About LegalConnect Pakistan</h1>
                  <p class="font-inter text-base md:text-lg text-gray-700 leading-relaxed mt-4">
                    LegalConnect Pakistan is Pakistan’s trusted digital platform that bridges the gap between 
                    individuals seeking legal help and experienced lawyers across the country. 
                    We understand that finding the right lawyer – whether for corporate disputes, family matters, 
                    criminal defense, or property cases – can be overwhelming. That’s why we created a 
                    transparent, easy‑to‑use system where you can search by city, specialization, and experience, 
                    view verified profiles, and book consultations online.
                  </p>
                  <p class="font-inter text-base md:text-lg text-gray-700 leading-relaxed mt-4">
                    Our mission is to make legal assistance accessible, efficient, and stress‑free. 
                    Every lawyer on our platform undergoes a verification process, and we provide secure 
                    chat, appointment scheduling, and payment options. Whether you are a client looking 
                    for justice or a lawyer wanting to grow your practice, LegalConnect Pakistan is here to 
                    serve you with integrity and excellence.
                  </p>
                  <p class="font-inter text-base md:text-lg text-gray-700 leading-relaxed mt-4">
                    Based in Lahore and serving clients nationwide, we are committed to upholding the 
                    highest standards of legal professionalism. Trust us to connect you with the expertise 
                    you need, when you need it most.
                  </p>
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
