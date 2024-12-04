@extends('layouts.auth')

@section('title', 'Atur Password Baru')

@section('header-subtitle', 'LOGIN')

@section('content')
<!-- Image Section (Hidden on mobile) -->
<section class="w-full lg:w-fit mb-8 lg:mb-0 hidden lg:flex">
    <figure>
        <img src="{{ asset('assets/SamikadosLogo.png') }}" alt="Placeholder image" class="w-full">
    </figure>
</section>

<!-- Password Reset Form -->
<section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg my-auto">
    <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">ATUR PASSWORD BARU</h2>

    <form action="{{route('password.store')}}" method="post" id="passwordForm">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ request()->get('email') }}">


        <!-- New Password Input -->
        <p class="text-sm text-gray-500">Masukkan Password Baru</p>
        <div class="mb-4 relative">
            <label for="new-password" class="sr-only">Password</label>
            <input id="new-password"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600 pr-10"
                placeholder="Password" type="password" name="password" />
            <button type="button" class="absolute inset-y-0 right-3 flex items-center justify-center h-full"
                onclick="togglePasswordVisibility('new-password', 'togglePasswordIcon1')">
                <i class="far fa-eye text-gray-500" id="togglePasswordIcon1"></i>
            </button>
            @error('password')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- New Password Confirmation -->
        <p class="text-sm text-gray-500">Konfirmasi Password Baru</p>
        <div class="mb-4 relative">
            <label for="new-password-confirmation" class="sr-only">Password</label>
            <input id="new-password-confirmation"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                placeholder="Password" type="password" name="password_confirmation" />
            <button type="button" class="absolute inset-y-0 right-3 flex items-center justify-center h-full"
                onclick="togglePasswordVisibility('new-password-confirmation', 'togglePasswordIcon2')">
                <i class="far fa-eye text-gray-500" id="togglePasswordIcon2"></i>
            </button>
            @error('password_confirmation')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <p class="text-xs text-gray-500 mb-4">
            Password terdiri dari kombinasi huruf kecil, huruf besar, simbol, dan angka!
        </p>

        <!-- Submit Button -->
        <button
            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg"
            type="button" onclick="openConfirmPasswordModal()">
            Berikutnya
        </button>
    </form>
</section>

<!-- Modal Konfirmasi Penggantian Password -->
<div id="confirmPasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/4">
        <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Penggantian Password</h3>
        <p class="text-center">Apakah Anda yakin ingin memperbarui password?</p>
        <div class="flex justify-between mt-6">
            <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg"
                onclick="submitPasswordForm()">Ya</button>
            <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg"
                onclick="closeConfirmPasswordModal()">Batal</button>
        </div>
    </div>
</div>

@if (Session::get("success") === "reset_password")
    <!-- Modal Password Berhasil Diubah -->
    <div id="successPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Password Berhasil Diubah</h3>
            <img src="{{ asset('assets/SuccessAnimation.gif') }}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3"
                    onclick="redirectToLogin()">Tutup</button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('scripts')
<script>
    // Function to toggle password visibility
    window.togglePasswordVisibility = function(inputId, iconId) {
        const passwordField = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        toggleIcon.classList.toggle('fa-eye-slash');
    };

    function openConfirmPasswordModal() {
        document.getElementById("confirmPasswordModal").classList.remove("hidden");
    }

    function closeConfirmPasswordModal() {
        document.getElementById("confirmPasswordModal").classList.add("hidden");
    }

    function openSuccessPasswordModal() {
        document.getElementById("successPasswordModal").classList.remove("hidden");
    }

    // Function to simulate password update process
    function submitPasswordForm() {
        document.getElementById("passwordForm").submit();
    }

    function redirectToLogin() {
        window.location.href = '{{ route('login') }}';
    }
</script>
@endsection