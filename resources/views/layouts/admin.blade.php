<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard - Samikados')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')

  <style>
    /* Mengatur offset untuk konten utama */
    .content-wrapper {
      padding-top: 64px; /* Sesuaikan dengan tinggi header */
      margin-left: 16rem; /* Sesuaikan dengan lebar sidebar */
      min-height: calc(100vh - 64px); /* Menjaga agar konten mengisi layar penuh dan tidak bertabrakan dengan footer */
    }
  </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- Header -->
  @section('header')
  <header class="bg-gradient-to-r from-red-600 to-black p-4 text-white fixed top-0 left-0 right-0 z-10">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
      <h1 class="text-3xl font-bold">SAMIKADOS <a href="{{route('produk-fe')}}"><span class="text-lg">ADMIN</span></a></h1>

      <!-- Search Bar, hanya tampil jika ada section 'search' -->
      @hasSection('search')
        <div class="relative w-full md:w-1/2 lg:w-1/3 mt-4 md:mt-0">
          @yield('search')
        </div>
      @endif

      <div class="flex items-center space-x-4 mt-4 md:mt-0">
        <a href="{{ route('notifikasi-fe') }}">
          <img src="{{ asset('assets/notification.png') }}" alt="Notification Icon" class="w-6 h-6">
        </a>
        <a href="{{ route('pengaturan-akun-fe') }}">
          <img src="{{ asset('assets/profile.png') }}" alt="User Icon" class="w-6 h-6">
        </a>
        <span class="font-semibold">AdminSamikados</span>
      </div>
    </div>
  </header>
  @show

  <!-- Sidebar -->
  <aside class="bg-white shadow-md h-screen w-64 fixed z-9 pt-16 p-6 mt-6">
    <!-- Menambahkan `pt-16` untuk jarak dari header -->
    <nav>
      <ul class="space-y-2">
        <li class="{{ Route::is('dashboard-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('dashboard-fe') }}" class="block">Dashboard</a>
        </li>
        <li class="{{ Route::is('manajemen-kategori-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-kategori-fe') }}" class="block">Manajemen Kategori</a>
        </li>
        <li class="{{ Route::is('manajemen-akun-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-akun-fe') }}" class="block">Manajemen Akun</a>
        </li>
        <li class="{{ Route::is('manajemen-produk-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-produk-fe') }}" class="block">Manajemen Produk</a>
        </li>
        <li class="{{ Route::is('approval-withdraw-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('approval-withdraw-fe') }}" class="block">Approval Withdraw</a>
        </li>
        <li class="{{ Route::is('laporan-fe') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('laporan-fe') }}" class="block">Laporan</a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Konten Utama dengan padding dan margin agar tidak tertutup header dan sidebar -->
  <div class="content-wrapper p-8 bg-gray-100 mt-10">
    @yield('content')
  </div>

  <!-- Footer -->
  @section('footer')
  <footer class="bg-gradient-to-r from-red-600 z-10 to-black p-4 text-white text-center w-full mt-auto">
    <p>&copy; 2024 Samikados. All Rights Reserved.</p>
  </footer>
  @show

  @stack('scripts')
</body>
</html>
