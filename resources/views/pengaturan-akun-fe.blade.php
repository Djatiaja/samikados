@extends('layouts.admin')

@section('title', 'Pengaturan Akun - Admin Dashboard')

@section('content')
<div class="flex flex-col md:flex-row items-start md:space-x-10 justify-center">
    <!-- Profile Picture -->
    <div class="w-full md:w-1/4 mr-20">
        <img src="https://placehold.co/300x300" class="rounded-lg shadow-lg w-full" />
        <button class="mt-5 w-full bg-red-600 text-white py-3 rounded-lg" onclick="openPhotoModal()">Ganti Foto Profil</button>
    </div>

    <!-- Profile Details -->
    <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg h-auto flex flex-col items-center justify-center">
        <h2 class="text-3xl mt-4 font-semibold mb-4 text-center">Profil Saya</h2>
        <div class="space-y-4 w-5/6 mt-8">
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">AdminSamikados</div>
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">adminsamikados@gmail.com</div>
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">**********</div>
        </div>
        <button class="mt-10 w-full md:w-96 bg-red-600 text-white py-3 rounded-lg mb-4" onclick="openEditModal()">Edit Profil</button>
    </div>
</div>

<!-- Action Buttons -->
<section class="mt-32 space-y-4 flex flex-col items-center justify-center">
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl" onclick="openAddAdminModal()">Tambah Akun</button>
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl" onclick="openChangePasswordModal()">Ganti Password</button>
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl">Log Out</button>
</section>

<!-- Modal Edit Profile -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Edit Profile</h3>
        <form id="editProfileForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Username</label>
                <input type="text" id="editUsername" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new username">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" id="editEmail" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new email">
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="openConfirmModal()">Simpan</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeEditModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
        <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Perubahan</h3>
        <p>Apakah Anda yakin ingin mengubah profil?</p>
        <div class="flex justify-between mt-6">
            <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitForm()">Ya</button>
            <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmModal()">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Tambah Akun -->
<div id="addAdminModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Tambah Admin Baru</h3>
        <form id="addAdminForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Tipe Admin</label>
                <select id="adminType" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="superadmin">Super Admin</option>
                    <option value="akuntan">Akuntan</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" id="addAdminEmail" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter email">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Username</label>
                <input type="text" id="addAdminUsername" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter username">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password</label>
                <input type="password" id="addAdminPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter password">
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="openConfirmAddModal()">Tambah Admin</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeAddAdminModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Ganti Password -->
<div id="changePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Ganti Password</h3>
        <form id="changePasswordForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password Lama</label>
                <input type="password" id="oldPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter old password">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password Baru</label>
                <input type="password" id="newPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new password">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" id="confirmNewPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Confirm new password">
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="openConfirmChangePasswordModal()">Ganti Password</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeChangePasswordModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

@endsection
