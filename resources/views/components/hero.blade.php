<section id="hero-anti-gravity" class="relative h-[650px] flex items-center overflow-hidden">

    <canvas id="hero-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
    <script src="{{ asset('js/hero-particles.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        initHeroParticles('hero-anti-gravity');
    });
</script>
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmTpwp5oR9PY2e0C7dl3qlXfPWI76a33eDbxwvWcgZgYYB-GPS53zzIpwfRsBzPoFvpgiizFsTgIUJHODcM3UxJa2jfjDFUcz6EobKqwsqgVC3zyi1LLKlw5noVbywJe43RgIrz2Nnxs-KZ9z4BG3NMbixwiUXbJEFZJBcb6BjYv0BOHTa6IbqZOBouyJ3LugSi050k4pe3HJzKJqHum1bGhQlhNhFET-15JGVN45VpKv_43BR2AWflsQRjs0xJw9AD0lqSIEYo7x3" alt="Supreme Court of Pakistan"/>
        <div class="absolute inset-0 bg-gradient-to-r from-[#00210c]/80 via-[#00210c]/40 to-transparent"></div>
    </div>
    
    <div class="relative z-10 px-4 md:px-[48px] max-w-[1200px] mx-auto w-full">
        <div class="max-w-2xl text-white">
            
            <h1 class="font-['Playfair_Display'] text-[48px] font-bold tracking-[-0.02em] leading-[1.2] mb-3">
                Connecting Pakistan to Expert Legal Council.
            </h1>
            
            <p class="font-['Inter'] text-[18px] leading-[1.6] mb-8 opacity-90">
                Find trusted, verified advocates for your legal needs across all major cities of Pakistan. Institutional quality justice, now digitally accessible.
            </p>
            
            <div class="bg-[#ffffff] p-3 rounded-xl shadow-lg flex flex-col md:flex-row gap-3 border-t-4 border-[#004b24]">
                
                <div class="flex-1 flex items-center px-4 bg-[#f3f4f5] rounded-lg border border-[#bfc9bd]">
                    <span class="material-symbols-outlined text-[#6f7a6f] mr-2">gavel</span>
                    <input id="hero-spec-input" class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-[#191c1d] py-3 placeholder-[#6f7a6f] font-['Inter'] text-[16px]" placeholder="Specialization (e.g. Criminal, Corporate)" type="text"/>
                </div>
                
                <div class="flex-1 flex items-center px-4 bg-[#f3f4f5] rounded-lg border border-[#bfc9bd]">
                    <span class="material-symbols-outlined text-[#6f7a6f] mr-2">location_on</span>
                    <input id="hero-city-input" class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-[#191c1d] py-3 placeholder-[#6f7a6f] font-['Inter'] text-[16px]" placeholder="City (e.g. Islamabad, Lahore)" type="text"/>
                </div>
                
                <button onclick="triggerHeroSearch()" class="bg-[#004b24] text-[#ffffff] px-8 py-3 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#00210c] transition-colors font-['Inter'] text-[16px] whitespace-nowrap">
                    <span class="material-symbols-outlined">search</span>
                    Search Lawyers
                </button>
            </div>

        </div>
    </div>
</section>

<script>
    function triggerHeroSearch() {
        const spec = document.getElementById('hero-spec-input').value.trim();
        const city = document.getElementById('hero-city-input').value.trim();
        
        // Open the directory drawer
        const drawer = document.getElementById('directory-drawer');
        if (drawer && drawer.classList.contains('hidden')) {
            if (typeof toggleDirectoryDrawer === 'function') {
                toggleDirectoryDrawer();
            }
        }
        
        // Apply values to drawer search input
        const searchInput = document.getElementById('drawer-search-input');
        if (searchInput) {
            let query = '';
            if (spec && city) {
                query = spec + ' ' + city;
            } else if (spec) {
                query = spec;
            } else if (city) {
                query = city;
            }
            
            searchInput.value = query;
            // Dispatch input event to trigger search filter automatically
            searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        }
    }
</script>