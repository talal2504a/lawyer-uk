<!-- Top-Rated Legal Experts Section -->
<section class="py-12 bg-[#f3f4f5]">
    <div class="max-w-[1200px] mx-auto px-4 md:px-[48px]">
        
        <!-- Section Header With View All Link -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="font-['Playfair_Display'] text-[32px] font-bold text-[#004b24]">Top-Rated Legal Experts</h2>
                <p class="font-['Inter'] text-[16px] text-[#3f4940] mt-1">Highly recommended by our community.</p>
            </div>
            <a href="javascript:void(0);" onclick="toggleDirectoryDrawer()" class="text-[#004b24] font-bold flex items-center gap-1 hover:underline transition-all">
                View All Lawyers
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
        
        <!-- Lawyers Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            @if(isset($dbLawyers) && count($dbLawyers) > 0)
                @foreach(collect($dbLawyers)->take(3) as $key => $dbLawyer)
                    <div class="bg-white rounded-xl overflow-hidden border border-[#bfc9bd] shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="overflow-hidden h-64">
                            <img class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" src="{{ $dbLawyer['img'] }}" alt="{{ $dbLawyer['name'] }}">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-['Playfair_Display'] text-[22px] font-bold text-[#004b24]">{{ $dbLawyer['name'] }}</h3>
                                    <p class="text-[#5d5f5f] font-['Inter'] text-[14px]">{{ $dbLawyer['title'] }}</p>
                                </div>
                                <div class="bg-[#004b24]/10 text-[#004b24] px-2 py-1 rounded flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] fill-1">star</span>
                                    <span class="text-xs font-bold">{{ $dbLawyer['rating'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-[#3f4940] mb-4 text-[14px]">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                <span>{{ $dbLawyer['location'] }}</span>
                            </div>
                            <p class="text-[#3f4940] font-['Inter'] text-[14px] mb-6 line-clamp-2">
                                {{ $dbLawyer['bio_1'] }}
                            </p>
                            <a href="javascript:void(0);" onclick="openLawyerProfile('{{ $dbLawyer['id'] }}')" class="bg-[#004b24] text-white px-6 py-2.5 rounded-xl font-semibold inline-block w-full text-center hover:bg-[#005228] transition-all duration-200">
                                Book Consultation
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback: Show hardcoded lawyers if no DB lawyers -->
                <div class="bg-white rounded-xl overflow-hidden border border-[#bfc9bd] shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="overflow-hidden h-64">
                        <img class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDk66qVdxlQqBDDq8ZKkXlIiI1V0lD0Z_-aHvTGCYjDOyJ3PpZxjO8sYadFZI9E9U2iaL8xwilsRkEptvMzQYpPpvB0wtn6LS98fZi-1GJntpNWjXyccD8qxYJW0Uv7tC4bCfcqHybqgUlxZCMYNtgvP4HBhdX7eSMG5sG1dvMAP_Zah0zYKLP-aRBkPZC-l0sOwalqyKo8imvOs2VPgSDaao4dJqYHubj301o92Q37dj68_uDAksXNdYIt2VTNG8w3ILc-Wk9B6qpZ" alt="Adv. Ahmad Khan">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-['Playfair_Display'] text-[22px] font-bold text-[#004b24]">Adv. Ahmad Khan</h3>
                                <p class="text-[#5d5f5f] font-['Inter'] text-[14px]">High Court Advocate</p>
                            </div>
                            <div class="bg-[#004b24]/10 text-[#004b24] px-2 py-1 rounded flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] fill-1">star</span>
                                <span class="text-xs font-bold">4.9</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-[#3f4940] mb-4 text-[14px]">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            <span>Lahore, Pakistan</span>
                        </div>
                        <p class="text-[#3f4940] font-['Inter'] text-[14px] mb-6 line-clamp-2">
                            Specializing in Corporate Law and Dispute Resolution with 15+ years of active practice across the High Courts.
                        </p>
                        <a href="javascript:void(0);" onclick="openLawyerProfile(1)" class="bg-[#004b24] text-white px-6 py-2.5 rounded-xl font-semibold inline-block w-full text-center hover:bg-[#005228] transition-all duration-200">
                            Book Consultation
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden border border-[#bfc9bd] shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="overflow-hidden h-64">
                        <img class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2L1chzfLIMrYHB7bx0sikQZJ0BIfafB-i0P9oo2eDhp810i0y-5fN-r_HKKCN1Lic0aYjrRp2UUbABpCVJuyxv7ZvjHoQ7EmYnKnJRy5yrUtACDoy1_s5IYukknktPPxA8OwOewadmcITImAqKYGkG_EVl3bGQhphZx8Ltqo_HywavPbV8aIUDfa3T0NJBpx3GQaD7UxLnE5F2VpSJJUoLh_qSu8LHFPjWALBsPYzA6Lr8j78p0L0AN8TSbnNe2f2613y1oc_jvh2" alt="Adv. Sara Ahmed">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-['Playfair_Display'] text-[22px] font-bold text-[#004b24]">Adv. Sara Ahmed</h3>
                                <p class="text-[#5d5f5f] font-['Inter'] text-[14px]">Family Law Expert</p>
                            </div>
                            <div class="bg-[#004b24]/10 text-[#004b24] px-2 py-1 rounded flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] fill-1">star</span>
                                <span class="text-xs font-bold">5.0</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-[#3f4940] mb-4 text-[14px]">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            <span>Islamabad, Pakistan</span>
                        </div>
                        <p class="text-[#3f4940] font-['Inter'] text-[14px] mb-6 line-clamp-2">
                            Providing compassionate and expert mediation in family, child custody, and complex inheritance disputes.
                        </p>
                        <a href="javascript:void(0);" onclick="openLawyerProfile(2)" class="bg-[#004b24] text-white px-6 py-2.5 rounded-xl font-semibold inline-block w-full text-center hover:bg-[#005228] transition-all duration-200">
                            Book Consultation
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden border border-[#bfc9bd] shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="overflow-hidden h-64">
                        <img class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmq3PRzlCP61FzhCvrjNgi_wSu4uN84OmxbMxw8TpzYnqVO_lbuNocIsjNnG0SgoZhpLVy7G8flKvnBc8XcEmwoXusDF3DMOAwdCQPc92aKyX1QO-hw9TQzEyBbIQcFOBiu8nCbSOISvsCVTmL5GcPkdERdX8ArBdiF_NK2Lh9_tg24ntvVZlc82iecF5dLc_tXwigWM6jPEEie8K7rSdwi97q59GF3-oFpCEvSBl8Xw9cdHzc8JowCioPNOWM_-9OopgDIga3qNOp" alt="Adv. Zaid Malik">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-['Playfair_Display'] text-[22px] font-bold text-[#004b24]">Adv. Zaid Malik</h3>
                                <p class="text-[#5d5f5f] font-['Inter'] text-[14px]">Criminal Defense Lead</p>
                            </div>
                            <div class="bg-[#004b24]/10 text-[#004b24] px-2 py-1 rounded flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] fill-1">star</span>
                                <span class="text-xs font-bold">4.8</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-[#3f4940] mb-4 text-[14px]">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            <span>Karachi, Pakistan</span>
                        </div>
                        <p class="text-[#3f4940] font-['Inter'] text-[14px] mb-6 line-clamp-2">
                            Distinguished career in protecting constitutional rights and aggressive white-collar criminal defense litigation.
                        </p>
                        <a href="javascript:void(0);" onclick="openLawyerProfile(3)" class="bg-[#004b24] text-white px-6 py-2.5 rounded-xl font-semibold inline-block w-full text-center hover:bg-[#005228] transition-all duration-200">
                            Book Consultation
                        </a>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</section>