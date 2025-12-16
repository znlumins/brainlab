<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tim Pengembang - BrainLab</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            DEFAULT: '#11929C',
                            hover: '#0d7a82',
                            dark: '#0a636a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-slate-50 text-slate-900 font-sans">

    <!-- Panggil Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="w-full max-w-5xl mx-auto px-6 lg:px-12 py-16 lg:py-24 text-center">
        
        <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900">Meet Our Brilliant Team</h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-slate-500">
            Kami adalah tim mahasiswa yang berdedikasi untuk menciptakan solusi inovatif di bidang kesehatan menggunakan teknologi AI.
        </p>

        <!-- Team Grid -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            
            <!-- Person 1: DAFFA AHMAD AL ATTAS -->
            <div class="text-center">
                <div class="relative w-32 h-32 lg:w-40 lg:h-40 mx-auto">
                    <img class="rounded-full object-cover w-full h-full shadow-lg" src="https://image.idntimes.com/post/20250824/20250824_145526_ce368d45-5b28-42ee-94c5-2ec3c3ce2cc5.jpg" alt="Foto Daffa Ahmad Al Attas">
                </div>
                <h3 class="mt-6 text-lg font-bold text-slate-800">Daffa Ahmad A.</h3>
            </div>

            <!-- Person 3: EMBUN BENING CANTIKA DEWI -->            
            <div class="text-center">
                <div class="relative w-32 h-32 lg:w-40 lg:h-40 mx-auto">
                    <img class="rounded-full object-cover w-full h-full shadow-lg" src="https://image.idntimes.com/post/20250611/Mei%20Mei.jpg" alt="Foto Embun Bening Cantika Dewi">
                </div>
                <h3 class="mt-6 text-lg font-bold text-slate-800">Embun Bening C. D.</h3>
            </div>

            <!-- Person 2: SILMAH NABILAH ABIDAH ADELIA -->
            <div class="text-center">
                <div class="relative w-32 h-32 lg:w-40 lg:h-40 mx-auto">
                    <img class="rounded-full object-cover w-full h-full shadow-lg" src="https://image.idntimes.com/post/20241018/untitled-95dedaf45fbeadb02e14da4c75fca70b.png" alt="Foto Silmah Nabilah Abidah Adelia">
                </div>
                <h3 class="mt-6 text-lg font-bold text-slate-800">Silmah Nabilah A. A.</h3>
            </div>

            <!-- Person 4: MUHAMMAD RAYYAN FATIH -->
            <div class="text-center">
                 <div class="relative w-32 h-32 lg:w-40 lg:h-40 mx-auto">
                    <img class="rounded-full object-cover w-full h-full shadow-lg" src="https://i.pinimg.com/736x/73/7e/aa/737eaa719bdec1f5230040fd0cebbcfd.jpg" alt="Foto Muhammad Rayyan Fatih">
                </div>
                <h3 class="mt-6 text-lg font-bold text-slate-800">Muhammad Rayyan F.</h3>
            </div>

        </div>

        {{-- <!-- Call to Action -->
        <div class="mt-24">
            <a href="/consultation" class="inline-block px-8 py-4 bg-brand text-white font-bold rounded-lg shadow-xl shadow-brand/30 hover:bg-brand-hover hover:-translate-y-1 transition-all">
                Mulai Konsultasi dengan AI Kami
            </a>
        </div> --}}
    </main>

</body>
</html>