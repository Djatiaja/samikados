<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen font-roboto">

    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center text-white">
                <h1 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h1>
                <span class="text-lg lg:text-xl ml-4">@yield('header-subtitle')</span>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container mx-auto flex flex-col lg:flex-row lg:justify-evenly lg:items-center lg:justify-center  flex-grow">
        @yield('content')
        @yield('scripts')
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

</body>
</html>
