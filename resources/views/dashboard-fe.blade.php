@extends('layouts.admin')

@section('title', 'Dashboard - Admin Samikados')

@section('header')
  @parent
  <!-- Tidak perlu menampilkan search bar, jadi $showSearchBar tidak diset -->
@endsection

@section('content')
  <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

  <!-- Statistik Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/ProductIcon.png') }}" alt="Product Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Jumlah Produk</h3>
        <p class="text-red-600 text-3xl">254</p>
        <p class="text-gray-500">Produk Tersedia</p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/CategoryIcon.png') }}" alt="Category Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Jumlah Kategori</h3>
        <p class="text-red-600 text-3xl">10</p>
        <p class="text-gray-500">Kategori Tersedia</p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/UsersIcon.png') }}" alt="Users Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Seller</h3>
        <p class="text-red-600 text-3xl">23</p>
        <p class="text-gray-500">Seller Terdaftar</p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/NewOrdersIcon.png') }}" alt="New Orders Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Pesanan Terbaru</h3>
        <p class="text-red-600 text-3xl">5</p>
        <p class="text-gray-500">Pesanan Bulan Ini</p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/CompletedOrdersIcon.png') }}" alt="Completed Orders Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Pesanan Selesai</h3>
        <p class="text-red-600 text-3xl">109</p>
        <p class="text-gray-500">Pesanan Telah Selesai</p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/CustomerIcon.png') }}" alt="Customer Icon" class="w-12 h-12">
      <div>
        <h3 class="text-lg font-bold">Customer</h3>
        <p class="text-red-600 text-3xl">109</p>
        <p class="text-gray-500">Customer Terdaftar</p>
      </div>
    </div>
  </div>

  <!-- Grafik Statistik -->
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-bold mb-6">Grafik Pesanan Bulanan</h3>
    <canvas id="orderChart"></canvas>
  </div>
@endsection

@section('footer')
  @parent
  <!-- Footer tanpa gambar tambahan -->
@endsection

@push('scripts')
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('orderChart').getContext('2d');
    const orderChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Pesanan',
          data: [12, 19, 3, 5, 2, 3, 10, 15, 7, 8, 12, 16],
          borderColor: 'rgba(255, 99, 132, 1)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endpush
