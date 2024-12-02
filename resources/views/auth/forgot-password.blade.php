@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('header-subtitle', 'LOGIN')

@section('content')
<!-- Image Section (Hidden on mobile) -->
<section class="w-full lg:w-fit mb-8 lg:mb-0 hidden lg:flex">
    <figure class="">
        <img src="{{ asset('assets/SamikadosLogo.png') }}" alt="Placeholder image" class="w-full">
    </figure>
</section>

<!-- Reset Password Form -->
<section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
    <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">RESET PASSWORD</h2>
    <form action="{{route('password.email')}}" method="post">
        @csrf


        <!-- Email / Phone Input -->
        <div class="mb-4">
            <label for="reset" class="sr-only">Email</label>
            <input id="reset"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                placeholder="Email / No. Telp" type="text" name="email"/>
        </div>

        <!-- Submit Button -->
        <button
            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg"
            type="submit">
            Berikutnya
        </button>

    </form>
</section>
@endsection