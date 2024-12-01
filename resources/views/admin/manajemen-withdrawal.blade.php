@extends('layouts.admin')

@section('title', 'Approval Penarikan - Admin Dashboard')

<!-- Search Bar -->
@section('search')
<form action="{{route('manajemen-withdrawal')}}" method="GET" class="relative">
  @foreach (request()->except('search') as $key => $value)
  <input type="hidden" name="{{ $key }}" value="{{ $value }}">
  @endforeach
  <input type="text" name="search" placeholder="Cari Nama Seller..."
    class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5"
    alt="Search Icon">
</form>
@endsection

@section('content')
<h2 class="text-2xl font-bold mb-6">Approval Penarikan</h2>

<!-- Filter dan Tabel Permintaan Penarikan -->
<div class="flex justify-between items-center mb-4">
  <select id="status_filter"
    class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
    onchange="filter_status()">
    <option value="all" {{ Request::get('filter') == '' ? 'selected' : '' }}>Semua</option>
    <option value="Menunggu" {{ Request::get('filter') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
    <option value="Disetujui" {{ Request::get('filter') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
    <option value="Ditolak" {{ Request::get('filter') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
  </select>

  <select id="sortOrder"
    class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
    onchange="change_order()">
    <option value="desc" {{ Request::get('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
    <option value="asc" {{ Request::get('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
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
      @foreach ($withdrawals as $withdrawal)
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center border-r border-gray-300">{{$withdrawal->seller->name}}</td>
        <td class="p-4 text-center border-r border-gray-300">Rp{{ number_format($withdrawal->jumlah, 0, ',', '.') }}
        </td>
        <td class="p-4 text-center border-r border-gray-300">{{ $withdrawal->created_at->format('d-m-Y') }}</td>
        <td class="p-4 text-center border-r border-gray-300">{{$withdrawal->status}}</td>
        <td class="p-4 text-center border-r border-gray-300">
          <select class="w-40 bg-red-600 text-white p-2 rounded-lg" name="Status" onchange="change_status(
                                                                this.options[this.selectedIndex].value,
                                                                {{$withdrawal->id}})">
            <option value="Menunggu" {{ $withdrawal->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Disetujui" {{ $withdrawal->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="Ditolak" {{ $withdrawal->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
          </select>
        </td>
        <td class="hidden">BNI</td>
        <td class="hidden">234567890</td>

      </tr>
      @endforeach
      <!-- Tambahkan lebih banyak data jika diperlukan -->
    </tbody>
  </table>
</div>


<!-- Modals -->
<div id="withdrawDetailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
    <h3 class="text-xl font-bold mb-4 text-center">Detail Penarikan</h3>
    <p><strong>Nama Seller:</strong> RuangJayaPrint</p>
    <p><strong>Jumlah Penarikan:</strong> Rp1.500.000</p>
    <p><strong>Bank:</strong> BNI</p>
    <p><strong>No Rekening:</strong> 234567890</p>
    <p><strong>Tanggal Pengajuan:</strong> 15/09/2024</p>
    <p><strong>Status:</strong> Menunggu</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleWithdrawDetailModal()"
        class="border border-gray-300 px-4 py-2 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>

<div id="approveWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <form class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3" id="approvedFormModal" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-xl font-bold mb-4">Konfirmasi Persetujuan</h3>
    <p>Apakah Anda yakin ingin menyetujui penarikan ini?</p>
    <input type="text" name="status" class="hidden" value="Disetujui">
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleApproveWithdrawModal()"
        class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-green-600 text-white px-4 py-2 rounded-lg w-36" type="submit">Setujui</button>
    </div>
  </form>
</div>

<div id="waitingWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <form class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3" id="waitingFormModal" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-xl font-bold mb-4">Konfirmasi Persetujuan</h3>
    <p>Apakah Anda yakin ingin mengubah status ke menunggu pada penarikan ini?</p>
    <input type="text" name="status" class="hidden" value="Menunggu">
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleWaitingWithdrawModal()"
        class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg w-36" type="submit">Setujui</button>
    </div>
  </form>
</div>

<div id="rejectWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <form class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3" id="rejectedFormModal" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-xl font-bold mb-4">Konfirmasi Penolakan</h3>
    <input type="text" name="status" class="hidden" value="Ditolak">
    <p>Apakah Anda yakin ingin menolak penarikan ini?</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleRejectWithdrawModal()"
        class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-red-600 text-white px-4 py-2 rounded-lg w-36" type="submit">Tolak</button>
    </div>
  </form>
</div>

<!-- Modal Sukses Approve -->
@if (session('success') == 'Disetujui')
<div id="successApproveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Penarikan Disetujui</h3>
    <p>Penarikan telah berhasil disetujui.</p>
    <div class="flex justify-center mt-4">
      <button onclick="toggleSuccessApproveModal()"
        class="bg-green-600 text-white px-4 py-2 rounded-lg w-36">Tutup</button>
    </div>
  </div>
</div>
@endif

@if (session('success') == 'Menunggu')
<div id="successApproveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Penarikan Menunggu</h3>
    <p>Penarikan telah berhasil diubah menjadi menunggu.</p>
    <div class="flex justify-center mt-4">
      <button onclick="toggleSuccessApproveModal()"
        class="bg-yellow-600 text-white px-4 py-2 rounded-lg w-36">Tutup</button>
    </div>
  </div>
</div>
@endif



<!-- Modal Sukses Reject -->
@if (session('success') == 'Ditolak')

<div id="successRejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Penarikan Ditolak</h3>
    <p>Penarikan telah berhasil ditolak.</p>
    <div class="flex justify-center mt-4">
      <button onclick="toggleSuccessRejectModal()"
        class="bg-red-600 text-white px-4 py-2 rounded-lg w-36">Tutup</button>
    </div>
  </div>
</div>
@endif

@endsection

@push('scripts')
<script>
  function change_status(value, id) {
    if (value == "Disetujui") {
      toggleApproveWithdrawModal(id)
    }
    if (value == "Menunggu") {
      toggleWaitingWithdrawModal(id)
    }
    if (value == "Ditolak") {
      toggleRejectWithdrawModal(id)
    }
  }

  // Toggle Modals
  function toggleWithdrawDetailModal() {
    document.getElementById("withdrawDetailModal").classList.toggle("hidden");
  }

  function toggleApproveWithdrawModal(id) {

    document.getElementById("approveWithdrawModal").classList.toggle("hidden");
    document.getElementById("approvedFormModal").action = "{{route('manajemen-withdrawal.update','')}}/" + id;

  }

  function toggleWaitingWithdrawModal(id) {
    document.getElementById("waitingWithdrawModal").classList.toggle("hidden");
    document.getElementById("waitingFormModal").action = "{{route('manajemen-withdrawal.update','')}}/" + id;

  }


  function toggleRejectWithdrawModal(id) {
    document.getElementById("rejectWithdrawModal").classList.toggle("hidden");
    document.getElementById("rejectedFormModal").action = "{{route('manajemen-withdrawal.update','')}}/" + id;
  }

  // Toggle Success Modals
  function showSuccessApproveModal() {
    toggleApproveWithdrawModal();
    setTimeout(() => {
      document.getElementById("successApproveModal").classList.remove("hidden");
    }, 500);
  }

  function toggleSuccessApproveModal() {
    document.getElementById("successApproveModal").classList.add("hidden");
  }

  function showSuccessRejectModal() {
    toggleRejectWithdrawModal();
    setTimeout(() => {
      document.getElementById("successRejectModal").classList.remove("hidden");
    }, 500);
  }

  function toggleSuccessRejectModal() {
    document.getElementById("successRejectModal").classList.add("hidden");
  }


  function filter_status() {
    var filter = document.getElementById('status_filter').value;

    var searchQuery = "{{ Request::get('search') }}";
    var sortBy = document.getElementById('sortOrder').value;
    var href = '?filter=' + filter;
    if (filter == 'all') {
      href = '?';
    }
    if (searchQuery) {
      href += '&search=' + searchQuery;
    }

    if (sortBy) {
      href += '&sort=' + sortBy;
    }
    window.location.href = href;
  }

  function change_order() {
    var filter = "{{ Request::get('filter')}}";
    var searchQuery = "{{ Request::get('search') }}";
    var sortBy = document.getElementById('sortOrder').value;
    var href = '?sort=' + sortBy;
    if (filter) {
      href += '&filter=' + filter;
    }
    if (searchQuery) {
      href += '&search=' + searchQuery;
    }
    window.location.href = href;
  }
</script>
@endpush