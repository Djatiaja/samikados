@extends('layouts.auth')

@section('title', 'OTP Verification')

@section('header-subtitle', 'LOGIN')

@section('content')
    <!-- Image Section (Hidden on mobile) -->
    <section class="w-full lg:w-fit mb-8 lg:mb-0 hidden lg:flex">
        <figure>
            <img src="{{ asset('assets/SamikadosLogo.png') }}" alt="Placeholder image" class="w-full">
        </figure>
    </section>
    
    <!-- OTP Form -->
    <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg my-auto">
        <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">MASUKKAN KODE OTP</h2>
        <p class="mb-4 text-sm text-gray-600">Kode OTP telah dikirim pada email Anda</p>
        
        <!-- OTP Input -->
        <form>
            <div class="flex justify-center space-x-4 mb-4">
                <input class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                    type="text" maxlength="1">
                <input class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                    type="text" maxlength="1">
                <input class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                    type="text" maxlength="1">
                <input class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                    type="text" maxlength="1">
            </div>

            <p class="text-xs text-gray-500 text-center mb-4">Mohon tunggu 35 detik untuk mengirim ulang.</p>

            <!-- Submit Button -->
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="submit">
                Berikutnya
            </button>
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll("input[type='text']");
    
            inputs.forEach((input, index) => {
                input.addEventListener("keyup", (e) => {
                    // Pindah fokus ke input berikutnya saat pengguna mengetik angka
                    if (e.target.value.length === 1) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
    
                    // Jika backspace ditekan, kembali ke input sebelumnya
                    if (e.key === "Backspace" && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
@endsection
