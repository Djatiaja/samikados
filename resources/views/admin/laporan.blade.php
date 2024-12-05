@extends('layouts.admin')

@section('title', 'Laporan - Admin Samikados')

@section('header')
  @parent
  <!-- Tidak menampilkan search bar, jadi $showSearchBar tidak diset -->
@endsection

@section('content')
  <section aria-labelledby="laporan-heading">
    <div class="flex justify-between items-center mb-6">
      <h2 id="laporan-heading" class="text-2xl font-bold">Laporan</h2>
    </div>

    <!-- Ringkasan Laporan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
      <!-- Total Pendapatan -->
      <div class="bg-white p-6 rounded-lg shadow-md text-left border border-remid-600 flex justify-between items-center">
        <div>
          <h3 class="text-lg font-semibold">Total Pendapatan Seller Seller</h3>
            <p class="text-xl font-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
        </div>
        <img src="{{ asset('assets/IncomeIcon.png') }}" alt="Income Icon" class="w-12 h-12">
      </div>

      <!-- Total Keuntungan -->
      <div class="bg-white p-6 rounded-lg shadow-md text-left border border-red-600 flex justify-between items-center">
        <div>
          <h3 class="text-lg font-semibold">Total Keuntungan</h3>
            <p class="text-xl font-bold">Rp {{ number_format($total_keuntungan, 0, ',', '.') }}</p>
        </div>
        <img src="{{ asset('assets/ProfitIcon.png') }}" alt="Profit Icon" class="w-12 h-12">
      </div>

      <!-- Total Kerugian -->
      <div class="bg-white p-6 rounded-lg shadow-md text-left border border-red-600 flex justify-between items-center">
        <div>
          <h3 class="text-lg font-semibold">Total Approve Withdraw</h3>
            <p class="text-xl font-bold">Rp {{ number_format($total_approve, 0, ',', '.') }}</p>
        </div>
        <img src="{{ asset('assets/approved-withdraw.png') }}" alt="Loss Icon" class="w-12 h-12">
      </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="bg-white p-4 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold mb-4">Statistik Penjualan</h3>
      <canvas id="salesChart" width="400" height="200"></canvas>
    </div>

  </section>
@endsection

@push('scripts')
  <!-- Script Chart.js untuk menampilkan grafik penjualan -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode(array_keys($pendapatans)) ?>,
        datasets: [{
          label: 'Pesanan',
          data: <?php echo json_encode(array_values($pendapatans)) ?>,
          borderColor: 'rgba(255, 99, 132, 1)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderWidth: 2,
          fill: false,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah (Rp)',
              color: '#DC3545',
              font: {
                size: 14,
                weight: 'bold'
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
  </script>
@endpush
