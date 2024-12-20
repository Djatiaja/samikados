<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
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
                <img src="{{ asset('assets/SamikadosLogo.png') }}" alt="OTP Image" class="w-9/12">
            </figure>
        </section>

        <!-- OTP Form -->
        <form class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg" method="post" action="{{route('two-factor.verify')}}">
            @csrf
            <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">MASUKKAN KODE OTP</h2>
            <p class="mb-4 text-sm text-gray-600">Kode OTP telah dikirim pada email Anda</p>

            <!-- OTP Input -->
            <div class="flex justify-center space-x-4 mb-4">
                <input
                    class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                    type="text" maxlength="1" name="otp_1" required>
                <input
                    class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                    type="text" maxlength="1" name="otp_2" required>
                <input
                    class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                    type="text" maxlength="1" name="otp_3" required>
                <input
                    class="w-12 text-center p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600"
                    type="text" maxlength="1" name="otp_4" required>
            </div>

            <p class="text-xs text-gray-500 text-center mb-4">Mohon tunggu 35 detik untuk mengirim ulang.</p>

            <!-- Submit Button -->
            <button
                class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg"
                type="submit">
                Berikutnya
            </button>
        </form>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll("input[type='text']");

            inputs.forEach((input, index) => {
                input.addEventListener("keyup", (e) => {
                    // Pindah fokus ke input berikutnya saat pengguna mengetik angka
                    if (e.target.value.length === 1) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }

                    // Jika backspace ditekan, kembali ke input sebelumnya
                    if (e.key === "Backspace" && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>

</body>

</html>