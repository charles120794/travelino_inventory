<nav class="w-full flex fixed lg:static items-center justify-between flex-wrap bg-teal-700 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <span class="font-semibold text-xl tracking-tight">Probuilder V1.0.0</span>
    </div>
    <div class="block lg:hidden">
        <button id="btn-toggle-navbar" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div id="toggle-navbar" class="hidden w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow lg:text-right">
            <a href="/" class="block mt-4 text-sm lg:inline-block lg:mt-0 font-medium hover:text-white mr-6 @if($nav_tab == 'home') text-white @else text-teal-200 @endif">
                Home
            </a>
            <a href="/features" class="block mt-4 text-sm lg:inline-block lg:mt-0 font-medium hover:text-white mr-6 lg:ml-6 @if($nav_tab == 'features') text-white @else text-teal-200 @endif">
                Features
            </a>
            <a href="/contact-us" class="block mt-4 text-sm lg:inline-block lg:mt-0 font-medium hover:text-white mr-6 lg:ml-6 @if($nav_tab == 'contact-us') text-white @else text-teal-200 @endif">
                Contact Us
            </a>
            <a href="/about-us" class="block mt-4 text-sm lg:inline-block lg:mt-0 font-medium hover:text-white mr-6 lg:ml-6 @if($nav_tab == 'about-us') text-white @else text-teal-200 @endif">
                About Us
            </a>
            <a href="/login" class="block mt-4 text-sm inline-block lg:inline-block lg:mt-0 font-normal hover:text-white mr-0 lg:ml-6 @if($nav_tab == 'login') text-white @else text-teal-200 @endif">
                Login
            </a>
            <span class="text-teal-200 inline-block lg:inline-block">|</span>
            <a href="/register" class="block mt-4 text-sm inline-block lg:inline-block lg:mt-0 hover:text-white ml-0 mr-4 @if($nav_tab == 'register') text-white @else text-teal-200 @endif">
                Register
            </a>
        </div>
    </div>
</nav>