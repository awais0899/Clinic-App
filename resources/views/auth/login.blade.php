@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-sm mx-auto bg-white p-8 rounded-xl shadow-lg transform transition-all hover:scale-105">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                    Email Address
                </label>
                <div class="relative">
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('email') border-red-500 @enderror"
                        id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                    Password
                </label>
                <div class="relative">
                    <input class="w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-900 @error('password') border-red-500 @enderror"
                        id="password" type="password" name="password" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between mb-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Sign In
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">Sign up here</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
