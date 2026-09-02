<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $lawyer['name'] }} - Profile</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#004b24",
                        "primary-container": "#006633",
                        "on-primary-container": "#8ce1a1",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f4f5",
                        "outline-variant": "#bfc9bd",
                        "background": "#f8f9fa",
                        "on-surface": "#191c1d",
                        "on-surface-variant": "#3f4940"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-surface font-['Inter'] antialiased">
    
    @include('components.navbar')
    
    <main class="pt-16">
        <div class="max-w-6xl mx-auto py-10 px-4 md:px-[48px]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-8 space-y-6">
                    
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col sm:flex-row gap-6 items-center sm:items-start">
                        <div class="relative shrink-0">
                            <img alt="{{ $lawyer['name'] }}" class="w-32 h-32 rounded-xl object-cover border-2 border-primary" src="{{ $lawyer['img'] }}"/>
                            <div class="absolute -bottom-2 -right-2 bg-primary-container text-white px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow text-[11px] font-bold">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                                <span>Verified</span>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2 text-center sm:text-left">
                            <h1 class="font-['Playfair_Display'] text-3xl font-bold text-primary">{{ $lawyer['name'] }}</h1>
                            <p class="text-sm text-gray-500 font-medium italic">{{ $lawyer['title'] }} — {{ $lawyer['subtitle'] }}</p>
                            
                            <div class="flex flex-wrap justify-center sm:justify-start gap-2 pt-2">
                                <span class="bg-surface-container-low border border-outline-variant rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-primary text-sm">work_history</span> {{ $lawyer['experience'] }}
                                </span>
                                <span class="bg-surface-container-low border border-outline-variant rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-primary text-sm">school</span> {{ $lawyer['education'] }}
                                </span>
                                <span class="bg-surface-container-low border border-outline-variant rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-amber-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span> {{ $lawyer['rating'] }} ({{ $lawyer['reviews_count'] }})
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 space-y-3">
                        <h2 class="font-['Playfair_Display'] text-lg font-bold text-primary border-b border-outline-variant pb-1">Biography</h2>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $lawyer['bio_1'] }}</p>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $lawyer['bio_2'] }}</p>
                    </div>

                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
                        <h2 class="font-['Playfair_Display'] text-lg font-bold text-primary border-b border-outline-variant pb-1 mb-4">Practice Areas</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($lawyer['specs'] as $spec)
                                <div class="flex items-center p-3 bg-surface-container-low rounded-lg border border-outline-variant">
                                    <span class="material-symbols-outlined text-primary mr-2">gavel</span>
                                    <span class="text-xs font-bold text-on-surface">{{ $spec }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 space-y-4">
                        <h2 class="font-['Playfair_Display'] text-lg font-bold text-primary border-b border-outline-variant pb-1">Contact Details</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex gap-3">
                                <div class="bg-primary-container p-2.5 rounded-lg text-white h-fit"><span class="material-symbols-outlined">location_on</span></div>
                                <div>
                                    <h3 class="text-xs font-bold text-primary uppercase tracking-wide">Chambers</h3>
                                    <p class="text-xs text-gray-700 mt-0.5">{{ $lawyer['address'] }}</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="bg-primary-container p-2.5 rounded-lg text-white h-fit"><span class="material-symbols-outlined">call</span></div>
                                <div>
                                    <h3 class="text-xs font-bold text-primary uppercase tracking-wide">Helpline</h3>
                                    <p class="text-xs text-gray-700 mt-0.5">{{ $lawyer['phone'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-4">
                    <div class="bg-surface-container-lowest border-t-4 border-primary border-x border-b border-outline-variant rounded-b-xl rounded-t-lg p-5 space-y-5 sticky top-6 shadow-md">
                        <div>
                            <h3 class="font-['Playfair_Display'] text-lg font-bold text-primary">Book Consultation</h3>
                            <p class="text-xs text-on-surface-variant">Secure your custom time slot instantly.</p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Select Date</label>
                            <div class="grid grid-cols-7 gap-1 text-center text-[11px] font-bold text-on-surface-variant">
                                <span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span><span>S</span>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">15</div>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">16</div>
                                <div class="py-1.5 bg-primary text-white rounded cursor-pointer shadow dynamic-day">17</div>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">18</div>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">19</div>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">20</div>
                                <div class="py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day">21</div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Select Time Slot</label>
                            <div class="grid grid-cols-2 gap-2 text-xs font-semibold">
                                <button class="border p-2 rounded-lg hover:bg-primary-container hover:text-white transition-all text-slot-btn">09:30 AM</button>
                                <button class="border p-2 rounded-lg hover:bg-primary-container hover:text-white transition-all text-slot-btn">11:00 AM</button>
                                <button class="bg-primary-container text-white p-2 rounded-lg shadow text-slot-btn">03:30 PM</button>
                                <button class="border p-2 rounded-lg hover:bg-primary-container hover:text-white transition-all text-slot-btn">05:00 PM</button>
                            </div>
                        </div>

                        <div class="bg-surface-container-low p-3.5 rounded-lg border border-outline-variant space-y-1.5 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-on-surface-variant">Consultation Fee</span>
                                <span class="font-bold text-primary text-sm">{{ $lawyer['fee'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-on-surface-variant">Session Window</span>
                                <span class="font-medium text-on-surface">45 Minutes Standard</span>
                            </div>
                        </div>

                        <button onclick="alert('🎉 Success! Consultation request processed for {{ $lawyer['name'] }}.')" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-xs hover:bg-[#005228] transition-all shadow-sm">
                            Book Appointment Now
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    @include('components.footer')
    @include('components.lawyers-directory')

    <script>
        // Day Selection Micro-interaction
        document.querySelectorAll('.dynamic-day').forEach(day => {
            day.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.dynamic-day').forEach(d => d.className = "py-1.5 hover:bg-surface-container-low rounded cursor-pointer border dynamic-day");
                this.className = "py-1.5 bg-primary text-white rounded cursor-pointer shadow dynamic-day";
            });
        });

        // Time Slot Micro-interaction
        document.querySelectorAll('.text-slot-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.text-slot-btn').forEach(b => b.className = "border p-2 rounded-lg hover:bg-primary-container hover:text-white transition-all text-slot-btn");
                this.className = "bg-primary-container text-white p-2 rounded-lg shadow text-slot-btn";
            });
        });
    </script>

</body>
</html>