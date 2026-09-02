<!-- Footer Section -->
<footer class="bg-[#191c1d] text-[#e1e3e1] pt-16 pb-8 border-t border-[#3f4940]">
    <div class="max-w-[1200px] mx-auto px-4 md:px-[48px]">
        
        <!-- Main Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            
            <!-- Column 1: Brand Info -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-white">
                    <span class="material-symbols-outlined text-[28px] text-[#008744]">gavel</span>
                    <span class="font-['Playfair_Display'] text-[22px] font-bold tracking-tight">Legal<span class="text-[#008744]">Connect</span></span>
                </div>
                <p class="font-['Inter'] text-[14px] text-[#c4c7c5] leading-relaxed">
                    Connecting individuals and businesses with top-rated legal professionals across Pakistan. Secure, transparent, and reliable.
                </p>
            </div>
            
            <!-- Column 2: Developer -->
            <div>
                <h4 class="font-['Playfair_Display'] text-[18px] font-bold text-white mb-4">Developer</h4>
                <p class="font-['Inter'] text-[14px] text-[#c4c7c5] leading-relaxed mb-4">
                    This project has been developed and executed by the GitHub account holder identified as:
                </p>
                <a href="https://github.com/talal2504a" target="_blank" class="inline-flex items-center gap-3 group">
                    <svg class="w-7 h-7 text-white group-hover:text-[#008744] transition-colors" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-['Inter'] text-[18px] font-bold text-white tracking-wide transition-all duration-300" style="text-shadow: 0 0 10px #008744, 0 0 20px #008744, 0 0 30px #008744;">
                        talal2504a
                    </span>
                </a>
            </div>
            
            <!-- Column 3: Legal & Support -->
            <div>
                <h4 class="font-['Playfair_Display'] text-[18px] font-bold text-white mb-4">Legal & Support</h4>
                <ul class="space-y-2 font-['Inter'] text-[14px] text-[#c4c7c5]">
                    <li><a href="javascript:void(0);" onclick="openTosDrawer()" class="hover:text-[#008744] transition-colors">Terms of Service</a></li>
                    <li><a href="javascript:void(0);" onclick="openAboutDrawer()" class="hover:text-[#008744] transition-colors">Privacy Policy</a></li>
                    <li><a href="javascript:void(0);" onclick="openFaqDrawer()" class="hover:text-[#008744] transition-colors">FAQs</a></li>
                </ul>
            </div>
            
            <!-- Column 4: Newsletter -->
            <div>
                <h4 class="font-['Playfair_Display'] text-[18px] font-bold text-white mb-4">Stay Updated</h4>
                <p class="font-['Inter'] text-[14px] text-[#c4c7c5] mb-4">Subscribe to our newsletter for latest legal insights.</p>
                <form action="#" method="POST" class="flex gap-2">
                    <input type="email" id="footer-email-input" placeholder="Your email address" class="w-full bg-[#2d3130] border border-[#3f4940] text-white px-3 py-2 rounded-lg text-[14px] focus:outline-none focus:border-[#008744] font-['Inter']" required>
                    <button type="submit" class="bg-[#008744] hover:bg-[#006e36] text-white px-4 py-2 rounded-lg font-bold text-[14px] transition-colors">
                        Join
                    </button>
                </form>
            </div>
            
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-[#3f4940] pt-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[12px] font-['Inter'] text-[#c4c7c5]">
            <div>
                &copy; {{ date('Y') }} LegalConnect Pakistan. All rights reserved.
            </div>
            <div class="flex gap-4 text-[#c4c7c5]">
                <a href="#" class="hover:text-white transition-colors">Facebook</a>
                <a href="#" class="hover:text-white transition-colors">Twitter</a>
                <a href="#" class="hover:text-white transition-colors">LinkedIn</a>
            </div>
        </div>
        
    </div>
</footer>