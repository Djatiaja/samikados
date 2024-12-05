@extends('layouts.seller')

@section('title', 'Notifikasi - Seller Dashboard')

@section('content')
<main class="flex-1 p-6">
  <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6">Notifikasi</h2>

  <!-- Notification Cards -->
  <div class="space-y-4">
    
    <!-- Notification Card -->
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md">
      <h3 class="font-bold text-lg sm:text-xl lg:text-2xl">Admin</h3>
      <p class="text-sm sm:text-base lg:text-lg text-gray-600 mt-2">
        Halo Ruang Jaya Print! Selamat bergabung dengan SAMIKADOS. Silahkan chat Admin jika perlu bantuan.
      </p>
      <span class="text-xs sm:text-sm lg:text-base text-gray-500 mt-2 block">20 Oktober 2024, 10:00 AM</span>
    </div>

    <!-- Additional Notification Card -->
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md">
      <h3 class="font-bold text-lg sm:text-xl lg:text-2xl">Admin</h3>
      <p class="text-sm sm:text-base lg:text-lg text-gray-600 mt-2">
        Halo Ruang Jaya Print! Selamat bergabung dengan SAMIKADOS. Silahkan chat Admin jika perlu bantuan.
      </p>
      <span class="text-xs sm:text-sm lg:text-base text-gray-500 mt-2 block">20 Oktober 2024, 10:00 AM</span>
    </div>

  </div>
</main>
@endsection
