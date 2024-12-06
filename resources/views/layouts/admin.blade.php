<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard - Samikados')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')

  <style>
    /* Header Styling */
    header {
      height: auto;
    }

    /* Konten utama */
    .content-wrapper {
      margin-left: 16rem; /* Lebar default sidebar */
      min-height: 100vh; /* Pastikan konten mengisi layar penuh */
      padding-top: calc(var(--header-height, 4rem)); /* Gunakan variabel CSS untuk menyesuaikan tinggi header */
      transition: padding-top 0.3s ease; /* Animasi jika ada perubahan tinggi header */
      overflow: visible;
    }

    /* Sidebar Responsif */
    @media (max-width: 1024px) {
      .content-wrapper {
        margin-left: 0; /* Sidebar akan tersembunyi di layar kecil */
      }

      aside {
        position: fixed;
        left: -100%; /* Awalnya tersembunyi */
        transition: left 0.3s ease-in-out;
        z-index: 50;
        width: 75%;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      }
      aside.active {
        left: 0; /* Sidebar muncul ketika aktif */
      }
      #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 49;
      }
      #overlay.active {
        display: block;
      }
    }

    /* Header untuk tampilan tablet dan mobile */
    @media (max-width: 1024px) {
      header {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
      }

      /* Logo dan nama aplikasi lebih kecil */
      header h1 {
        font-size: 1.5rem;
      }

      /* Search bar lebih kecil */
      header .container .relative {
        width: 90%;
      }

      /* Item di header sejajar vertikal */
      header .container {
        flex-direction: column;
        gap: 1rem; /* Memberi jarak antar-elemen */
      }

      /* Ikon dan tombol responsif */
      header .flex.items-center {
        justify-content: center;
        gap: 1rem;
      }
    }

    /* Tombol toggle sidebar */
    #toggleSidebar {
      cursor: pointer;
    }

    @media (min-width: 1025px) {
      #toggleSidebar {
        display: none; /* Sembunyikan tombol toggle di layar desktop */
      }
    }
  </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- overlay sidebar -->
  <div id="overlay"></div>
  <!-- Header -->
  @section('header')
  <header id="mainHeader" class="bg-gradient-to-r from-red-600 to-black p-4 text-white fixed top-0 left-0 right-0 z-10">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
      <h1 class="text-3xl font-bold">SAMIKADOS <a href="{{route('produk-fe')}}"><span class="text-lg">ADMIN</span></a></h1>

      <!-- Search Bar, hanya tampil jika ada section 'search' -->
      @hasSection('search')
        <div class="relative w-full md:w-1/2 lg:w-1/3 mt-4 md:mt-0">
          @yield('search')
        </div>
      @endif

      <div class="flex items-center space-x-4 mt-4 md:mt-0">
        <!-- Tombol toggle sidebar untuk mobile -->
        <button id="toggleSidebar" class="lg:hidden p-2 rounded">
          <img src="{{ asset('assets/sidebar-toggle.png') }}" alt="Menu Icon" class="w-4 h-4">
        </button>

        <!-- Ikon Notifikasi -->
        <a href="{{ route('admin-notifikasi') }}">
          <img src="{{ asset('assets/notification.png') }}" alt="Notification Icon" class="w-6 h-6">
        </a>

        <!-- Ikon Profil -->
        <a href="{{ route('pengaturan-akun') }}">
          <img src="{{ asset(Auth::user()->photo) }}" alt="User Icon" class="w-10 h-10 rounded-full">
        </a>
        <span class="font-semibold">{{Auth::user()->name}}</span>
      </div>
    </div>
  </header>
  @show

  <!-- Sidebar -->
  <aside  id="sidebar" class="bg-white shadow-md h-screen w-64 fixed pt-16 p-6 z-9">
    <nav>
      <ul class="space-y-2 mt-10">
        <li class="{{ Route::is('dashboard') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
        </li>
        <li class="{{ Route::is('manajemen-kategori') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-kategori') }}" class="block">Manajemen Kategori</a>
        </li>
        <li class="{{ Route::is('manajemen-akun') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-akun') }}" class="block">Manajemen Akun</a>
        </li>
        <li class="{{ Route::is('manajemen-produk') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-produk') }}" class="block">Manajemen Produk</a>
        </li>
        <li class="{{ Route::is('manajemen-banner') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-banner') }}" class="block">Manajemen Banner</a>
        </li>
        <li class="{{ Route::is('manajemen-withdrawal') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('manajemen-withdrawal') }}" class="block">Approval Withdraw</a>
        </li>
        <li class="{{ Route::is('admin-laporan') ? 'bg-red-600 text-white' : 'text-gray-700' }} p-2 rounded-md">
          <a href="{{ route('admin-laporan') }}" class="block">Laporan</a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Konten Utama -->
  <div class="content-wrapper p-8 bg-gray-100 mt-10">
    @yield('content')
  </div>

  @yield('modal')

  <!-- Footer -->
  @section('footer')
  <footer class="bg-gradient-to-r from-red-600 z-10 to-black p-4 text-white text-center w-full mt-auto">
    <p>&copy; 2024 Samikados. All Rights Reserved.</p>
  </footer>
  @show

  <script>
    // Mendapatkan elemen-elemen
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('overlay');
    const header = document.getElementById('mainHeader');

    // Set padding-top dinamis berdasarkan tinggi header
    function adjustContentPadding() {
      const headerHeight = header.offsetHeight;
      document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
    }

    // Set padding saat halaman dimuat dan saat ukuran layar berubah
    window.addEventListener('resize', adjustContentPadding);
    window.addEventListener('DOMContentLoaded', adjustContentPadding);

    // Toggle Sidebar untuk layar kecil
    toggleSidebar?.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
    });

    // Tutup sidebar ketika overlay diklik
    overlay?.addEventListener('click', () => {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
    });
  </script>

  @stack('scripts')
</body>
</html>
