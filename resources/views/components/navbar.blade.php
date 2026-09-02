<header class="bg-[#f8f9fa] fixed top-0 w-full z-50 border-b border-[#bfc9bd] shadow-sm h-16">
    <nav class="flex justify-between items-center w-full px-4 md:px-[48px] max-w-[1200px] mx-auto h-full relative">
        
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-[24px] font-bold text-[#004b24] font-['Playfair_Display']">LegalConnect</a>
        </div>
        
        <div class="hidden md:flex items-center space-x-6">
            <a class="text-[16px] font-['Inter'] {{ request()->routeIs('home') ? 'text-[#004b24] font-bold border-b-2 border-[#004b24] pb-1' : 'text-[#3f4940] hover:text-[#004b24] transition-colors' }}" href="{{ route('home') }}">Home</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] transition-colors" href="javascript:void(0);" onclick="toggleDirectoryDrawer()"> Lawyers</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] transition-colors" href="javascript:void(0);" onclick="openAboutDrawer()">About</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] transition-colors" href="javascript:void(0);" onclick="document.getElementById('footer-email-input').focus(); document.getElementById('footer-email-input').scrollIntoView({behavior: 'smooth', block: 'center'});">Contact</a>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-3">
                <a href="javascript:void(0);" onclick="openAuthDrawer('login')" class="px-4 py-2 text-[#004b24] font-bold hover:bg-[#f3f4f5] transition-all duration-200 rounded">Login</a>
                <a href="javascript:void(0);" onclick="openAuthDrawer('register')" class="px-6 py-2 bg-[#006633] text-[#ffffff] rounded-lg font-bold hover:scale-95 duration-150 transition-transform">Register</a>
            </div>
            
            <button id="mobile-menu-btn" class="md:hidden text-[#004b24] focus:outline-none p-1 rounded hover:bg-[#f3f4f5] transition-colors">
                <span class="material-symbols-outlined text-2xl block" id="menu-icon">menu</span>
            </button>
        </div>

        <div id="mobile-menu" class="hidden absolute top-16 left-0 w-full bg-[#f8f9fa] border-b border-[#bfc9bd] shadow-lg flex flex-col p-4 space-y-3 md:hidden z-40">
            <a class="text-[16px] font-['Inter'] {{ request()->routeIs('home') ? 'text-[#004b24] font-bold bg-[#f3f4f5] px-3 py-2 rounded' : 'text-[#3f4940] hover:text-[#004b24] hover:bg-[#f3f4f5] px-3 py-2 rounded transition-colors' }}" href="{{ route('home') }}">Home</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] hover:bg-[#f3f4f5] px-3 py-2 rounded transition-colors" href="javascript:void(0);" onclick="toggleDirectoryDrawer()">Lawyers</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] hover:bg-[#f3f4f5] px-3 py-2 rounded transition-colors" href="javascript:void(0);" onclick="openAboutDrawer()">About</a>
            <a class="text-[16px] font-['Inter'] text-[#3f4940] hover:text-[#004b24] hover:bg-[#f3f4f5] px-3 py-2 rounded transition-colors" href="javascript:void(0);" onclick="document.getElementById('mobile-menu-btn').click(); document.getElementById('footer-email-input').focus(); document.getElementById('footer-email-input').scrollIntoView({behavior: 'smooth', block: 'center'});">Contact</a>
            
            <div class="flex flex-col gap-2 pt-2 border-t border-[#bfc9bd] sm:hidden">
                <a href="javascript:void(0);" onclick="openAuthDrawer('login')" class="w-full py-2 text-[#004b24] font-bold hover:bg-[#f3f4f5] transition-all rounded text-center block">Login</a>
                <a href="javascript:void(0);" onclick="openAuthDrawer('register')" class="w-full py-2 bg-[#006633] text-[#ffffff] rounded-lg font-bold text-center block">Register</a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (mobileMenuBtn && mobileMenu && menuIcon) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (mobileMenu.classList.contains('hidden')) {
                    menuIcon.textContent = 'menu';
                } else {
                    menuIcon.textContent = 'close';
                }
            });
        }
    });
</script>