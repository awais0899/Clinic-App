@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="relative">
    <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                            Modern Healthcare at Your Fingertips
                        </h1>
                        <p class="text-xl text-blue-100">
                            Experience seamless appointment booking and world-class healthcare services with our cutting-edge clinic management system.
                        </p>
                        <div class="space-x-4">
                            <a href="{{ route('appointments.create') }}" class="inline-block px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                                Book Appointment
                            </a>
                            <a href="/services" class="inline-block px-6 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="https://cdn.pixabay.com/photo/2024/07/08/16/28/ai-generated-8881542_1280.jpg">
                    </div>
                </div>
            </div>
        </div>

    <div class="py-16 bg-gradient text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-purple-500 mb-12">
                Our Services
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 bg-white text-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 hover:bg-teal-100">
                    <div class="flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Online Booking</h3>
                    <p class="text-gray-600 text-lg">Easily schedule your appointments with just a few clicks — anytime, anywhere.</p>
                </div>
    
                <!-- Feature 2 -->
                <div class="p-8 bg-white text-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 hover:bg-blue-100">
                    <div class="flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Expert Care</h3>
                    <p class="text-gray-600 text-lg">Receive personalized care from healthcare professionals using state-of-the-art technology.</p>
                </div>
    
                <!-- Feature 3 -->
                <div class="p-8 bg-white text-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 hover:bg-indigo-100">
                    <div class="flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">24/7 Support</h3>
                    <p class="text-gray-600 text-lg">Get round-the-clock assistance from our team whenever you need it, no matter the time.</p>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Testimonials Section -->
    <div class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-purple-500 mb-12">
                What Our Patients Say
            </h2>
            <div class="overflow-hidden relative flex gap-9">
                <div class="flex space-x-8 animate-auto-scroll">
                    <!-- Testimonial 1 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"The care I received at FutureCare was outstanding. The doctors were knowledgeable, and the staff was so compassionate. Thank you!"</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Sarah Johnson</h4>
                    </div>
    
                    <!-- Testimonial 2 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"FutureCare helped me recover from a serious sports injury. The personalized attention made all the difference."</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Mike Brown</h4>
                    </div>
    
                    <!-- Testimonial 3 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"I can’t thank the team enough for their dedication and expertise. They truly care about their patients."</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Emily Davis</h4>
                    </div>
                </div>
                <div class="flex space-x-8 animate-auto-scroll">
                    <!-- Testimonial 1 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"The care I received at FutureCare was outstanding. The doctors were knowledgeable, and the staff was so compassionate. Thank you!"</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Sarah Johnson</h4>
                    </div>
    
                    <!-- Testimonial 2 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"FutureCare helped me recover from a serious sports injury. The personalized attention made all the difference."</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Mike Brown</h4>
                    </div>
    
                    <!-- Testimonial 3 -->
                    <div class="min-w-[300px] bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 17.27l4.15 2.18-1.11-4.81L19 10.24l-4.91-.42L12 5.5 9.91 9.82 5 10.24l3.96 4.4-1.11 4.81L12 17.27z" />
                            </svg>
                            <span class="text-yellow-500 font-semibold">★★★★★</span>
                        </div>
                        <p class="text-gray-600 italic">"I can’t thank the team enough for their dedication and expertise. They truly care about their patients."</p>
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">- Emily Davis</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CSS for auto-scrolling animation -->
    <style>
        .animate-auto-scroll {
            will-change: transform;
            animation: scroll 10s linear infinite;
        }
        
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
    
    <!--     -->
    <div class="py-16 bg-gradient-to-r from-teal-100 via-blue-100 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-indigo-500 mb-8">
                Why Choose Us
            </h2>
            <p class="text-lg font-medium text-gray-700 mb-8 px-6 md:px-12">
                At FutureCare, we redefine healthcare with innovative solutions, compassionate care, and unparalleled expertise. Join us on a journey toward better health and well-being.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                <!-- Point 1 -->
                <div class="bg-white p-8 rounded-xl shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl hover:bg-teal-50">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Innovative Solutions</h3>
                    <p class="text-gray-600">We leverage cutting-edge technology to provide healthcare solutions that are both effective and efficient.</p>
                </div>
    
                <!-- Point 2 -->
                <div class="bg-white p-8 rounded-xl shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl hover:bg-blue-50">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2l8 8-8 8M4 2l8 8-8 8" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Compassionate Care</h3>
                    <p class="text-gray-600">Our team of professionals is dedicated to providing personalized care with empathy and understanding.</p>
                </div>
    
                <!-- Point 3 -->
                <div class="bg-white p-8 rounded-xl shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl hover:bg-indigo-50">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3h-6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Unparalleled Expertise</h3>
                    <p class="text-gray-600">With years of experience, our professionals provide expert healthcare services that you can trust.</p>
                </div>
            </div>
        </div>
    </div>
    
@endsection
