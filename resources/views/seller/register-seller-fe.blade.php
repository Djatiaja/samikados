@extends('layouts.auth')

@section('title', 'Samikados Register')

@section('header-subtitle', 'REGISTER')

@section('content')
    <!-- Image Section (Hidden on mobile) -->
    <section class="w-full lg:w-fit mb-8 lg:mb-0 hidden lg:flex">
        <figure>
            <img src="{{ asset('assets/SamikadosLogo.png') }}" 
                 alt="Cart icon image" 
                 class="w-full max-w-md">
        </figure>
    </section>
    
    <!-- Register Form -->
    <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
        <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">REGISTER</h2>
        <form>
            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="sr-only">No. Telp</label>
                <input id="phone" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="No. Telp" 
                       type="text" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input id="email" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="Email" 
                       type="email" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input id="password" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="Password" 
                       type="password" />
            </div>

            <!-- Register Button -->
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="button" onclick="window.location.href='{{ route('verify-seller-fe') }}'">
                Register
            </button>

            <!-- Login Link -->
            <div class="text-center">
                <span class="text-gray-700">Sudah Punya Akun? </span>
                <a class="text-red-600 hover:underline" href="{{ route('login-seller-fe') }}">Log in</a>
            </div>
        </form>
    </section>
@endsection
