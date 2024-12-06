@extends('layouts.seller')

@section('title', 'Pengiriman - Seller Dashboard')

@section('search')
<form action="#" method="GET" class="flex">
  <input 
    type="text" 
    name="search" 
    placeholder="Cari pengiriman..." 
    class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white"
  >
  <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
    <img src="{{ asset('assets/search.png') }}" alt="Search Icon" class="w-5 h-5">
  </button>
</form>
@endsection

@section('content')
<div>
  <h2 class="text-2xl font-bold mb-6">Pengiriman</h2>

  <!-- Dropdown Filter -->
  <div class="mb-6">
    <label for="shippingFilter" class="block mb-2 text-sm font-medium text-gray-700">Cari Berdasarkan Status:</label>
    <select 
      id="shippingFilter" 
      class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" 
      onchange="filterShipping()"
    >
      <option value="all">Semua Pengiriman</option>
      <option value="in_transit">Dalam Perjalanan</option>
      <option value="delivered">Diterima Customer</option>
    </select>
  </div>

  <!-- Entries per page -->
  <div class="mb-4">
    <label for="entriesPerPage" class="mr-2">Entries per page:</label>
    <select id="entriesPerPage" class="p-2 border border-gray-300 rounded-md" onchange="changeEntriesPerPage()">
      <option value="10">10</option>
      <option value="25" selected>25</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
  </div>

  <!-- Tabel Semua Pengiriman -->
  <div id="allShippingTable" class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nomor Pesanan</th>
          <th class="p-4 text-center border-r border-gray-300">Nama Pembeli</th>
          <th class="p-4 text-center border-r border-gray-300">Nomor Resi</th>
          <th class="p-4 text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">001234</td>
          <td class="p-4 text-center border-r border-gray-300">Putri Maharani</td>
          <td class="p-4 text-center border-r border-gray-300">271353</td>
          <td class="p-4 text-center">Dalam Perjalanan</td>
        </tr>
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">001235</td>
          <td class="p-4 text-center border-r border-gray-300">Ananda Yesaya</td>
          <td class="p-4 text-center border-r border-gray-300">782559</td>
          <td class="p-4 text-center">Diterima Customer</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tabel Dalam Perjalanan -->
  <div id="inTransitTable" class="hidden overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nomor Pesanan</th>
          <th class="p-4 text-center border-r border-gray-300">Nama Pembeli</th>
          <th class="p-4 text-center">Nomor Resi</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">001234</td>
          <td class="p-4 text-center border-r border-gray-300">Putri Maharani</td>
          <td class="p-4 text-center">271353</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tabel Diterima Customer -->
  <div id="deliveredTable" class="hidden overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nomor Pesanan</th>
          <th class="p-4 text-center border-r border-gray-300">Nama Pembeli</th>
          <th class="p-4 text-center">Nomor Resi</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">001235</td>
          <td class="p-4 text-center border-r border-gray-300">Ananda Yesaya</td>
          <td class="p-4 text-center">782559</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Pagination -->
<nav class="flex items-center gap-x-4 min-w-max mt-4 justify-center">
    <a id="prevButton" class="text-gray-500 hover:text-gray-900 p-4 inline-flex items-center" href="javascript:;" onclick="changePage('prev')" disabled>
      <span>Back</span>
    </a>
    <a id="page1" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;" aria-current="page">1</a>
    <a id="page2" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">2</a>
    <a id="page3" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">3</a>
    <a id="page4" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">4</a>
    <a class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-indigo-600 hover:bg-indigo-50" href="javascript:;">...</a>
    <a id="page10" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-indigo-600 hover:bg-indigo-50" href="javascript:;">10</a>
    <a id="nextButton" class="text-gray-500 hover:text-gray-900 p-4 inline-flex items-center" href="javascript:;" onclick="changePage('next')">
      <span>Next</span>
    </a>
  </nav>
@endsection

@push('scripts')
<script>
  function filterShipping() {
    const filter = document.getElementById('shippingFilter').value;
    const allTable = document.getElementById('allShippingTable');
    const inTransitTable = document.getElementById('inTransitTable');
    const deliveredTable = document.getElementById('deliveredTable');

    // Sembunyikan semua tabel
    allTable.classList.add('hidden');
    inTransitTable.classList.add('hidden');
    deliveredTable.classList.add('hidden');

    // Tampilkan tabel sesuai filter
    if (filter === 'all') {
      allTable.classList.remove('hidden');
    } else if (filter === 'in_transit') {
      inTransitTable.classList.remove('hidden');
    } else if (filter === 'delivered') {
      deliveredTable.classList.remove('hidden');
    }
  }

  // Tampilkan tabel "Semua Pengiriman" saat halaman pertama kali dimuat
  window.onload = function() {
    filterShipping();
  };
</script>
@endpush
