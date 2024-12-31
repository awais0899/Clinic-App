<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #60A5FA;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        html, body {
            height: 100%;
            margin: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-lg border-b border-gray-200 fixed w-full z-50 shadow-sm"
            x-data="{ mobileMenu: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <i class="fas fa-clinic-medical text-2xl text-blue-500"></i>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            ClinicApp
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        <span>Home</span>
                    </a>
                    <a href="/about" class="nav-link flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>About Us</span>
                    </a>
                    <a href="/services" class="nav-link flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-briefcase-medical mr-2"></i>
                        <span>Services</span>
                    </a>
                    
                    <a href="{{ route('appointments.create') }}" 
                       class="flex items-center px-6 py-2 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-md">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <span>Book Appointment</span>
                    </a>
                </nav>

                <!-- Authentication -->
                <div class="hidden md:flex items-center space-x-6" 
                     x-data="{ userMenu: false }">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex items-center px-5 py-2 rounded-full bg-blue-100 text-blue-600 font-medium hover:bg-blue-200 transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>
                            <span>Register</span>
                        </a>
                    @else
                        <div class="relative">
                            <button @click="userMenu = !userMenu" 
                                    class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                   :class="{ 'transform rotate-180': userMenu }"></i>
                            </button>

                            <div x-show="userMenu" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 @click.away="userMenu = false"
                                 class="absolute right-0 mt-3 w-48 py-2 bg-white rounded-xl shadow-lg border border-gray-100">
                                <a href="{{ route(auth()->user()->role . '.dashboard') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                    <i class="fas fa-stethoscope mr-2"></i>
                                    <span>Dashboard</span>
                                </a>
                                <hr class="my-2 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" 
                        class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    <i class="fas" :class="mobileMenu ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenu"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden py-4 border-t border-gray-100">
                <nav class="flex flex-col space-y-4">
                    <!-- Mobile Navigation Links -->
                    <a href="/" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        <i class="fas fa-home w-8"></i>
                        <span>Home</span>
                    </a>
                    <a href="/about" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        <i class="fas fa-info-circle w-8"></i>
                        <span>About Us</span>
                    </a>
                    <a href="/services" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        <i class="fas fa-briefcase-medical w-8"></i>
                        <span>Services</span>
                    </a>
                    <a href="{{ route('appointments.create') }}" class="flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                        <i class="fas fa-calendar-check w-8"></i>
                        <span>Book Appointment</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center space-y-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clinic-medical text-blue-500"></i>
                    <span class="font-bold text-gray-800">{{ config('app.name') }}</span>
                </div>
                <p class="text-gray-500 text-center">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>