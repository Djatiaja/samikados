@extends('layouts.admin')

@section('title', 'Manajemen Akun - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="#" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Akun..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Akun</h2>
</div>

<!-- Dropdown Filter -->
<div class="mb-6">
  <label for="accountFilter" class="block mb-2 text-sm font-medium text-gray-700">Filter Akun:</label>
  <select id="accountFilter" class="block w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterAccounts()">
    <option value="all">Semua Akun</option>
    <option value="customer">Akun Customer</option>
    <option value="seller">Akun Seller</option>
  </select>
</div>

<!-- Tabel Akun -->
<div id="accountsTable" class="overflow-auto rounded-lg shadow-md">
  <table class="w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
      <tr>
        <th class="p-4 text-center border-r border-gray-300">Nama</th>
        <th class="p-4 text-center border-r border-gray-300">Email</th>
        <th class="p-4 text-center border-r border-gray-300">Tipe</th>
        <th class="p-4 text-center border-r border-gray-300">Status</th>
        <th class="p-4 text-center border-r border-gray-300">Tanggal Bergabung</th>
        <th class="p-4 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ini adalah bagian yang perlu diisi oleh backend dengan data akun sesuai filter -->
      <!-- Contoh data statis di bawah ini hanya sebagai placeholder dan harus diganti oleh backend -->
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">Nama Akun</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">email@example.com</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Tipe Akun</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Status Akun</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Tanggal Bergabung</td>
        <td class="p-4 text-center align-middle">
          <button class="text-white rounded">
            <img src="{{ asset('assets/block.png') }}" alt="Ikon Nonaktif">
          </button>
        </td>
      </tr>
      <!-- Backend akan mengulang baris di atas untuk setiap akun yang sesuai dengan filter -->
    </tbody>
  </table>
</div>
@endsection

@push('scripts')
<script>
  function filterAccounts() {
    var filter = document.getElementById('accountFilter').value;
    // Mengubah URL untuk menyertakan filter yang dipilih dan mengirimkan request ke backend
    window.location.href = '?filter=' + filter;
  }
</script>
@endpush
