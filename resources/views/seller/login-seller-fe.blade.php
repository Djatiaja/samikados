@extends('layouts.auth')

@section('title', 'Samikados Login')

@section('header-subtitle', 'LOGIN')

@section('content')
    <!-- Image Section (Hidden on mobile) -->
    <section class="w-full lg:w-fit mb-8 lg:mb-0 hidden lg:flex">
        <figure class="">
            <img src="{{ asset('assets/SamikadosLogo.png') }}" alt="Placeholder image" class="w-full">
        </figure>
    </section>
    
    <!-- Login Form -->
    <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
        <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">LOGIN</h2>
        <form>
            <!-- Email / Username -->
            <div class="mb-4">
                <label for="username" class="sr-only">Email / Username</label>
                <input id="username" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="Email / Username" 
                       type="text" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input id="password" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="Password" 
                       type="password" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex justify-between items-center mb-4">
                <label class="flex items-center text-gray-700 text-sm lg:text-base">
                    <input class="mr-2" type="checkbox" /> Ingat Saya
                </label>
                <a class="text-xs lg:text-sm text-red-600 hover:underline" href="{{ route('forgot-password-fe') }}">Lupa Password?</a>
            </div>

            <!-- Submit Button -->
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="button" onclick="window.location.href='{{ route('dashboard-fe') }}'">
                Masuk
            </button>

            <!-- Google Sign-up -->
            <div class="text-center mb-4 text-gray-700">atau</div>
            <button class="w-full bg-white border border-gray-400 text-gray-700 py-3 rounded-lg flex items-center justify-center hover:bg-gray-50 transition duration-300 shadow-sm" type="button" onclick="window.location.href='{{ route('dashboard-fe') }}'">
                <img src="{{ asset('assets/GoogleLogo.png') }}" alt="Google placeholder" class="mr-2"> Sign In with Google
            </button>

        </form>
    </section>
@endsection
