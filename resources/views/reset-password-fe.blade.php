<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Password Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen font-roboto">

    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center text-white">
                <h1 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h1>
                <span class="text-lg lg:text-xl ml-4">LOGIN</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 flex flex-col lg:flex-row justify-center items-center flex-grow">
        
        <!-- Image Section (Hidden on mobile) -->
        <section class="w-full lg:w-1/2 justify-center mb-8 lg:mb-0 hidden lg:flex">
            <figure>
                <img src="{{ asset('/assets/SamikadosLogo.png') }}" 
                     alt="Reset Password Image" 
                     class="w-9/12">
            </figure>
        </section>
        
        <!-- Password Reset Form -->
        <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
            <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">ATUR PASSWORD BARU</h2>

            <!-- New Password Input -->
            <p class="text-sm text-gray-500">Masukkan Password Baru</p>
            <div class="mb-4 relative">
                <label for="new-password" class="sr-only">Password</label>
                <input id="new-password" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600 pr-10" 
                       placeholder="Password" 
                       type="password" />
                <button type="button" class="absolute inset-y-0 right-3 flex items-center justify-center h-full" onclick="togglePasswordVisibility('new-password', 'togglePasswordIcon1')">
                    <i class="far fa-eye text-gray-500" id="togglePasswordIcon1"></i>
                </button>
            </div>
            
            <!-- New Password Confirmation -->
            <p class="text-sm text-gray-500">Konfirmasi Password Baru</p>
            <div class="mb-4 relative">
                <label for="new-password-confirmation" class="sr-only">Password</label>
                <input id="new-password-confirmation" 
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                       placeholder="Password" 
                       type="password" />
                <button type="button" class="absolute inset-y-0 right-3 flex items-center justify-center h-full" onclick="togglePasswordVisibility('new-password-confirmation', 'togglePasswordIcon2')">
                    <i class="far fa-eye text-gray-500" id="togglePasswordIcon2"></i>
                </button>
            </div>

            <p class="text-xs text-gray-500 mb-4">
                Password terdiri dari kombinasi huruf kecil, huruf besar, simbol, dan angka!
            </p>

            <!-- Submit Button -->
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="button" onclick="openConfirmPasswordModal()">
                Berikutnya
            </button>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-red-600 to-black p-8 mt-auto shadow-lg text-white">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between">
            <!-- Company Info -->
            <section class="mb-8 lg:mb-0">
                <h2 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h2>
                <p class="text-lg lg:text-xl">SOLUSI TEPAT, PRINT DI MANA SAJA</p>
            </section>

            <!-- Contact Information -->
            <section class="mb-8 lg:mb-0">
                <h3 class="text-xl font-bold">HUBUNGI KAMI</h3>
                <address>
                    DKI JAKARTA<br>
                    Jl. Gilimanuk Raya No.60<br>
                    Daan Mogot Baru - Kalideres<br>
                    Jakarta Barat 11840<br>
                    <a href="tel:+622154399642">(021) 54399642</a>
                </address>
                <h3 class="text-xl font-bold mt-4">OPERASIONAL</h3>
                <p class="text-sm lg:text-base">
                    Senin - Jumat: 08.30 s/d 21.00 WIB<br>
                    Sabtu: 08.30 s/d 15.00 WIB<br>
                    Minggu / Tanggal Merah: Libur
                </p>
            </section>

            <!-- Payment Information -->
            <section>
                <h3 class="text-xl font-bold">PEMBAYARAN</h3>
                <img src="{{ asset('/assets/MidtransLogo.png') }}" alt="Payment placeholder" class="w-24 h-15">
            </section>
        </div>
    </footer>

    <!-- Modal Konfirmasi Penggantian Password -->
    <div id="confirmPasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/4">
            <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Penggantian Password</h3>
            <p class="text-center">Apakah Anda yakin ingin memperbarui password?</p>
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitPasswordForm()">Ya</button>
                <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmPasswordModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Password Berhasil Diubah -->
    <div id="successPasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Password Berhasil Diubah</h3>
            <img src="{{ asset('assets/SuccessAnimation.gif') }}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="redirectToLogin()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye-slash');
        }

        function openConfirmPasswordModal() {
            document.getElementById("confirmPasswordModal").classList.remove("hidden");
        }

        function closeConfirmPasswordModal() {
            document.getElementById("confirmPasswordModal").classList.add("hidden");
        }

        function openSuccessPasswordModal() {
            document.getElementById("successPasswordModal").classList.remove("hidden");
        }

        // Function to simulate password update process
        function submitPasswordForm() {
            closeConfirmPasswordModal();
            setTimeout(function () {
            openSuccessPasswordModal();
            }, 500);
        }

        function redirectToLogin() {
            window.location.href = '{{ route('login-fe') }}'; // Ganti 'login.html' dengan URL halaman login Anda
        }
    </script>

</body>
</html>
