@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <section class="text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900">About Our Clinic</h1>
        <p class="mt-4 text-xl text-gray-600">Redefining healthcare with innovation, compassion, and expertise</p>
    </section>

    <!-- Clinic Mission and Vision -->
    <section class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-12">
        <div class="bg-blue-200 p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
            <div class="flex justify-center items-center mb-6">
                <i class="fas fa-bullseye text-blue-600 text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Mission</h2>
            <p class="text-lg text-gray-600">Deliver exceptional healthcare solutions with a patient-centric approach, ensuring a healthier tomorrow for all.</p>
        </div>
        <div class="bg-green-200 p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
            <div class="flex justify-center items-center mb-6">
                <i class="fas fa-lightbulb text-green-600 text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Vision</h2>
            <p class="text-lg text-gray-600">To set a global benchmark in integrated orthopedic and chiropractic care, driven by innovation and excellence.</p>
        </div>
    </section>

    <!-- Clinic History -->
    <section class="mt-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 text-center">Our Legacy</h2>
        <p class="mt-4 text-lg text-gray-600 text-center">Founded in 2005, our clinic has evolved into a comprehensive healthcare facility, combining advanced technology with a compassionate touch. Our journey has been fueled by the trust and smiles of thousands of patients.</p>
    </section>

    <!-- Iconic Team Section -->
    <section class="mt-12 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6">Meet Our Visionary Team</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Team Member 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/free-photo/front-view-female-researcher-lab-coat_23-2148816434.jpg?t=st=1733986877~exp=1733990477~hmac=e70bee879b86bc8e1f213895a6d3777ee3b4ce2069007206326af84ba3ee0ec6&w=740" alt="Dr. Emily Blunt" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Emily Blunt</h3>
                <p class="text-lg text-gray-600">Orthopedic Surgeon</p>
                <p class="text-sm text-gray-500">Specialist in joint replacement and minimally invasive surgery</p>
            </div>
            <!-- Team Member 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/free-photo/female-doctor-hospital-with-stethoscope_23-2148827774.jpg?t=st=1733985969~exp=1733989569~hmac=4ff9340a7fa4929750ed0c63bcb334d1047049e01e9f535f5652a7434a9038ae&w=740" alt="Dr. Jane Smith" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Jane Smith</h3>
                <p class="text-lg text-gray-600">Chiropractic Specialist</p>
                <p class="text-sm text-gray-500">Dedicated to spinal health and holistic patient care</p>
            </div>
            <!-- Team Member 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/premium-photo/young-medical-doctor_93675-37904.jpg?w=740" alt="Dr. Mark Brown" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Mark Brown</h3>
                <p class="text-lg text-gray-600">Physical Therapist</p>
                <p class="text-sm text-gray-500">Expert in sports rehabilitation and chronic pain management</p>
            </div>
            <!-- Team Member 4 -->
            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/free-photo/front-view-female-doctor_23-2148847616.jpg?t=st=1733986735~exp=1733990335~hmac=5af645b87154dda25e378a0ae1951e89859bcd02852af3b80172ab187fc02ede&w=740" alt="Dr. Emily Davis" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Emily Davis</h3>
                <p class="text-lg text-gray-600">Nutritionist</p>
                <p class="text-sm text-gray-500">Promoting wellness through personalized dietary plans</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/free-photo/medium-shot-doctor-with-stethoscope_23-2148816188.jpg?t=st=1733986366~exp=1733989966~hmac=48639d982a58513c88cf3ca20811a9230cd4d308c435e4d3342fe951d64440d9&w=740" alt="Dr. Harris Joffer" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Harris Joffer</h3>
                <p class="text-lg text-gray-600">Dermatologist</p>
                <p class="text-sm text-gray-500">Specialized in skin conditions and treatments</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transition-transform hover:scale-105">
                <img src="https://img.freepik.com/free-photo/doctor-smiling-with-stethoscope_1154-36.jpg?t=st=1733986551~exp=1733990151~hmac=15e3a7dbdaeec36c921479126f54c11cc6c16c45049b44458433883caf6caecb&w=740" alt="Dr.Schmidth<" class="rounded-full w-32 h-32 mx-auto mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Dr. Schmidth</h3>
                <p class="text-lg text-gray-600">Cardiologist</p>
                <p class="text-sm text-gray-500">Specializing in heart health and preventive care</p>
            </div>
        </div>
    </section>
</div>
@endsection