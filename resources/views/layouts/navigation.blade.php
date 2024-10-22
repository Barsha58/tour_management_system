<nav>
    <div class="container mx-auto flex justify-between items-center">
        <!-- Left side: Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <i class="fas fa-paper-plane text-2xl text-purple-600"></i>
            <span class="ml-2 text-xl font-semibold text-purple-600">TravelXplorer</span>
        </a>

        <!-- Right side: Links -->
        <div class="flex items-center space-x-6">
            <!-- Home, Packages, Gallery, About Us, Contact Us -->
            <a href="{{ url('/') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                Home
            </a>
            <a href="{{ url('/packages') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                Packages
            </a>
            <a href="{{ url('/gallery') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                Gallery
            </a>
            <a href="{{ url('/about') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                About Us
            </a>
            <a href="{{ url('/contact') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                Contact Us
            </a>

            <!-- Login/Register -->
            @if (Auth::check())
                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                        @else
                            <x-dropdown-link :href="route('customer.dashboard')">
                                {{ __('Customer Dashboard') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Log Out -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <!-- Links to login/register if the user is not authenticated -->
                <a href="{{ route('login') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="text-lg text-gray-700 hover:text-purple-600 border-b-2 border-transparent hover:border-purple-600 transition">
                    Register
                </a>
            @endif
        </div>
    </div>
</nav>


