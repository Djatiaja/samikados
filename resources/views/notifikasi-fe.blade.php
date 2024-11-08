@extends('layouts.admin')

@section('title', 'Notifikasi - Admin Dashboard')

@section('content')
  <h2 class="text-2xl font-bold mb-6">Notifikasi</h2>

  <!-- Notification Cards -->
  <div class="space-y-4">
    <!-- Example Notification Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="font-bold text-xl">Ruang Jaya Print</h3>
      <p class="text-lg text-gray-600 mt-2">Halo Admin! Saya baru saja bergabung dengan SAMIKADOS!</p>
      <span class="text-sm text-gray-500 mt-2 block">20 Oktober 2024, 10:00 AM</span>
    </div>

    <!-- Another Example Notification Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="font-bold text-xl">Produk Baru Ditambahkan</h3>
      <p class="text-lg text-gray-600 mt-2">Produk baru telah ditambahkan di kategori "Elektronik".</p>
      <span class="text-sm text-gray-500 mt-2 block">19 Oktober 2024, 03:30 PM</span>
    </div>

    <!-- Add more notification cards as needed -->
  </div>
@endsection
