@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <section class="text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900">Our Services</h1>
        <p class="mt-4 text-xl text-gray-600">Expert care tailored to your health and wellness needs</p>
    </section>

    <!-- Services List -->
    <section class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
        <!-- Orthopedic Clinic -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-blue-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-bone fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Orthopedic Clinic</h3>
            <p class="text-lg text-gray-600 mb-4">We offer advanced treatments for musculoskeletal issues, including fractures, joint pain, arthritis, and more. Our orthopedic specialists provide surgery and non-surgical treatments to help you recover and thrive.</p>
            <a href="#orthopedic" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>

        <!-- Chiropractic Clinic -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-green-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-spine fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Chiropractic Clinic</h3>
            <p class="text-lg text-gray-600 mb-4">Our chiropractic services focus on spinal health and alignment. We treat back pain, neck pain, headaches, and more with hands-on spinal manipulation and modern techniques.</p>
            <a href="#chiropractic" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>

        <!-- Physiotherapy Clinic -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-purple-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-dumbbell fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Physiotherapy Clinic</h3>
            <p class="text-lg text-gray-600 mb-4">Our physiotherapy services help restore movement and function after injury or illness. We create tailored plans to meet your specific needs.</p>
            <a href="#physiotherapy" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>

        <!-- Nutritional Counseling -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-orange-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-apple-alt fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Nutritional Counseling</h3>
            <p class="text-lg text-gray-600 mb-4">We provide expert advice on diet and nutrition to support your overall health, manage chronic conditions, and achieve your wellness goals.</p>
            <a href="#nutrition" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>

        <!-- Mental Health Support -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-teal-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-brain fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Mental Health Support</h3>
            <p class="text-lg text-gray-600 mb-4">Our services include counseling and therapy to help with stress, anxiety, depression, and other mental health challenges. We provide a safe space to explore and improve mental well-being.</p>
            <a href="#mentalhealth" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>

        <!-- Weight Loss Programs -->
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="flex justify-center items-center bg-pink-500 text-white p-4 rounded-full mb-6">
                <i class="fas fa-weight fa-2x"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Weight Loss Programs</h3>
            <p class="text-lg text-gray-600 mb-4">Our personalized weight loss programs combine nutrition, exercise, and counseling to help you reach your goals. Our approach focuses on sustainable lifestyle changes.</p>
            <a href="#weightloss" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More →</a>
        </div>
    </section>

    <!-- Service Details -->
    <section class="mt-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 text-center mb-6">What We Offer</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Service 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-yellow-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-user-md fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Joint Replacement</h4>
                <p class="text-gray-600">Our expert orthopedic surgeons perform joint replacements to restore function and relieve pain for conditions such as arthritis and joint degeneration.</p>
            </div>

            <!-- Service 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-indigo-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-basketball-ball fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Sports Rehabilitation</h4>
                <p class="text-gray-600">We specialize in rehabilitation for sports-related injuries, helping you recover and return to your active lifestyle with personalized treatment plans.</p>
            </div>

            <!-- Service 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-red-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-head-side-cough fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Chronic Pain Management</h4>
                <p class="text-gray-600">Our chiropractic care is designed to help alleviate chronic pain through spinal manipulation, physical therapy, and holistic approaches.</p>
            </div>

            <!-- Service 4 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-pink-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-heartbeat fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Cardiac Rehabilitation</h4>
                <p class="text-gray-600">Our cardiac rehabilitation programs are designed to support recovery after heart surgery or a cardiac event, helping patients regain strength and confidence.</p>
            </div>

            <!-- Service 5 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-teal-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-brain fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Neurological Therapy</h4>
                <p class="text-gray-600">We offer therapies for neurological conditions, including stroke recovery, to improve mobility, speech, and overall quality of life.</p>
            </div>

            <!-- Service 6 -->
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="flex justify-center items-center bg-purple-500 text-white p-4 rounded-full mb-6">
                    <i class="fas fa-lungs fa-2x"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Respiratory Therapy</h4>
                <p class="text-gray-600">We offer specialized respiratory care to help manage lung diseases, asthma, COPD, and other breathing conditions. Our team uses advanced treatments to improve lung function.</p>
            </div>
        </div>
    </section>
</div>
@endsection
