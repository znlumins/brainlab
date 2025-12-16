<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrainLab - Pahami Kesehatan Anda</title>

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
                                DEFAULT: '#11929C', // Warna Teal BrainLab
                                hover: '#0d7a82',
                                dark: '#0a636a',
                            }
                        },
                        boxShadow: {
                            'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-white text-slate-900 font-sans overflow-x-hidden">

        <!-- Panggil Navbar Component -->
        <x-navbar />

        <!-- Hero Section -->
        <main class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 mt-8 lg:mt-12 pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Left Content -->
                <div class="text-left space-y-6 lg:pr-10 z-20 order-2 lg:order-1">
                    <h1 class="text-5xl lg:text-[4rem] font-extrabold leading-[1.1] text-slate-900">
                        Pahami <br> Kesehatan Anda <br> dengan Edukasi <br> Tumor Terpercaya
                    </h1>
                    <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                        Belajar tentang tumor dan cara membaca hasil MRI dengan bahasa yang mudah dimengerti.
                    </p>
                    <div class="pt-4">
                        <a href="curriculum" class="inline-block px-8 py-4 bg-brand text-white font-bold rounded-lg shadow-xl shadow-brand/30 hover:bg-brand-hover hover:-translate-y-1 transition-all">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="relative flex justify-center lg:justify-end h-[500px] items-center order-1 lg:order-2">
                    
                    <!-- Decorative Circle Ring -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] lg:w-[480px] lg:h-[480px] rounded-full border-[12px] border-slate-100 border-r-brand/80 border-b-brand/80 rotate-45 z-0"></div>

                    <!-- Main Image -->
                    <div class="relative z-10 w-full flex justify-center lg:justify-end">
                        <img src="" 
                             alt="Doctor BrainLab" 
                             class="h-[400px] lg:h-[990px] w-[400px] lg:w-[450px] object-cover rounded-full lg:rounded-none lg:rounded-t-full drop-shadow-2xl relative -top-40 -left-12 mask-image-custom">
                    </div>

                    <!-- Floating Cards -->
                    <div class="absolute top-[35%] -left-2 lg:-left-4 z-20 bg-white p-4 rounded-xl shadow-soft flex items-center gap-4 max-w-[280px] border border-slate-50 animate-bounce-slow">
                        <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Anatomi & Jenis Tumor</h3>
                            <p class="text-[10px] text-slate-500 leading-tight">Membedakan tumor jinak dan ganas.</p>
                        </div>
                    </div>

                    <div class="absolute bottom-16 -right-2 lg:right-0 z-20 bg-white p-4 rounded-xl shadow-soft flex items-center gap-4 max-w-[280px] border border-slate-50 animate-bounce-delayed">
                        <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Panduan Hasil MRI</h3>
                            <p class="text-[10px] text-slate-500 leading-tight">Cara sederhana memahami istilah visual.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar Overlay -->
            <div class="w-full mt-12 lg:mt-0 lg:absolute lg:bottom-10 lg:left-1/2 lg:-translate-x-1/2 max-w-4xl px-4 lg:px-0 z-30">
                <div class="bg-white p-3 rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col md:flex-row gap-2">
                    <div class="flex-grow bg-slate-50 rounded-xl px-4 py-3 flex items-center">
                        <input type="text" placeholder="Cari topik edukasi: Glioma, Meningioma, Cara Baca MRI..." class="w-full bg-transparent border-none outline-none text-sm text-slate-700 placeholder-slate-400 focus:ring-0">
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3 flex items-center md:w-48 justify-between cursor-pointer hover:bg-slate-100 transition-colors">
                        <span class="text-sm font-medium text-slate-700">Any Category</span>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <button class="bg-brand text-white font-bold px-8 py-3 rounded-xl hover:bg-brand-hover transition-colors shadow-lg shadow-brand/20">Cari</button>
                </div>
            </div>
        </main>

        <style>
            /* PENAMBAHAN DI SINI */
            body {
                overflow: hidden; /* Menonaktifkan scroll untuk seluruh halaman */
            }

            @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
            .animate-bounce-slow { animation: float 4s ease-in-out infinite; }
            .animate-bounce-delayed { animation: float 4s ease-in-out infinite 2s; }
            /* Styling khusus agar gambar placeholder ini terlihat pas dipotong */
            .mask-image-custom {
                -webkit-mask-image: linear-gradient(to bottom, black 70%, transparent 100%);
                mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
            }
        </style>
    </body>
</html>