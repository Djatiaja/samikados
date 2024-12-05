@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('header-subtitle', 'VERIFIKASI EMAIL')

@section('content')
    <!-- Image Section -->
    <section class="w-full lg:w-1/2 justify-center mb-8 lg:mb-0 hidden lg:flex">
        <figure>
            <img src="{{ asset('assets/SamikadosLogo.png') }}" 
                 alt="Verification Image" 
                 class="w-9/12">
        </figure>
    </section>
    
    <!-- Verification Section -->
    <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
        <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">Verifikasi Email</h2>
        <p class="mb-4 text-sm text-gray-600">
            Silakan cek email Anda dan klik tautan verifikasi.
        </p>
    
        <!-- Resend Email Button -->
        <form>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="submit">
                Kirim Ulang Email
            </button>
        </form>
    
        <!-- Info Section -->
        <p class="text-xs text-gray-500 text-center">
            Tidak menerima email? Kami bisa mengirim ulang.
        </p>
    
        <!-- Logout Option -->
        <div class="mt-4 text-center">
            <a href="{{ route('login-seller-fe') }}" class="text-red-600 hover:underline text-sm">Keluar</a>
        </div>
    </section>
@endsection
