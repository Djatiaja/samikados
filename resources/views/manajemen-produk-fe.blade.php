@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="#" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Produk..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Manajemen Produk</h2>
</div>

<!-- Dropdown Kategori -->
<div class="mb-6">
  <label for="categoryFilter" class="block mb-2 text-sm font-medium text-gray-700">Pilih Kategori Produk:</label>
  <select id="categoryFilter" class="block w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterByCategory()">
    <option value="all">Semua Kategori</option>
    <option value="merchandise">Merchandise</option>
    <option value="kanvas">Kanvas</option>
    <option value="tshirt">T-Shirt</option>
  </select>
</div>

<!-- Tabel Produk -->
<div id="productsTable" class="overflow-auto rounded-lg shadow-md">
  <table class="w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
      <tr>
        <th class="p-4 text-center border-r border-gray-300">Nama Produk</th>
        <th class="p-4 text-center border-r border-gray-300">Harga</th>
        <th class="p-4 text-center border-r border-gray-300">Seller</th>
        <th class="p-4 text-center border-r border-gray-300">Status</th>
        <th class="p-4 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody id="productsBody">
      <!-- Data produk akan ditampilkan di sini berdasarkan filter kategori -->
      <!-- Contoh data placeholder di bawah ini akan digantikan dengan data dari backend -->
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">Nama Produk</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Rp0</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Nama Seller</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Status Produk</td>
        <td class="p-4 text-center align-middle">
          <button class="text-white p-2 rounded">
            <img src="{{ asset('assets/delete.png') }}" alt="Ikon Hapus">
          </button>
        </td>
      </tr>
      <!-- Backend akan mengulang baris di atas untuk setiap produk yang sesuai dengan filter -->
    </tbody>
  </table>
</div>
@endsection

@push('scripts')
<script>
  function filterByCategory() {
    var selectedCategory = document.getElementById('categoryFilter').value;
    // Mengubah URL dengan parameter filter dan mengirimkan permintaan ke backend
    window.location.href = '?category=' + selectedCategory;
  }
</script>
@endpush
