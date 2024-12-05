@extends('layouts.seller')

@section('title', 'Laporan - Seller Dashboard')

@section('content')
<main class="flex-1 p-6">
    <section aria-labelledby="laporan-heading">
        <div class="flex justify-between items-center mb-6">
            <h2 id="laporan-heading" class="text-2xl font-bold">Laporan</h2>
        </div>

        <!-- Ringkasan Laporan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Pendapatan -->
            <div class="bg-white p-6 rounded-lg shadow-md text-left border border-red-600 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">Total Pendapatan</h3>
                    <p class="text-xl font-bold">Rp34.572.980</p>
                </div>
                <img src="{{ asset('assets/ProfitIcon.png') }}" alt="Ikon Pendapatan" class="w-12 h-12">
            </div>

            <!-- Total Keuntungan -->
            <div class="bg-white p-6 rounded-lg shadow-md text-left border border-red-600 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">Saldo Aktif</h3>
                    <p class="text-xl font-bold">Rp13.234.050</p>
                </div>
                <img src="{{ asset('assets/IncomeIcon.png') }}" alt="Ikon Keuntungan" class="w-12 h-12">
            </div>

            <!-- Total Kerugian -->
            <div class="bg-white p-6 rounded-lg shadow-md text-left border border-red-600 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">Saldo Tercairkan</h3>
                    <p class="text-xl font-bold">Rp0</p>
                </div>
                <img src="{{ asset('assets/LossIcon.png') }}" alt="Ikon Kerugian" class="w-12 h-12">
            </div>
        </div>

        <!-- Grafik Statistik -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Grafik Penjualan</h3>
                <!-- Filter Tahun -->
                <select id="yearFilter" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-red-600">
                    <option value="2024" selected>2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            <canvas id="salesChart"></canvas>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk setiap tahun
    const salesData = {
        2024: [1200000, 1500000, 1000000, 1800000, 2200000, 2500000],
        2023: [1000000, 1300000, 900000, 1600000, 2100000, 2400000],
        2022: [900000, 1100000, 800000, 1400000, 2000000, 2300000],
        2021: [800000, 1000000, 700000, 1200000, 1800000, 2000000],
    };

    // Konteks canvas
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Inisialisasi Chart.js
    let salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            datasets: [{
                label: 'Penjualan',
                data: salesData[2024], // Data default untuk 2024
                borderColor: 'rgba(220, 53, 69, 1)', // Warna garis
                backgroundColor: 'rgba(220, 53, 69, 0.2)', // Area di bawah garis
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Pastikan rasio aspek dipertahankan
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
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

    // Event Listener untuk Filter Tahun
    document.getElementById('yearFilter').addEventListener('change', function () {
        const selectedYear = this.value;

        // Perbarui data dalam chart
        salesChart.data.datasets[0].data = salesData[selectedYear];
        salesChart.update(); // Render ulang chart
    });
</script>
@endpush
