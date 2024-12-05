@extends('layouts.seller')

@section('title', 'Dashboard - Seller Samikados')

@section('content')
  <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6">Dashboard</h2>

  <!-- Statistik Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/sold.png') }}" alt="Icon Produk Terjual" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Total Produk Terjual</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">174</p>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Produk Terjual</p>
      </div>
    </div>
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/order.png') }}" alt="Icon Pesanan dalam Proses" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Pesanan dalam Proses</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">27</p>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Sedang Diproses</p>
      </div>
    </div>
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/managed-category.png') }}" alt="Icon Kategori Dikelola" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Kategori yang Dikelola</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">4</p>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Kategori Dikelola</p>
      </div>
    </div>
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/managed-products.png') }}" alt="Icon Produk Dikelola" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Produk yang Dikelola</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">97</p>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Produk Dikelola</p>
      </div>
    </div>
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/rating.png') }}" alt="Icon Rating" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Rating</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">4.8/5</p>
        <div class="flex items-center text-yellow-500 text-xs sm:text-sm lg:text-base">
          &#9733; &#9733; &#9733; &#9733; &#x2B50;
        </div>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Kerja Bagus!</p>
      </div>
    </div>
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md flex items-center space-x-4">
      <img src="{{ asset('assets/income-statistics.png') }}" alt="Icon Statistik Penjualan" class="w-10 h-10 sm:w-12 sm:h-12">
      <div>
        <h3 class="text-base sm:text-lg lg:text-xl font-bold">Statistik Penjualan</h3>
        <p class="text-red-600 text-xl sm:text-2xl lg:text-3xl">Rp 50,000,000</p>
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg">Pendapatan Bulan Ini</p>
      </div>
    </div>
  </div>

  <!-- Grafik Statistik -->
  <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
      <h3 class="text-base sm:text-lg lg:text-xl font-bold mb-4 sm:mb-0">Grafik Pesanan Bulanan</h3>
      <!-- Filter Tahun -->
      <select id="yearFilter" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-red-600">
          <option value="2024" selected>2024</option>
          <option value="2023">2023</option>
          <option value="2022">2022</option>
          <option value="2021">2021</option>
      </select>
    </div>
    <canvas id="orderChart"></canvas>
  </div>
@endsection

@push('scripts')
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Data dummy untuk setiap tahun
    const dataPerTahun = {
        2024: [1200000, 1500000, 1000000, 1800000, 2200000, 2500000, 2100000, 2300000, 1900000, 2000000, 2700000, 3000000],
        2023: [1000000, 1300000, 900000, 1500000, 2000000, 2400000, 2000000, 2200000, 1700000, 1900000, 2500000, 2800000],
        2022: [800000, 1100000, 700000, 1300000, 1800000, 2200000, 1900000, 2100000, 1500000, 1700000, 2200000, 2600000],
        2021: [600000, 900000, 500000, 1200000, 1500000, 2000000, 1800000, 2000000, 1300000, 1500000, 1900000, 2300000],
    };

    // Inisialisasi Chart
    const ctx = document.getElementById('orderChart').getContext('2d');
    let orderChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
            label: 'Penjualan',
            data: dataPerTahun[2024], // Data default untuk tahun 2024
            borderColor: 'rgba(220, 53, 69, 1)', // Warna merah
            borderWidth: 2,
            fill: false
        }]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
            display: true,
            labels: {
                color: '#000', // Warna teks legend
                font: {
                size: 12
                }
            }
            }
        },
        scales: {
            y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Jumlah Penjualan (Rp)',
                color: '#DC3545',
                font: {
                size: 14,
                weight: 'bold'
                }
            },
            ticks: {
                callback: function(value) {
                return 'Rp ' + value.toLocaleString(); // Format angka ke rupiah
                }
            }
            },
            x: {
            title: {
                display: true,
                text: 'Bulan',
                color: '#DC3545',
                font: {
                size: 14,
                weight: 'bold'
                }
            }
            }
        }
        }
    });

    // Event Listener untuk Filter Tahun
    document.getElementById('yearFilter').addEventListener('change', function() {
        const selectedYear = this.value;
        orderChart.data.datasets[0].data = dataPerTahun[selectedYear]; // Perbarui data grafik
        orderChart.update(); // Refresh grafik
    });
  </script>


@endpush
