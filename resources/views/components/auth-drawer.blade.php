<!-- Auth Drawer (Login/Register Slide-over) -->
<div id="auth-drawer" class="hidden fixed inset-0 z-[60]">
    <div id="auth-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-none opacity-0 transition-all duration-500"></div>
    <div id="auth-panel" class="absolute top-0 right-0 h-full w-full max-w-2xl bg-[#f8f9fa]/95 backdrop-blur-sm shadow-2xl translate-x-full transition-all duration-500 ease-in-out overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-[#bfc9bd] bg-white">
            <h2 id="auth-title" class="font-['Playfair_Display'] text-xl font-bold text-[#004b24]">Login</h2>
            <button onclick="toggleAuthDrawer()" class="p-2 hover:bg-[#f3f4f5] rounded-full transition-all"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div id="auth-body" class="p-6 md:p-12">
            <!-- Dynamic content loaded here -->
        </div>
    </div>
</div>

<script>
    // Lawyers profile data from controller
    const lawyersProfileData = @json($lawyersData ?? []);
    let drawerOriginalContent = '';

    function openAuthDrawer(mode) {
        const drawer = document.getElementById('auth-drawer');
        const overlay = document.getElementById('auth-overlay');
        const panel = document.getElementById('auth-panel');
        const title = document.getElementById('auth-title');
        const body = document.getElementById('auth-body');

        if (mode === 'login') {
            title.textContent = 'Login';
            body.innerHTML = `
                <div class="bg-white border border-[#bfc9bd] rounded-xl p-8 w-full shadow-lg">
                    <p class="text-sm text-[#3f4940] mb-6">Sign in to your account</p>
                    <form id="loginForm" class="space-y-4">
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Email</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">badge</span>
                                <input id="loginId" type="email" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter your email"/>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Password</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">lock</span>
                                <input id="loginPass" type="password" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter your password"/>
                            </div>
                        </div>
                        <div id="loginMsg" class="text-sm text-center hidden"></div>
                        <button type="submit" class="w-full bg-[#004b24] text-white py-3 rounded-lg font-bold hover:bg-[#005228] transition-all shadow-sm">
                            <span class="material-symbols-outlined align-middle mr-1">login</span> Login
                        </button>
                        <p class="text-center text-sm text-[#3f4940]">Don't have an account? <a href="javascript:void(0);" onclick="openAuthDrawer('register')" class="text-[#004b24] font-bold hover:underline">Register</a></p>
                    </form>
                </div>
            `;
            attachLoginHandler();
        } else {
            title.textContent = 'Register';
            body.innerHTML = `
                <div class="bg-white border border-[#bfc9bd] rounded-xl p-8 w-full shadow-lg">
                    <p class="text-sm text-[#3f4940] mb-6">Create your Account</p>
                    <form id="registerForm" class="space-y-4">
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">I want to register as</label>
                            <select id="regRole" class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] transition-all text-sm">
                                <option value="customer">Customer</option>
                                <option value="lawyer">Lawyer</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Email</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">email</span>
                                <input id="regEmail" type="email" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="your@email.com"/>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Full Name</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">badge</span>
                                <input id="regId" type="text" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter your full name"/>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Password</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">lock</span>
                                <input id="regPass" type="password" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter password"/>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Phone Number</label>
                            <div class="relative mt-1">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3f4940] text-lg">phone</span>
                                <input id="regPhone" type="tel" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="+92 300 1234567"/>
                            </div>
                        </div>
                        <div id="regMsg" class="text-sm text-center hidden"></div>
                        <button type="submit" class="w-full bg-[#004b24] text-white py-3 rounded-lg font-bold hover:bg-[#005228] transition-all shadow-sm">
                            <span class="material-symbols-outlined align-middle mr-1">how_to_reg</span> Register
                        </button>
                        <p class="text-center text-sm text-[#3f4940]">Already have an account? <a href="javascript:void(0);" onclick="openAuthDrawer('login')" class="text-[#004b24] font-bold hover:underline">Login</a></p>
                    </form>
                </div>
            `;
            attachRegisterHandler();
        }

        // Open drawer with slide animation
        drawer.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'backdrop-blur-none');
            overlay.classList.add('opacity-100', 'backdrop-blur-md');
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }, 30);
    }

    function toggleAuthDrawer() {
        const drawer = document.getElementById('auth-drawer');
        const overlay = document.getElementById('auth-overlay');
        const panel = document.getElementById('auth-panel');

        overlay.classList.remove('opacity-100', 'backdrop-blur-md');
        overlay.classList.add('opacity-0', 'backdrop-blur-none');
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        setTimeout(() => {
            drawer.classList.add('hidden');
            document.body.style.overflow = '';
        }, 500);
    }

    function attachLoginHandler() {
        const form = document.getElementById('loginForm');
        if (form) {
            form.onsubmit = function(e) {
                e.preventDefault();
                const email = document.getElementById('loginId').value.trim();
                const pass = document.getElementById('loginPass').value;
                const msg = document.getElementById('loginMsg');
                
                msg.textContent = '⏳ Logging in...';
                msg.className = 'text-sm text-center text-[#004b24]';
                msg.classList.remove('hidden');
                
                fetch('/login', {
                    method: 'POST',
                    body: new URLSearchParams({
                        email: email,
                        password: pass,
                        _token: '{{ csrf_token() }}'
                    })
                })
                .then(response => {
                    // Follow redirect only if response is OK (successful login)
                    if (response.ok && response.redirected) {
                        msg.textContent = '✅ Login successful! Redirecting...';
                        window.location.href = response.url;
                        return;
                    }
                    // Otherwise parse JSON response (including error messages)
                    return response.json();
                })
                .then(data => {
                    if (!data) return; // already redirected
                    if (data.redirect) {
                        msg.textContent = '✅ Login successful! Redirecting...';
                        window.location.href = data.redirect;
                        return;
                    }
                    if (data.errors) {
                        // Show specific password error if present, otherwise email error or generic message
                        if (data.errors.password) {
                            // Prefer server-provided message; fallback to Urdu text
                            msg.textContent = '❌ ' + (data.errors.password || 'پاس ورڈ غلط ہے');
                        } else if (data.errors.email) {
                            msg.textContent = '❌ ' + (data.errors.email || 'ای میل غلط ہے');
                        } else {
                            msg.textContent = '❌ Invalid credentials';
                        }
                        msg.className = 'text-sm text-center text-red-600';
                        return;
                    }
                })
                .catch(err => {
                    msg.textContent = '❌ Login failed. Please try again.';
                    msg.className = 'text-sm text-center text-red-600';
                });
                return false;
            };
        }
    }

    function attachRegisterHandler() {
        const form = document.getElementById('registerForm');
        if (form) {
            form.onsubmit = function(e) {
                e.preventDefault();
                const role = document.getElementById('regRole').value;
                const name = document.getElementById('regId').value.trim();
                const email = document.getElementById('regEmail').value.trim();
                const pass = document.getElementById('regPass').value;
                const phone = document.getElementById('regPhone').value.trim();
                const msg = document.getElementById('regMsg');
                
                msg.textContent = '⏳ Registering...';
                msg.className = 'text-sm text-center text-[#004b24]';
                msg.classList.remove('hidden');
                
                fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: new URLSearchParams({
                        name: name,
                        email: email,
                        password: pass,
                        password_confirmation: pass,
                        mobile: phone,
                        city: 'Karachi',
                        user_type: role,
                        _token: '{{ csrf_token() }}'
                    })
                })
                .then(response => {
                    if (response.redirected) {
                        msg.textContent = '✅ Registered successfully! Redirecting...';
                        window.location.href = response.url;
                    } else if (response.ok) {
                        return response.json();
                    } else {
                        return response.json().then(data => { throw data; });
                    }
                })
                .then(data => {
                    if (data && data.redirect) {
                        msg.textContent = '✅ Registered successfully! Redirecting...';
                        window.location.href = data.redirect;
                        return;
                    }

                    if (data && data.errors) {
                        const firstError = Object.values(data.errors)[0];
                        msg.textContent = '❌ ' + (firstError[0] || 'Registration failed');
                        msg.className = 'text-sm text-center text-red-600';
                    }
                })
                .catch(err => {
                    if (err.errors) {
                        const firstError = Object.values(err.errors)[0];
                        msg.textContent = '❌ ' + (firstError[0] || 'Registration failed');
                    } else {
                        msg.textContent = '❌ Registration failed. Please try again.';
                    }
                    msg.className = 'text-sm text-center text-red-600';
                });
                return false;
            };
        }
    }

    function submitBookingRequest(event, lawyerId) {
        event.preventDefault();
        const name = document.getElementById('bookName').value.trim();
        const email = document.getElementById('bookEmail').value.trim();
        const phone = document.getElementById('bookPhone').value.trim();
        const caseDescription = document.getElementById('bookCase').value.trim();
        const msg = document.getElementById('bookMsg');

        if (!name || !email || !phone || !caseDescription) {
            msg.textContent = '❌ Please fill all booking fields.';
            msg.className = 'text-sm text-center text-red-600';
            msg.classList.remove('hidden');
            return false;
        }

        // Login no longer required for booking

        msg.textContent = '⏳ Sending booking request...';
        msg.className = 'text-sm text-center text-[#004b24]';
        msg.classList.remove('hidden');

        fetch('/book/' + lawyerId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: new URLSearchParams({
                customer_name: name,
                customer_email: email,
                customer_phone: phone,
                case_details: caseDescription,
                _token: '{{ csrf_token() }}'
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
                msg.textContent = '✅ ' + (data.message || 'Booking request sent to the lawyer!');
                msg.className = 'text-sm text-center text-[#004b24]';
                setTimeout(() => {
                    const form = document.getElementById('bookForm');
                    if (form) form.reset();
                    // Close the drawer and stay on home page
                    if (typeof toggleDirectoryDrawer === 'function') toggleDirectoryDrawer();
                    // Show a success notification
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-20 right-6 z-[100] bg-[#004b24] text-white px-6 py-4 rounded-xl shadow-lg';
                    notification.innerHTML = '<p class="font-bold">✅ Booking Sent!</p><p class="text-sm mt-1">Check your dashboard for updates.</p>';
                    document.body.appendChild(notification);
                    setTimeout(() => notification.remove(), 4000);
                }, 1500);
            } else {
                msg.textContent = '❌ ' + (data.message || 'Booking failed');
                msg.className = 'text-sm text-center text-red-600';
            }
        })
        .catch(err => {
            const errorMsg = err?.message || 'Booking failed. Please try again.';
            console.error('Booking error:', err);
            msg.textContent = '❌ ' + errorMsg;
            msg.className = 'text-sm text-center text-red-600';
        });

        return false;
    }

    function openLawyerProfile(id) {
        // Pehle DB lawyers mein dhundein (id match karain)
        const dbLawyers = @json($dbLawyers ?? []);
        let lawyer = dbLawyers.find(l => String(l.id) === String(id));

        // Agar DB mein nahi mila toh hardcoded data try karein
        if (!lawyer) {
            const hardcoded = lawyersProfileData[id];
            if (hardcoded) {
                lawyer = hardcoded;
                lawyer.id = id;
            }
        }
        if (!lawyer) return;

        // Ensure sab fields exist honge taake profile mein error na aaye
        lawyer.img = lawyer.img || 'https://via.placeholder.com/300?text=' + encodeURIComponent(lawyer.name || 'Lawyer');
        lawyer.title = lawyer.title || 'Advocate';
        lawyer.subtitle = lawyer.subtitle || '';
        lawyer.experience = lawyer.experience || '0';
        lawyer.education = lawyer.education || '';
        lawyer.rating = lawyer.rating || '4.5';
        lawyer.reviews_count = lawyer.reviews_count || '0';
        lawyer.fee = lawyer.fee || 'PKR 5,000';
        lawyer.location = lawyer.location || '';
        lawyer.address = lawyer.address || '';
        lawyer.phone = lawyer.phone || '';
        lawyer.bio_1 = lawyer.bio_1 || (lawyer.bio || 'No bio available.');
        lawyer.bio_2 = lawyer.bio_2 || '';
        lawyer.specs = lawyer.specs || ['General Practice'];
        
        const drawer = document.getElementById('directory-drawer');
        const overlay = document.getElementById('drawer-overlay');
        const panel = document.getElementById('drawer-panel');
        const pageShell = document.getElementById('page-shell');
        
        // Save original drawer content before replacing
        const mainContent = panel.querySelector('.flex.flex-1');
        if (mainContent) {
            drawerOriginalContent = mainContent.innerHTML;
            mainContent.innerHTML = `
                <div class="flex-1 overflow-y-auto p-6 md:p-12 bg-[#f8f9fa]">
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white border border-[#bfc9bd] rounded-xl p-6 flex flex-col sm:flex-row gap-6 items-center sm:items-start mb-6">
                            <div class="relative shrink-0">
                                <img alt="${lawyer.name}" class="w-32 h-32 rounded-xl object-cover border-2 border-[#004b24]" src="${lawyer.img}"/>
                                <div class="absolute -bottom-2 -right-2 bg-[#006633] text-white px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow text-[11px] font-bold">
                                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    <span>Verified</span>
                                </div>
                            </div>
                            <div class="flex-1 space-y-2 text-center sm:text-left">
                                <h1 class="font-['Playfair_Display'] text-3xl font-bold text-[#004b24]">${lawyer.name}</h1>
                                <p class="text-sm text-gray-500 font-medium italic">${lawyer.title} — ${lawyer.subtitle}</p>
                                <div class="flex flex-wrap justify-center sm:justify-start gap-2 pt-2">
                                    <span class="bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[#004b24] text-sm">work_history</span> ${lawyer.experience}
                                    </span>
                                    <span class="bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[#004b24] text-sm">school</span> ${lawyer.education}
                                    </span>
                                    <span class="bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-amber-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span> ${lawyer.rating} (${lawyer.reviews_count})
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white border border-[#bfc9bd] rounded-xl p-6 space-y-3 mb-6">
                            <h2 class="font-['Playfair_Display'] text-lg font-bold text-[#004b24] border-b border-[#bfc9bd] pb-1">Biography</h2>
                            <p class="text-sm text-[#3f4940] leading-relaxed">${lawyer.bio_1}</p>
                            <p class="text-sm text-[#3f4940] leading-relaxed">${lawyer.bio_2}</p>
                        </div>
                        <div class="bg-white border border-[#bfc9bd] rounded-xl p-6 mb-6">
                            <h2 class="font-['Playfair_Display'] text-lg font-bold text-[#004b24] border-b border-[#bfc9bd] pb-1 mb-4">Practice Areas</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                ${lawyer.specs.map(s => `<div class="flex items-center p-3 bg-[#f3f4f5] rounded-lg border border-[#bfc9bd]"><span class="material-symbols-outlined text-[#004b24] mr-2">gavel</span><span class="text-xs font-bold text-[#191c1d]">${s}</span></div>`).join('')}
                            </div>
                        </div>
                        <div class="bg-white border border-[#bfc9bd] rounded-xl p-6 space-y-4 mb-6">
                            <h2 class="font-['Playfair_Display'] text-lg font-bold text-[#004b24] border-b border-[#bfc9bd] pb-1">Contact Details</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex gap-3"><div class="bg-[#006633] p-2.5 rounded-lg text-white h-fit"><span class="material-symbols-outlined">location_on</span></div><div><h3 class="text-xs font-bold text-[#004b24] uppercase tracking-wide">Chambers</h3><p class="text-xs text-gray-700 mt-0.5">${lawyer.address}</p></div></div>
                                <div class="flex gap-3"><div class="bg-[#006633] p-2.5 rounded-lg text-white h-fit"><span class="material-symbols-outlined">call</span></div><div><h3 class="text-xs font-bold text-[#004b24] uppercase tracking-wide">Helpline</h3><p class="text-xs text-gray-700 mt-0.5">${lawyer.phone}</p></div></div>
                            </div>
                        </div>
                        <div class="bg-white border-t-4 border-[#004b24] border-x border-b border-[#bfc9bd] rounded-b-xl rounded-t-lg p-5 shadow-md mb-6">
                            <h3 class="font-['Playfair_Display'] text-lg font-bold text-[#004b24]">Book Consultation</h3>
                            <p class="text-xs text-[#3f4940] mb-4">Fee: <span class="font-bold text-[#004b24]">${lawyer.fee}</span> — 45 Min Standard</p>
                            <form id="bookForm" class="space-y-4" onsubmit="return submitBookingRequest(event, '${lawyer.id || lawyer.name}')">
                                <div>
                                    <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Your Name</label>
                                    <input id="bookName" type="text" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Enter your name"/>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Email</label>
                                    <input id="bookEmail" type="email" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="your@email.com"/>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Phone Number</label>
                                    <input id="bookPhone" type="tel" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="+92 300 1234567"/>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-[#3f4940] uppercase tracking-wider">Case Details</label>
                                    <textarea id="bookCase" rows="4" required class="w-full bg-[#f3f4f5] border border-[#bfc9bd] rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#004b24] focus:border-[#004b24] transition-all text-sm" placeholder="Describe your case"></textarea>
                                </div>
                                <div id="bookMsg" class="text-sm text-center hidden"></div>
                                <button type="submit" class="w-full bg-[#004b24] text-white py-3 rounded-xl font-bold text-xs hover:bg-[#005228] transition-all shadow-sm">Send Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            `;
        }
        
        drawer.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'backdrop-blur-none');
            overlay.classList.add('opacity-100', 'backdrop-blur-md');
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
            pageShell.classList.add('-translate-x-8', 'md:-translate-x-16');
        }, 30);
    }

    function toggleDirectoryDrawer() {
        const drawer = document.getElementById('directory-drawer');
        const overlay = document.getElementById('drawer-overlay');
        const panel = document.getElementById('drawer-panel');
        const pageShell = document.getElementById('page-shell');
        
        if (drawer.classList.contains('hidden')) {
            drawer.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                overlay.classList.remove('opacity-0', 'backdrop-blur-none');
                overlay.classList.add('opacity-100', 'backdrop-blur-md');
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
                pageShell.classList.add('-translate-x-8', 'md:-translate-x-16');
            }, 30);
        } else {
            overlay.classList.remove('opacity-100', 'backdrop-blur-md');
            overlay.classList.add('opacity-0', 'backdrop-blur-none');
            panel.classList.remove('translate-x-0');
            panel.classList.add('translate-x-full');
            pageShell.classList.remove('-translate-x-8', 'md:-translate-x-16');
            setTimeout(() => {
                drawer.classList.add('hidden');
                document.body.style.overflow = '';
                // Restore original drawer directory content without page refresh
                if (drawerOriginalContent) {
                    const mainContent = panel.querySelector('.flex.flex-1');
                    if (mainContent) mainContent.innerHTML = drawerOriginalContent;
                }
            }, 500);
        }
    }

    // Grid/List Toggle
    const dGridToggle = document.getElementById('drawer-grid-toggle');
    const dListToggle = document.getElementById('drawer-list-toggle');
    const dContainer = document.getElementById('drawer-lawyer-container');

    if (dGridToggle && dListToggle && dContainer) {
        dGridToggle.addEventListener('click', () => {
            dContainer.classList.remove('flex', 'flex-col', 'gap-4');
            dContainer.classList.add('grid', 'grid-cols-1', 'md:grid-cols-2', 'xl:grid-cols-3', 'gap-6');
            
            dGridToggle.classList.add('bg-white', 'shadow-sm', 'text-[#004b24]');
            dGridToggle.classList.remove('text-[#3f4940]');
            dListToggle.classList.remove('bg-white', 'shadow-sm', 'text-[#004b24]');
            dListToggle.classList.add('text-[#3f4940]');
            
            const cards = dContainer.querySelectorAll('.bg-white');
            cards.forEach(card => {
                card.classList.remove('flex-row', 'items-stretch');
                card.classList.add('flex-col');
                const imgWrap = card.querySelector('.relative');
                if (imgWrap) {
                    imgWrap.classList.remove('w-1/3', 'min-h-[240px]');
                    imgWrap.classList.add('h-56', 'w-full');
                }
            });
        });

        dListToggle.addEventListener('click', () => {
            dContainer.classList.remove('grid', 'grid-cols-1', 'md:grid-cols-2', 'xl:grid-cols-3', 'gap-6');
            dContainer.classList.add('flex', 'flex-col', 'gap-4');
            
            dListToggle.classList.add('bg-white', 'shadow-sm', 'text-[#004b24]');
            dListToggle.classList.remove('text-[#3f4940]');
            dGridToggle.classList.remove('bg-white', 'shadow-sm', 'text-[#004b24]');
            dGridToggle.classList.add('text-[#3f4940]');

            const cards = dContainer.querySelectorAll('.bg-white');
            cards.forEach(card => {
                card.classList.remove('flex-col');
                card.classList.add('flex-row', 'items-stretch');
                const imgWrap = card.querySelector('.relative');
                if (imgWrap) {
                    imgWrap.classList.remove('h-56', 'w-full');
                    imgWrap.classList.add('w-1/3', 'min-h-[240px]');
                }
            });
        });
    }
</script>

    </body>
</html>