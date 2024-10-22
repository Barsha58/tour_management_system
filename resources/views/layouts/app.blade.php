<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | TravelXplorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flaticon/2.1.0/font/flaticon.css">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
   


    </style>
</head>

<body>
    <header class="bg-white bg-opacity-50 py-4">
    <nav class="container mx-auto flex justify-between items-center px-6">
    <!-- Adjusted logo section -->
    <div class="logo">
        <i class="fas fa-paper-plane"></i> <!-- Adjust icon size -->
        <span>TravelXplorer</span>
    </div>


            <div class="nav-links flex space-x-4"> <!-- Navbar items -->
                <div class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </div>
                <div class="nav-item">
                    <a href="#packages" class="nav-link">Packages</a>
                </div>
                <div class="nav-item">
                    <a href="#gallery" class="nav-link">Gallery</a>
                </div>
                <div class="nav-item">
                    <a href="#about" class="nav-link">About Us</a>
                </div>
                <div class="nav-item">
                    <a href="#contact" class="nav-link">Contact Us</a>
                </div>

                <!-- Login/Register -->
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
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
                    <div class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </div>
                @endif
            </div>
        </nav>
    </header>



        @yield('content')
        @yield('scripts')

        <footer>
            @include('partials.footer')
        </footer>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

 
</body>
</html>
