@extends('layouts.admin')

@section('title', 'Manajemen Akun - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="{{ route('manajemen-akun') }}" method="GET" class="relative">
  @foreach (request()->except('search') as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
  @endforeach
  <input type="text" name="search" placeholder="Cari Akun..."
    class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white" value="{{ Request::get('search') }}">
  <img src="{{asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5"
    alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Akun</h2>
</div>

<!-- Dropdown Filter -->
<div class="mb-6">
  <label for="accountFilter" class="block mb-2 text-sm font-medium text-gray-700">Filter Akun:</label>
  <select id="accountFilter"
    class="block w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
    onchange="filterAccounts()">
    <option value="all" {{ Request::get('filter')=='all' ? 'selected' : '' }}>Semua Akun</option>
    <option value="customer" {{ Request::get('filter')=='customer' ? 'selected' : '' }}>Akun Customer</option>
    <option value="seller" {{ Request::get('filter')=='seller' ? 'selected' : '' }}>Akun Seller</option>
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
      @foreach ($users as $user )

      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$user->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$user->email}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$user->role->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$user->is_suspended ? 'suspend':'aktif'}}
        </td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$user->created_at->format('d-m-Y') }}</td>
        <td class="p-4 text-center align-middle">
          <button class="p-4" onclick="openSuspendConfirmModal({{$user->id}})"><img
              src="{{ asset('assets/block.png') }}" alt="Suspend Icon"></button>
          <button class="p-4" onclick="openUnsuspendConfirmModal({{$user->id}})"><img
              src="{{ asset('assets/checkmark.png') }}" alt="Unsuspend Icon"></button>
        </td>
      </tr>

      @endforeach

    </tbody>
  </table>
</div>

<!-- Modal Konfirmasi Suspend -->
<div id="suspendConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <form class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3" method="POST" id="formSuspend">
    @csrf
    @method('PUT')
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Suspend Akun</h3>
    <p class="text-center">Apakah Anda yakin ingin suspend akun ini?</p>
    <div class="flex justify-evenly mt-6">
      <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
      <button onclick="closeSuspendConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
    </div>
  </form>
</div>

<!-- Modal Konfirmasi Unsuspend -->
<div id="unsuspendConfirmModal"
  class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <form class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3" method="POST" id="formUnsuspend">
    @csrf
    @method('PUT')
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Unsuspend Akun</h3>
    <p class="text-center">Apakah Anda yakin ingin unsuspend akun ini?</p>
    <div class="flex justify-evenly mt-6">
      <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
      <button onclick="closeUnsuspendConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
    </div>
  </form>
</div>

@if (Session::get('success')== "suspend")
<div id="successSuspendModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Akun Berhasil di-Suspend</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3"
        onclick="closeSuccessSuspendModal()">Tutup</button>
    </div>
  </div>
</div>
@endif
@if (Session::get('success')== "unsuspend")

<div id="successUnsuspendModal" class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Akun Berhasil di-Unsuspend</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3"
        onclick="closeSuccessUnsuspendModal()">Tutup</button>
    </div>
  </div>
</div>
@endif

@endsection

@push('scripts')
<script>
  function filterAccounts() {
    var filter = document.getElementById('accountFilter').value;
    // Mengubah URL untuk menyertakan filter yang dipilih dan mengirimkan request ke backend
    var searchQuery = "{{ Request::get('search') }}";
    var href = '?filter=' + filter;
    if (filter == 'all') {
      href = '?';
    }
    if (searchQuery) {
      href += '&search=' + searchQuery;
    }
    window.location.href = href;
  }
  // Modal Suspend
  function openSuspendConfirmModal(id) {
    document.getElementById('suspendConfirmModal').classList.remove('hidden');
    document.getElementById('formSuspend').action = "{{route('manajemen-akun.suspend', '')}}/" + id;
  }

  function closeSuspendConfirmModal() {
    document.getElementById('suspendConfirmModal').classList.add('hidden');
  }

  function submitSuspendAccount() {
    closeSuspendConfirmModal();
    setTimeout(() => {
      document.getElementById('successSuspendModal').classList.remove('hidden');
    }, 500);
  }

  function closeSuccessSuspendModal() {
    document.getElementById('successSuspendModal').classList.add('hidden');

  }

  // Modal Unsuspend
  function openUnsuspendConfirmModal(id) {
    document.getElementById('unsuspendConfirmModal').classList.remove('hidden');
    document.getElementById('formUnsuspend').action = "{{route('manajemen-akun.unsuspend', '')}}/" + id;
  }

  function closeUnsuspendConfirmModal() {
    document.getElementById('unsuspendConfirmModal').classList.add('hidden');
  }

  function submitUnsuspendAccount() {
    closeUnsuspendConfirmModal();
    setTimeout(() => {
      document.getElementById('successUnsuspendModal').classList.remove('hidden');
    }, 500);
  }

  function closeSuccessUnsuspendModal() {
    document.getElementById('successUnsuspendModal').classList.add('hidden');
  }
</script>
@endpush