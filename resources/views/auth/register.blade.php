@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Create an Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name Input -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="name">
                        Name
                    </label>
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('name') border-red-500 @enderror"
                        id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                        Email Address
                    </label>
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('email') border-red-500 @enderror"
                        id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Role Selection -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="role">
                    Role
                </label>
                <select class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('role') border-red-500 @enderror"
                    id="role" name="role" required>
                    <option value="patient">Patient</option>
                    <option value="therapist">Therapist</option>
                    <option value="owner">Clinic Owner</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Password Input -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('password') border-red-500 @enderror"
                        id="password" type="password" name="password" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password_confirmation">
                        Confirm Password
                    </label>
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900"
                        id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold py-3 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Register
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Log in here</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
