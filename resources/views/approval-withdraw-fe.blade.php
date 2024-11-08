@extends('layouts.admin')

@section('title', 'Approval Penarikan - Admin Dashboard')

@section('content')
  <h2 class="text-2xl font-bold mb-6">Approval Penarikan</h2>

  <!-- Filter dan Tabel Permintaan Penarikan -->
  <div class="flex justify-between items-center mb-4">
    <select class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
      <option value="all">Semua</option>
      <option value="pending">Menunggu</option>
      <option value="approved">Disetujui</option>
      <option value="rejected">Ditolak</option>
    </select>
  </div>

  <!-- Tabel Permintaan Penarikan -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nama Seller</th>
          <th class="p-4 text-center border-r border-gray-300">Jumlah Penarikan</th>
          <th class="p-4 text-center border-r border-gray-300">Tanggal Pengajuan</th>
          <th class="p-4 text-center border-r border-gray-300">Status</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh data penarikan -->
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">RuangJayaPrint</td>
          <td class="p-4 text-center border-r border-gray-300">Rp1.500.000</td>
          <td class="p-4 text-center border-r border-gray-300">15/09/2024</td>
          <td class="p-4 text-center border-r border-gray-300">Menunggu</td>
          <td class="p-4 text-center">
            <button onclick="toggleWithdrawDetailModal()" class="text-blue-500 mr-2">Detail</button>
          </td>
        </tr>
        <!-- Tambahkan lebih banyak data jika diperlukan -->
      </tbody>
    </table>
  </div>
@endsection

@section('footer-scripts')
  <script>
    function toggleWithdrawDetailModal() {
      document.getElementById("withdrawDetailModal").classList.toggle("hidden");
    }

    function toggleApproveWithdrawModal() {
      document.getElementById("approveWithdrawModal").classList.toggle("hidden");
    }

    function toggleRejectWithdrawModal() {
      document.getElementById("rejectWithdrawModal").classList.toggle("hidden");
    }
  </script>
@endsection

<!-- Modals -->
<div id="withdrawDetailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
    <h3 class="text-xl font-bold mb-4 text-center">Detail Penarikan</h3>
    <p><strong>Nama Seller:</strong> RuangJayaPrint</p>
    <p><strong>Jumlah Penarikan:</strong> Rp1.500.000</p>
    <p><strong>Tanggal Pengajuan:</strong> 15/09/2024</p>
    <p><strong>Status:</strong> Menunggu</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleWithdrawDetailModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>

<div id="approveWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Konfirmasi Persetujuan</h3>
    <p>Apakah Anda yakin ingin menyetujui penarikan ini?</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleApproveWithdrawModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-green-600 text-white px-4 py-2 rounded-lg w-36">Setujui</button>
    </div>
  </div>
</div>

<div id="rejectWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Konfirmasi Penolakan</h3>
    <p>Apakah Anda yakin ingin menolak penarikan ini?</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleRejectWithdrawModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-red-600 text-white px-4 py-2 rounded-lg w-36">Tolak</button>
    </div>
  </div>
</div>
