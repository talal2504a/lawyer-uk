<!-- Slide-over Directory Drawer Background Overlay -->
<div id="directory-drawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
        <!-- Smooth Dark Backdrop Filter -->
        <div id="drawer-overlay" class="absolute inset-0 bg-black/50 backdrop-blur-none transition-all opacity-0 duration-500 ease-out" onclick="toggleDirectoryDrawer()"></div>

        <div class="pointer-events-none fixed inset-y-0 right-0 flex w-full">
            <!-- Full Screen Drawer Panel Container -->
            <div id="drawer-panel" class="pointer-events-auto w-screen max-w-full transform transform-gpu transition-all duration-500 ease-in-out will-change-transform translate-x-full bg-[#f8f9fa]/95 backdrop-blur-sm text-[#191c1d] flex flex-col h-full shadow-2xl">
                
                <!-- TOP NAVBAR -->
                <header class="bg-[#f8f9fa] border-b border-[#bfc9bd] h-16 flex justify-between items-center w-full px-12 sticky top-0 z-50 shrink-0 shadow-sm">
                    
                    <!-- Brand Logo - Simple Smooth Light Color Shift on Hover -->
                    <div onclick="handleDirectoryLogoClick(event)" class="cursor-pointer select-none">
                        <span class="font-['Playfair_Display'] text-[24px] font-bold text-[#004b24] hover:text-[#008f43] transition-colors duration-200 tracking-wide">
                            LegalConnect
                        </span>
                    </div>
                    
                    <!-- Middle Extended Searchbar inside Drawer -->
                    <div class="hidden md:flex flex-1 max-w-xl mx-6">
                        <div class="relative w-full">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940]">search</span>
                            <input id="drawer-search-input" class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-2 pl-10 pr-4 text-[16px] focus:outline-none focus:ring-2 focus:ring-[#004b24] focus:border-transparent" placeholder="Search for lawyers, specializations or cities..." type="text"/>
                        </div>
                    </div>
                    
                    <!-- Action & Identity Icons -->
                    <div class="flex items-center gap-6">
                        <button class="hover:bg-[#f3f4f5] rounded-full p-2 transition-all duration-200 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#3f4940]">notifications</span>
                        </button>
                        <button class="hover:bg-[#f3f4f5] rounded-full p-2 transition-all duration-200 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#3f4940]">account_circle</span>
                        </button>
                    </div>
                </header>

                <!-- MAIN WORKSPACE CONTAINER -->
                <div class="relative flex flex-1 overflow-hidden w-full">
                    
                    <!-- SIDEBAR FILTERS -->
                    <aside class="hidden lg:flex flex-col w-72 h-full border-r border-[#bfc9bd] bg-[#f3f4f5] p-6 overflow-y-auto filter-scrollbar shrink-0">
                        <div class="mb-12">
                            <h3 class="font-['Inter'] text-[14px] font-semibold text-[#004b24] mb-4 uppercase tracking-widest">Filters</h3>
                            
                            <!-- Specialization checkboxes -->
                            <div class="mb-6">
                                <p class="font-['Inter'] text-[14px] font-semibold text-[#3f4940] mb-3">Specialization</p>
                                <div class="space-y-2">
                                    @foreach(["Criminal", "Divorce", "Civil", "Family Law", "Property", "Affidavit", "Corporate Law"] as $spec)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="{{ $spec }}" class="filter-spec w-5 h-5 rounded border-[#bfc9bd] text-[#004b24] focus:ring-[#004b24] transition-all"/>
                                        <span class="font-['Inter'] text-[16px] text-[#191c1d] group-hover:text-[#004b24] transition-colors">{{ $spec }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- City Dropdown -->
                            <div class="mb-6 pt-4 border-t border-[#bfc9bd]">
                                <p class="font-['Inter'] text-[14px] font-semibold text-[#3f4940] mb-3">City</p>
                                <select id="filter-city" class="w-full bg-[#f8f9fa] border border-[#bfc9bd] rounded-lg p-2 font-['Inter'] text-[16px] focus:border-[#004b24] focus:ring-1 focus:ring-[#004b24]">
                                    <option value="All">All Pakistan</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Karachi">Karachi</option>
                                    <option value="Lahore">Lahore</option>
                                    <option value="Rawalpindi">Rawalpindi</option>
                                </select>
                            </div>

                            <!-- Experience range slider -->
                            <div class="mb-6 pt-4 border-t border-[#bfc9bd]">
                                <p class="font-['Inter'] text-[14px] font-semibold text-[#3f4940] mb-3">Min Experience: <span id="exp-val">1</span> Years</p>
                                <input type="range" id="filter-exp" min="1" max="40" value="1" class="w-full h-2 bg-[#dfe0e0] rounded-lg appearance-none cursor-pointer accent-[#004b24]" oninput="document.getElementById('exp-val').innerText = this.value">
                                <div class="flex justify-between mt-2 font-['Inter'] text-[12px] text-[#3f4940]">
                                    <span>1 Year</span>
                                    <span>40+ Years</span>
                                </div>
                            </div>

                            <!-- Gender Selection Buttons -->
                            <div class="mb-6 pt-4 border-t border-[#bfc9bd]">
                                <p class="font-['Inter'] text-[14px] font-semibold text-[#3f4940] mb-3">Gender</p>
                                <div class="flex flex-wrap gap-2" id="gender-btn-container">
                                    <button data-gender="Any" class="gender-btn px-4 py-2 rounded-full border border-[#004b24] bg-[#004b24] text-white font-['Inter'] text-[14px] font-semibold transition-all">Any</button>
                                    <button data-gender="Male" class="gender-btn px-4 py-2 rounded-full border border-[#bfc9bd] text-[#191c1d] font-['Inter'] text-[14px] font-semibold hover:border-[#004b24] hover:text-[#004b24] transition-all">Male</button>
                                    <button data-gender="Female" class="gender-btn px-4 py-2 rounded-full border border-[#bfc9bd] text-[#191c1d] font-['Inter'] text-[14px] font-semibold hover:border-[#004b24] hover:text-[#004b24] transition-all">Female</button>
                                </div>
                            </div>
                        </div>
                        <button onclick="applyLawyerFilters()" class="mt-auto w-full py-3 bg-[#004b24] text-white font-['Inter'] text-[14px] font-semibold rounded-lg shadow-sm hover:bg-[#005228] active:scale-95 transition-all">
                            Apply Filters
                        </button>
                    </aside>

                    <!-- LAWYERS GRID FEED CONTENT AREA -->
                    <main id="drawer-list-container" class="flex-1 min-w-0 overflow-y-auto p-6 md:p-12 bg-[#f8f9fa]">
                        
                        <!-- Content Header -->
                        <div id="drawer-list-header" class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                            <div>
                                <h1 class="font-['Playfair_Display'] text-[32px] font-bold text-[#191c1d] mb-2">Verified Lawyers in Pakistan</h1>
                                <p class="font-['Inter'] text-[16px] text-[#3f4940]">Find top-rated legal practitioners and book consultations in minutes.</p>
                            </div>
                            <div class="flex items-center bg-[#f3f4f5] rounded-lg p-1 border border-[#bfc9bd] shrink-0">
                                <button id="drawer-grid-toggle" type="button" class="px-3 py-2 rounded-md bg-white shadow-sm text-[#004b24] transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[20px]">grid_view</span>
                                    <span class="font-['Inter'] text-[14px] font-semibold hidden sm:inline">Grid</span>
                                </button>
                                <button id="drawer-list-toggle" type="button" class="px-3 py-2 rounded-md text-[#3f4940] transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[20px]">view_list</span>
                                    <span class="font-['Inter'] text-[14px] font-semibold hidden sm:inline">List</span>
                                </button>
                            </div>
                        </div>

                        <!-- CARDS FLOW GRID (Dynamically Managed By JavaScript) -->
                        <div id="drawer-lawyer-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            <!-- Cards automatic JavaScript se insert honge -->
                        </div>

                        <!-- Pagination Container Footer -->
                        <div class="mt-12 flex justify-center items-center gap-2 pb-6" id="lawyer-pagination">
                            <!-- Pagination buttons automatic yahan manage honge -->
                        </div>
                    </main>

                    <div id="profile-motion-blur" class="absolute inset-y-0 right-0 left-0 lg:left-72 z-30 hidden bg-[#191c1d]/10 backdrop-blur-none opacity-0 transition-all duration-500 ease-in-out" onclick="showDirectoryLawyerList()"></div>

                    <!-- LAWYER PROFILE VIEW (Hidden by default) -->
                    <main id="drawer-profile-container" class="absolute inset-y-0 right-0 left-0 lg:left-72 z-40 min-w-0 overflow-y-auto p-6 md:p-12 bg-[#f8f9fa]/95 backdrop-blur-sm hidden transform translate-x-full transition-all duration-500 ease-in-out shadow-2xl">
                        <button onclick="showDirectoryLawyerList()" class="flex items-center gap-2 text-[#004b24] font-semibold mb-6 hover:underline">
                            <span class="material-symbols-outlined">arrow_back</span> Back to Lawyers
                        </button>
                        <div id="profile-content">
                            <!-- Profile content will be injected here -->
                        </div>
                    </main>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="application/json" id="database-lawyers-data">@json(isset($dbLawyers) ? $dbLawyers : [])</script>

<!-- CLIENT SIDE DYNAMIC LOGIC SCRIPT -->
<script>
    // Complete Mock Data Database (Aapka saara original data unique properties ke sath)
    const allLawyersData = [
        { id: 1, name: "Barrister Ahmed Khan", title: "Supreme Court of Pakistan", exp: 15, specs: ["Corporate Law", "Taxation", "Civil"], city: "Islamabad", gender: "Male", rating: "4.9", fee: "PKR 6,000", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDhAbvZ4bPAgcl-MsYrimaFRj6YfMEPdVV3e_ShrfBnpR-Bz0lO2EE6d3Pp4EahyXZkP0CVbXSmGTOQVfmdpEGwPHnJiBjEFapYZIgVOhQicgEhd9PU-B1-_Q57B53G77egrHBTQt8Xz8dfIw1nsndkvz_WVsnmlxumGP4-ohI9Dj2MqB4HfqrfD5GAUua43ZPlmJXIvCsG5ItcM0cuU739XjJjRt-qmUNnr5CHHRge_QoKZxBoq1faqmQATGokDD3dfcKl3QdbBcjI" },
        { id: 2, name: "Zainab Malik", title: "High Court Advocate", exp: 8, specs: ["Family Law", "Divorce"], city: "Karachi", gender: "Female", rating: "4.8", fee: "PKR 5,000", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuBnOmggxlLI0GYR42EF9xM4YGKcofRe8dpWZ2m0qz_JpF6_wFakWuGiO3LLMId5iQi7-OTUdynxQzLCkOciBZH2RomdFJDp-kKqR5p-Tl9yOrE88buKnp2R3YWBGD6gKARxW-QJvwLTNEpxL6vAnIllTrSoEVdBBqanKJErFz6fUc6bQ7CqF4cz35eU1huEWKB-KPkYk60IgG7ohaawS0iWlOL-XQ4U2n_jmcw0NkoCIL3JMfiAtnIU6Zl7YRaJlQgWtmfA4Su7oCKl" },
        { id: 3, name: "Adv. Faisal Sheikh", title: "Criminal Defense Expert", exp: 22, specs: ["Criminal", "Civil"], city: "Lahore", gender: "Male", rating: "5.0", fee: "PKR 7,500", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDy0NWGQg0TdyybDcK-aorVg-T2RkwjuJWWQruqiQyGoHZQ6zUJZz0UUwd-f7Zjoe_2kMBDs98l4NbjGd5hvpK0an3uYptiAB_EksFFrimNnWNvF92MNa_18WDDnHh02v9Nv5CuHEdFCGrbZXrD5Y7GSeZNUxCZ3BqsqeYd2DCKYCOd-BMmDwqXEM0G-wCinlumDh0wxPbsxsTAdjyNKoXaNwUYP9SNgxaU7F2o6ptY2LFFlmN9GbtbNOi8FTx5ys2mXOAMoWw1Xgke" },
        { id: 4, name: "Sarah Javed", title: "Civil & Property Consultant", exp: 12, specs: ["Property", "Affidavit"], city: "Rawalpindi", gender: "Female", rating: "4.7", fee: "PKR 4,500", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDEU1S_c1ESMIRUulA4rA5QhiUVR--90hs9RGBTg6i4FQKV38yjAYeuyJFqlUSdrKEjk_Nfhu3oJgkhA-3MyvxO2JgnJVSo4G_VLGVuXnLBoW7HVH9p7pfco_2YVFEj6enic7VxAVNRcvEq-dgOOqK1VQBR-UWucdn0UTr-kxXgxBFHzecfzmqN7oX72ZmnPalwPpX020SSiLZH1_SmSOXV5CVcGNZE80-07skHDoDriEk8C8VpEJ9kec17WuqTAbknrcDHCEdIlP93" },
        { id: 5, name: "Hira Mansoor", title: "Cyber Law Specialist", exp: 5, specs: ["Corporate Law", "Civil"], city: "Islamabad", gender: "Female", rating: "4.6", fee: "PKR 3,500", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuAsPNCNApEwSSRGAGv5DsUzGDRNegkcfGAYW4Zs3oSUJMhpbxU1kZkPPx3843m2v78MOMlN1huVlers5BbVY4Go2M-JTB1QgQ9BPKpC8ADKpCXqXFFA0uTw7CGY7L9kVIVLnKEaQBZQDOo-eQd650RyZhgqjCJ8rhXPdyHkoYR_vrjBnikqjSU-NS-1q691w1JO2uqToO8OgzDzD3sDmtPvUOjHCs0K777G8ON5XMhcr7YQAK4H_sbZIjdUqXs6zw7hTPivAf589ZQL" },
        { id: 6, name: "Ibrahim Qureshi", title: "Constitutional Lawyer", exp: 30, specs: ["Civil", "Corporate Law"], city: "Lahore", gender: "Male", rating: "4.9", fee: "PKR 10,000", img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDj7SEzXj8HsFvqUL4vXafMGz3JuxZRhDU-AEyAAaGZOmE-TB914AzY4A-BAed0TJIo5XX90wj6AVRZYRWhGXRqc9G2QjLmFOqZoR2KVuFmkHrLvk_bx5Smc7DNvcjp-V_Jl88EEV5d--iujzs1OL8Zoa6ZrJIfLCbS0jDVgY3mMwLQ_dOI5E3XNQBiGL6Yd48aea6wFFib0K0f09-zkRP1SQevcNho5HAA7CTucRRbBLSJNlu3ny0d7TnLECKwTHMHEt8cn914PdW0" }
    ];

    const databaseLawyersData = JSON.parse(document.getElementById('database-lawyers-data')?.textContent || '[]');
    const directoryLawyersData = databaseLawyersData.length > 0
        ? databaseLawyersData.map(lawyer => ({
            id: lawyer.id,
            name: lawyer.name,
            title: lawyer.title || 'Lawyer',
            exp: parseInt(lawyer.experience) || 0,
            specs: lawyer.specs || ['General Practice'],
            city: (lawyer.location || '').split(',')[0] || 'Pakistan',
            gender: lawyer.gender || 'Any',
            rating: lawyer.rating || '4.5',
            fee: lawyer.fee || 'PKR 5,000',
            img: lawyer.img || 'https://via.placeholder.com/300?text=Lawyer'
        }))
        : allLawyersData;

    let currentFilteredLawyers = [...directoryLawyersData];
    let selectedGender = "Any";
    let currentPage = 1;
    const cardsPerPage = 3; // Har page par 3 card show honge taake pagination (1, 2) sahi se chal sake

    // Gender Buttons selection toggle state
    document.querySelectorAll('.gender-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.gender-btn').forEach(b => {
                b.classList.remove('bg-[#004b24]', 'text-white', 'border-[#004b24]');
                b.classList.add('border-[#bfc9bd]', 'text-[#191c1d]');
            });
            this.classList.remove('border-[#bfc9bd]', 'text-[#191c1d]');
            this.classList.add('bg-[#004b24]', 'text-white', 'border-[#004b24]');
            selectedGender = this.getAttribute('data-gender');
        });
    });

    // Cards render karne ka function
    function renderLawyerCards() {
        const container = document.getElementById('drawer-lawyer-container');
        container.innerHTML = "";

        if(currentFilteredLawyers.length === 0) {
            container.innerHTML = `<p class="font-['Inter'] text-[16px] text-[#3f4940] col-span-full text-center py-12">No lawyers found matching the selected filters.</p>`;
            renderPaginationControls(0);
            return;
        }

        // Pagination boundaries calculate karna
        const startIndex = (currentPage - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;
        const lawyersToDisplay = currentFilteredLawyers.slice(startIndex, endIndex);

        lawyersToDisplay.forEach(lawyer => {
            let specBadges = lawyer.specs.map(s => `<span class="px-3 py-1 bg-[#dfe0e0] text-[#616363] rounded-md font-['Inter'] text-[12px]">${s}</span>`).join('');
            
            const cardHTML = `
                <div class="bg-white border border-[#bfc9bd] rounded-xl overflow-hidden hover:shadow-lg transition-all group flex flex-col">
                    <div class="relative h-56 w-full overflow-hidden shrink-0">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="${lawyer.img}" alt="${lawyer.name}"/>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                            <span class="material-symbols-outlined text-[#553c00] text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-['Inter'] text-[14px] font-semibold text-[#191c1d]">${lawyer.rating}</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1 justify-between">
                        <div>
                            <h3 class="font-['Playfair_Display'] text-[24px] font-semibold text-[#191c1d]">${lawyer.name}</h3>
                            <p class="font-['Inter'] text-[14px] font-semibold text-[#004b24] mb-2">${lawyer.title}</p>
                            <div class="flex items-center gap-2 mb-4 text-[#3f4940]"><span class="material-symbols-outlined text-sm">schedule</span><span class="font-['Inter'] text-[16px]">${lawyer.exp} Years Experience</span></div>
                            <div class="flex flex-wrap gap-2 mb-6">${specBadges}</div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-[#bfc9bd] mt-auto">
                            <div class="flex items-center gap-2 text-[#3f4940]"><span class="material-symbols-outlined">location_on</span><span class="font-['Inter'] text-[16px]">${lawyer.city}</span></div>
                            <button onclick="openDirectoryLawyerProfile('${lawyer.id}')" class="bg-[#004b24] text-white px-6 py-2.5 rounded-xl font-semibold inline-block w-full text-center hover:bg-[#005228] transition-all duration-200">Book Appointment</button>

                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', cardHTML);
        });

        renderPaginationControls(currentFilteredLawyers.length);
    }

    // Dynamic Pagination UI controller
    function renderPaginationControls(totalItems) {
        const paginationContainer = document.getElementById('lawyer-pagination');
        paginationContainer.innerHTML = "";
        
        const totalPages = Math.ceil(totalItems / cardsPerPage);
        if(totalPages <= 1) return;

        // Left Chevron Arrow
        let leftDisabled = currentPage === 1;
        paginationContainer.insertAdjacentHTML('beforeend', `
            <button onclick="changeLawyerPage(${currentPage - 1})" ${leftDisabled ? 'disabled' : ''} class="p-2 border border-[#bfc9bd] rounded-lg hover:bg-[#edeeef] transition-all disabled:opacity-40 disabled:pointer-events-none">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
        `);

        // Page Numbers (1, 2, 3...)
        for(let i = 1; i <= totalPages; i++) {
            let activeClass = (i === currentPage) ? "bg-[#004b24] text-white" : "border border-[#bfc9bd] text-[#191c1d] hover:bg-[#edeeef]";
            paginationContainer.insertAdjacentHTML('beforeend', `
                <button onclick="changeLawyerPage(${i})" class="w-10 h-10 flex items-center justify-center rounded-lg font-['Inter'] text-[14px] font-semibold transition-all ${activeClass}">${i}</button>
            `);
        }

        // Right Chevron Arrow
        let rightDisabled = currentPage === totalPages;
        paginationContainer.insertAdjacentHTML('beforeend', `
            <button onclick="changeLawyerPage(${currentPage + 1})" ${rightDisabled ? 'disabled' : ''} class="p-2 border border-[#bfc9bd] rounded-lg hover:bg-[#edeeef] transition-all disabled:opacity-40 disabled:pointer-events-none">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        `);
    }

    // Page Change execution
    function changeLawyerPage(pageNumber) {
        currentPage = pageNumber;
        renderLawyerCards();
    }

    // APPLY FILTERS Action logic
    function applyLawyerFilters() {
        // 1. Get Specialization values
        let checkedSpecs = [];
        document.querySelectorAll('.filter-spec:checked').forEach(cb => checkedSpecs.push(cb.value));

        // 2. Get Selected City
        let selectedCity = document.getElementById('filter-city').value;

        // 3. Get Experience value
        let minExp = parseInt(document.getElementById('filter-exp').value);

        // Core filtering implementation
        currentFilteredLawyers = directoryLawyersData.filter(lawyer => {
            // City check
            if(selectedCity !== "All" && lawyer.city !== selectedCity) return false;
            
            // Experience check
            if(lawyer.exp < minExp) return false;

            // Gender check
            if(selectedGender !== "Any" && lawyer.gender !== selectedGender) return false;

            // Specialization check (agar checkbox active hain toh kam se kam ek match hona chahiye)
            if(checkedSpecs.length > 0) {
                let match = lawyer.specs.some(s => checkedSpecs.includes(s));
                if(!match) return false;
            }

            return true;
        });

        currentPage = 1; // Filter lagne ke baad pehle page par reset karein
        renderLawyerCards();
    }

    function openDirectoryLawyerProfile(id) {
        const lawyer = directoryLawyersData.find(l => l.id == id);
        if (!lawyer) return;

        const motionBlur = document.getElementById('profile-motion-blur');
        const profileContainer = document.getElementById('drawer-profile-container');
        const profileContent = document.getElementById('profile-content');
        
        profileContent.innerHTML = `
            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-[360px_1fr] gap-6">
                <div class="bg-white rounded-xl shadow-md border border-[#bfc9bd] overflow-hidden h-fit">
                    <div class="relative w-full bg-[#eef1ef] flex items-center justify-center p-4">
                        <img class="w-full max-h-[420px] object-contain" src="${lawyer.img}" alt="${lawyer.name}"/>
                    </div>
                    <div class="p-6">
                        <h1 class="font-['Playfair_Display'] text-[32px] font-bold text-[#191c1d] mb-2">${lawyer.name}</h1>
                        <p class="font-['Inter'] text-[16px] font-semibold text-[#004b24] mb-3">${lawyer.title}</p>
                        <p class="font-['Inter'] text-[15px] text-[#3f4940] leading-relaxed mb-4">${lawyer.exp} Years of Experience in ${lawyer.specs.join(', ')}.</p>
                        <div class="flex flex-wrap gap-2">
                            ${lawyer.specs.map(s => `<span class="px-3 py-1 bg-[#dfe0e0] text-[#616363] rounded-md font-['Inter'] text-[12px]">${s}</span>`).join('')}
                        </div>
                    </div>
                </div>

                <div class="bg-white border-t-4 border-[#004b24] border-x border-b border-[#bfc9bd] rounded-b-xl rounded-t-lg p-6 md:p-8 shadow-md h-fit">
                    <h3 class="font-['Playfair_Display'] text-[26px] font-bold text-[#004b24]">Book Consultation</h3>
                    <p class="font-['Inter'] text-[14px] text-[#3f4940] mb-6">Fee: <span class="font-bold text-[#004b24]">${lawyer.fee}</span> — 45 Min Standard</p>
                    <form class="space-y-4" onsubmit="return handleDrawerBooking(event, ${lawyer.id})">
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Your Name</label>
                            <input type="text" id="drawer-book-name" required class="mt-1 w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter your name"/>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Email</label>
                            <input type="email" id="drawer-book-email" required class="mt-1 w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="your@email.com"/>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Phone Number</label>
                            <input type="tel" id="drawer-book-phone" required class="mt-1 w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="+92 300 1234567"/>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Case Details</label>
                            <textarea rows="4" id="drawer-book-case" required class="mt-1 w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Describe your case"></textarea>
                        </div>
                        <div id="drawer-book-msg" class="text-sm text-center hidden"></div>
                        <button type="submit" class="w-full bg-[#004b24] text-white py-3 rounded-xl font-bold text-sm hover:bg-[#005228] transition-all shadow-sm">Send Request</button>
                    </form>
                </div>
            </div>
        `;

        if (motionBlur) {
            motionBlur.classList.remove('hidden');
        }

        profileContainer.classList.remove('hidden');
        profileContainer.scrollTop = 0;

        requestAnimationFrame(() => {
            if (motionBlur) {
                motionBlur.classList.remove('opacity-0', 'backdrop-blur-none');
                motionBlur.classList.add('opacity-100', 'backdrop-blur-md');
            }

            profileContainer.classList.remove('translate-x-full');
            profileContainer.classList.add('translate-x-0');
        });
    }

    function handleDrawerBooking(event, lawyerId) {
        event.preventDefault();

        const name = document.getElementById('drawer-book-name').value.trim();
        const email = document.getElementById('drawer-book-email').value.trim();
        const phone = document.getElementById('drawer-book-phone').value.trim();
        const caseDetails = document.getElementById('drawer-book-case').value.trim();
        const msgEl = document.getElementById('drawer-book-msg');

        if (!name || !email || !phone || !caseDetails) {
            msgEl.textContent = '❌ Please fill all fields.';
            msgEl.className = 'text-sm text-center text-red-600';
            msgEl.classList.remove('hidden');
            return false;
        }

        msgEl.textContent = '⏳ Sending request...';
        msgEl.className = 'text-sm text-center text-[#004b24]';
        msgEl.classList.remove('hidden');

        fetch('/book/' + lawyerId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Accept': 'application/json'
            },
            body: new URLSearchParams({
                customer_name: name,
                customer_email: email,
                customer_phone: phone,
                case_details: caseDetails,
                _token: document.querySelector('meta[name="csrf-token"]')?.content || ''
            })
        })
        .then(response => {
            if (response.ok) return response.json();
            return response.text().then(text => {
                try {
                    const data = JSON.parse(text);
                    throw data;
                } catch (e) {
                    throw { message: text };
                }
            });
        })
        .then(data => {
            if (data.success) {
                msgEl.textContent = '✅ ' + (data.message || 'Request sent!');
                msgEl.className = 'text-sm text-center text-[#004b24]';
                setTimeout(() => {
                    showDirectoryLawyerList();
                }, 1500);
            } else {
                msgEl.textContent = '❌ ' + (data.message || 'Booking failed');
                msgEl.className = 'text-sm text-center text-red-600';
            }
        })
        .catch(err => {
            const errorMsg = err?.message || 'Server error occurred';
            console.error('Booking error:', err);
            msgEl.textContent = '❌ ' + errorMsg;
            msgEl.className = 'text-sm text-center text-red-600';
        });

        return false;
    }

    function showDirectoryLawyerList() {
        const motionBlur = document.getElementById('profile-motion-blur');
        const profileContainer = document.getElementById('drawer-profile-container');

        if (!profileContainer) return;

        if (motionBlur) {
            motionBlur.classList.remove('opacity-100', 'backdrop-blur-md');
            motionBlur.classList.add('opacity-0', 'backdrop-blur-none');
        }

        profileContainer.classList.remove('translate-x-0');
        profileContainer.classList.add('translate-x-full');

        setTimeout(() => {
            profileContainer.classList.add('hidden');
            if (motionBlur) {
                motionBlur.classList.add('hidden');
            }
        }, 500);
    }

    function handleDirectoryLogoClick(event) {
        if (event) event.preventDefault();

        const profileContainer = document.getElementById('drawer-profile-container');

        if (profileContainer && !profileContainer.classList.contains('hidden')) {
            showDirectoryLawyerList();
            return false;
        }

        if (typeof toggleDirectoryDrawer === 'function') {
            toggleDirectoryDrawer();
        }

        return false;
    }

    // Initial load pe default list display ho jaye
    document.addEventListener("DOMContentLoaded", function() {
        renderLawyerCards();
        
        // Search bar inputs filter automation listener
        document.getElementById('drawer-search-input').addEventListener('input', function(e) {
            let searchVal = e.target.value.toLowerCase();
            currentFilteredLawyers = directoryLawyersData.filter(lawyer => {
                return lawyer.name.toLowerCase().includes(searchVal) || 
                       lawyer.city.toLowerCase().includes(searchVal) ||
                       lawyer.specs.some(s => s.toLowerCase().includes(searchVal));
            });
            currentPage = 1;
            renderLawyerCards();
        });
    });
</script>