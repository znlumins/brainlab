<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kurikulum Edukasi - BrainLab</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
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
                        }
                    },
                    typography: (theme) => ({
                        DEFAULT: {
                            css: {
                                color: theme('colors.slate.600'),
                                strong: { color: theme('colors.slate.800') },
                                li: { marker: { color: theme('colors.brand.DEFAULT') } },
                            },
                        },
                    }),
                }
            },
            plugins: [
                // Plugin minimal untuk styling teks dalam modal (prose)
                function({ addBase, addComponents, theme }) {
                    addComponents({
                        '.prose': { maxWidth: '65ch', color: theme('colors.slate.600') },
                        '.prose h4': { fontWeight: '700', marginTop: '1.5em', marginBottom: '0.5em', color: theme('colors.slate.900') },
                        '.prose ul': { listStyleType: 'disc', paddingLeft: '1.25em', marginTop: '1em', marginBottom: '1em' },
                        '.prose li': { marginTop: '0.25em', marginBottom: '0.25em' },
                        '.prose p': { marginTop: '1em', marginBottom: '1em', lineHeight: '1.75' },
                    })
                }
            ]
        }
    </script>
</head>
<body class="antialiased bg-white text-slate-900 font-sans">

    <!-- 1. Navbar (Menggunakan Komponen Blade) -->
    <!-- Dibungkus div untuk mempertahankan gaya border & margin bawah halaman ini -->
    <div class="border-b border-gray-100 mb-10">
        <x-navbar />
    </div>

    <!-- 2. Page Header -->
    <header class="max-w-7xl mx-auto px-6 lg:px-12 mb-16">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
            <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight">
                Kurikulum Edukasi Kesehatan
            </h1>
            <p class="text-slate-500 max-w-xl text-lg leading-relaxed lg:text-right">
                Pelajari tentang tumor otak dan cara membaca hasil MRI secara bertahap. Materi disusun sistematis untuk pasien dan tenaga medis.
            </p>
        </div>
        <hr class="mt-12 border-gray-100">
    </header>

    <!-- 3. Course Section 1: Anatomi & Tumor Otak -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-24">
        <!-- Top Info -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Anatomi & Jenis Tumor Otak</h2>
                <p class="text-slate-500">Memahami struktur otak manusia, bagaimana tumor terbentuk, dan perbedaan antara tumor jinak dengan ganas.</p>
            </div>
        </div>

        {{-- <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <img src="https://images.unsplash.com/photo-1622295038749-ab3bf643b3b2?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Dokter menganalisis anatomi otak pada layar">
            <img src="https://images.unsplash.com/photo-1598809223122-15a0b73c91be?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Ilustrasi digital 3D anatomi otak manusia">
            <img src="https://images.unsplash.com/photo-1579154341093-472b5a1c865a?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Peneliti medis di laboratorium neuroscience">
        </div> --}}

        <!-- Meta Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex gap-3">
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">4 Minggu</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">Pemula</span>
            </div>
            <span class="text-slate-900 font-semibold">Kurikulum Dasar</span>
        </div>

        <!-- Interactive Curriculum Strip (Tombol Materi) -->
        <div class="border border-slate-100 rounded-2xl grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-100 bg-white shadow-sm overflow-hidden">
            
            <button onclick="openModal('c1-01')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">01</span>
                <span class="text-sm font-medium text-slate-600">Struktur Otak</span>
            </button>
            <button onclick="openModal('c1-02')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">02</span>
                <span class="text-sm font-medium text-slate-600">Apa itu Tumor?</span>
            </button>
            <button onclick="openModal('c1-03')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">03</span>
                <span class="text-sm font-medium text-slate-600">Jinak vs Ganas</span>
            </button>
            <button onclick="openModal('c1-04')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">04</span>
                <span class="text-sm font-medium text-slate-600">Gejala & Risiko</span>
            </button>
            <button onclick="openModal('c1-05')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">05</span>
                <span class="text-sm font-medium text-slate-600">Diagnosis & Obat</span>
            </button>

        </div>
    </section>

    <!-- 4. Course Section 2: Panduan MRI -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-24">
        <!-- Top Info -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Panduan Membaca MRI</h2>
                <p class="text-slate-500">Panduan praktis untuk orang awam dalam memahami visualisasi hasil scan MRI dan mengenali anomali.</p>
            </div>
        </div>

        <!-- Image Grid -->
        {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <img src="https://images.unsplash.com/photo-1678842145347-bf82d6124f5a?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Hasil scan MRI otak hitam putih">
            <img src="https://images.unsplash.com/photo-1530497610245-92d3c144de18?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Radiolog memegang dan memeriksa film hasil MRI">
            <img src="https://images.unsplash.com/photo-1614926039398-1b777133485a?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl shadow-sm" alt="Tampilan software medis dengan beberapa hasil MRI di layar komputer">
        </div> --}}

        <!-- Meta Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex gap-3">
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">6 Minggu</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">Menengah</span>
            </div>
            <span class="text-slate-900 font-semibold">Kurikulum Lanjutan</span>
        </div>

        <!-- Interactive Curriculum Strip (Tombol Materi) -->
        <div class="border border-slate-100 rounded-2xl grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-100 bg-white shadow-sm overflow-hidden">
            
            <button onclick="openModal('c2-01')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">01</span>
                <span class="text-sm font-medium text-slate-600">Dasar Radiologi</span>
            </button>
            <button onclick="openModal('c2-02')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">02</span>
                <span class="text-sm font-medium text-slate-600">Orientasi Gambar</span>
            </button>
            <button onclick="openModal('c2-03')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">03</span>
                <span class="text-sm font-medium text-slate-600">Identifikasi Tumor</span>
            </button>
            <button onclick="openModal('c2-04')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">04</span>
                <span class="text-sm font-medium text-slate-600">Edema & Nekrosis</span>
            </button>
            <button onclick="openModal('c2-05')" class="px-6 py-6 text-left hover:bg-slate-50 transition-colors group focus:outline-none">
                <span class="block text-4xl font-bold text-slate-900 mb-1 group-hover:text-brand transition-colors">05</span>
                <span class="text-sm font-medium text-slate-600">Studi Kasus</span>
            </button>

        </div>
    </section>

    <!-- ========================================== -->
    <!-- MODAL / POP-UP COMPONENT                   -->
    <!-- ========================================== -->
    <div id="course-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <!-- Background backdrop (Blur & Darken) -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 duration-300" id="modal-backdrop" onclick="closeModal()"></div>

        <!-- Modal Panel Container -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                <!-- Modal Panel Content -->
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl opacity-0 translate-y-4 scale-95 duration-300" id="modal-panel">
                    
                    <!-- Header Modal -->
                    <div class="bg-brand px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white" id="modal-title">Judul Materi</h3>
                        <button onclick="closeModal()" class="text-white/80 hover:text-white focus:outline-none rounded p-1 hover:bg-white/10 transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Body Modal (Scrollable) -->
                    <div class="px-6 py-6 max-h-[70vh] overflow-y-auto prose prose-slate" id="modal-content">
                        <!-- Konten akan dimasukkan di sini oleh JavaScript -->
                    </div>

                    <!-- Footer Modal -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end border-t border-gray-100">
                        <button type="button" class="inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-brand transition sm:ml-3 sm:w-auto" onclick="closeModal()">
                            Tutup Materi
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Javascript Logic -->
    <script>
        // ==========================================
        // DATABASE MATERI (Dari PDF)
        // ==========================================
        const courseData = {
            // == COURSE 1: ANATOMI & TUMOR ==
            'c1-01': {
                title: "01. Struktur Otak & Fungsinya",
                content: `
                    <p>Otak adalah organ kompleks yang tersusun dari miliaran sel saraf dan dilindungi oleh selaput otak (meninges) serta tulang tengkorak. Bersama saraf tulang belakang, otak membentuk Sistem Saraf Pusat (SSP).</p>
                    
                    <h4>3 Bagian Utama Otak:</h4>
                    <ul>
                        <li><strong>Otak Besar (Cerebrum):</strong> Bagian terbesar. Terbagi menjadi otak kanan (mengontrol tubuh kiri) dan otak kiri (mengontrol tubuh kanan). Permukaannya disebut <em>cerebral cortex</em>.
                            <br><em>Terbagi lagi menjadi 4 lobus:</em>
                            <ul style="list-style-type: circle; margin-top: 0.5rem;">
                                <li><strong>Lobus Frontal (Depan):</strong> Gerakan, ucapan, perilaku, memori, emosi, kepribadian, dan berpikir.</li>
                                <li><strong>Lobus Parietal (Atas):</strong> Sensasi (sentuhan, nyeri, suhu), orientasi spasial.</li>
                                <li><strong>Lobus Temporal (Samping):</strong> Pendengaran, ingatan, emosi, dan bicara.</li>
                                <li><strong>Lobus Oksipital (Belakang):</strong> Pusat penglihatan.</li>
                            </ul>
                        </li>
                        <li><strong>Otak Kecil (Cerebellum):</strong> Terletak di belakang bawah. Mengendalikan keseimbangan, koordinasi posisi tubuh, dan gerakan halus (seperti menulis).</li>
                        <li><strong>Batang Otak (Brainstem):</strong> Penghubung ke saraf tulang belakang. Mengatur fungsi vital dan gerakan mata/wajah.</li>
                    </ul>
                `
            },
            'c1-02': {
                title: "02. Apa itu Tumor?",
                content: `
                    <p><strong>Definisi:</strong> Tumor adalah benjolan atau sekelompok sel tidak normal yang terbentuk ketika sel membelah lebih banyak dari yang seharusnya atau tidak mati sebagaimana mestinya.</p>
                    
                    <h4>Penyebab & Faktor Risiko:</h4>
                    <p>Penyebab pasti ketidakseimbangan sel belum diketahui, namun faktor risikonya meliputi:</p>
                    <ul>
                        <li>Pola makan buruk (terlalu banyak lemak).</li>
                        <li>Paparan radiasi berlebihan (Rontgen/CT scan terlalu sering).</li>
                        <li>Infeksi virus/bakteri (HPV, Hepatitis, H. pylori).</li>
                        <li>Merokok dan konsumsi alkohol berlebih.</li>
                        <li>Paparan bahan kimia (arsen, asbes).</li>
                        <li>Faktor genetik/keturunan dan obesitas.</li>
                    </ul>
                    <p style="font-style: italic; color: #64748b; background-color: #f1f5f9; padding: 10px; border-radius: 6px;">Catatan Penting: Tidak semua tumor adalah kanker.</p>
                `
            },
            'c1-03': {
                title: "03. Tumor Jinak vs Ganas",
                content: `
                    <p>Tumor dikelompokkan menjadi 3 jenis utama berdasarkan sifatnya:</p>

                    <div style="background-color: #eff6ff; padding: 16px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid #3b82f6;">
                        <h5 style="font-weight: 700; color: #1e40af; margin: 0 0 4px 0;">1. Tumor Jinak (Benign)</h5>
                        <p style="margin: 0; font-size: 0.9em;">Tidak berpotensi menjadi kanker. Tumbuh lambat, tidak menyebar, memiliki batas tegas (kapsul), dan umumnya tidak kambuh. Contoh: Lipoma, Adenoma, Mioma.</p>
                    </div>

                    <div style="background-color: #fffbeb; padding: 16px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid #d97706;">
                        <h5 style="font-weight: 700; color: #92400e; margin: 0 0 4px 0;">2. Tumor Prakanker</h5>
                        <p style="margin: 0; font-size: 0.9em;">Belum menjadi kanker tapi berpotensi berubah menjadi kanker jika tidak ditangani. Sel membelah abnormal. Contoh: Polip usus besar, Actinic keratosis.</p>
                    </div>

                    <div style="background-color: #fef2f2; padding: 16px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid #ef4444;">
                        <h5 style="font-weight: 700; color: #991b1b; margin: 0 0 4px 0;">3. Tumor Ganas (Malignant / Kanker)</h5>
                        <p style="margin: 0; font-size: 0.9em;">Bersifat ganas, tumbuh cepat, batas tidak tegas, dan selnya bisa menyebar (metastasis) ke organ lain. Bisa kambuh meski sudah diobati.</p>
                    </div>
                `
            },
            'c1-04': {
                title: "04. Gejala & Risiko",
                content: `
                    <p>Gejala utama adalah benjolan. Namun jika di dalam organ, gejalanya bervariasi:</p>

                    <ul>
                        <li><strong>Otak:</strong> Sakit kepala, mual, muntah, kejang.</li>
                        <li><strong>Paru-paru:</strong> Batuk, sesak napas, nyeri dada.</li>
                        <li><strong>Ginjal:</strong> Darah dalam urin, nyeri panggul.</li>
                        <li><strong>Rahim:</strong> Perdarahan berat saat menstruasi.</li>
                        <li><strong>Payudara:</strong> Benjolan yang tidak nyeri dan mudah digerakkan.</li>
                    </ul>

                    <h4>Gejala Khas Tumor Ganas (Kanker):</h4>
                    <ul style="color: #be123c;">
                        <li>Berat badan turun drastis tanpa sebab.</li>
                        <li>Demam berkepanjangan & lemas.</li>
                        <li>Hilang nafsu makan & sulit menelan.</li>
                        <li>Perdarahan/memar yang tidak jelas sebabnya.</li>
                    </ul>
                `
            },
            'c1-05': {
                title: "05. Diagnosis & Pengobatan",
                content: `
                    <h4>Metode Diagnosis</h4>
                    <ul>
                        <li><strong>Pemeriksaan Fisik:</strong> Untuk tumor yang terlihat.</li>
                        <li><strong>Pencitraan:</strong> USG, CT Scan, MRI, atau PET scan untuk melihat lokasi dan ukuran.</li>
                        <li><strong>Biopsi:</strong> Pengambilan sampel jaringan untuk diperiksa di lab (menentukan jinak/ganas).</li>
                    </ul>

                    <h4>Opsi Pengobatan</h4>
                    <ul>
                        <li><strong>Operasi/Bedah:</strong> Mengangkat tumor (sering dilakukan pada tumor jinak besar atau ganas stadium awal).</li>
                        <li><strong>Kemoterapi:</strong> Menggunakan obat-obatan untuk membunuh sel kanker.</li>
                        <li><strong>Radioterapi:</strong> Sinar radiasi tinggi untuk membunuh sel kanker.</li>
                        <li><strong>Imunoterapi:</strong> Merangsang kekebalan tubuh melawan kanker.</li>
                    </ul>
                    
                    <div style="margin-top: 20px; padding: 12px; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; color: #166534;">
                        <strong>Pencegahan (CERDIK):</strong> Cek kesehatan berkala, Enyahkan asap rokok, Rajin aktivitas fisik, Diet seimbang, Istirahat cukup, Kelola stres.
                    </div>
                `
            },

            // == COURSE 2: MRI (Materi Tambahan untuk Konteks) ==
            'c2-01': {
                title: "01. Dasar Radiologi",
                content: "<p>Memahami prinsip dasar bagaimana MRI bekerja menggunakan medan magnet kuat dan gelombang radio untuk menghasilkan gambar detail organ dalam tanpa radiasi pengion (seperti X-ray).</p>"
            },
            'c2-02': {
                title: "02. Orientasi Gambar",
                content: "<p>Dalam membaca MRI, penting memahami potongan gambar:</p><ul><li><strong>Axial:</strong> Potongan melintang (dilihat dari bawah ke atas).</li><li><strong>Sagittal:</strong> Potongan samping (kiri ke kanan).</li><li><strong>Coronal:</strong> Potongan depan ke belakang (seperti memakai bando).</li></ul>"
            },
            'c2-03': {
                title: "03. Identifikasi Tumor pada MRI",
                content: "<p>Tanda-tanda adanya massa pada scan otak:</p><ul><li><strong>Asimetri:</strong> Otak kiri dan kanan seharusnya mirip. Jika beda, ada anomali.</li><li><strong>Efek Massa:</strong> Struktur normal (seperti ventrikel) terdorong atau bergeser.</li><li><strong>Sinyal Abnormal:</strong> Area yang terlalu terang (hiperintens) atau gelap (hipointens) dibanding jaringan sekitar.</li></ul>"
            },
            'c2-04': {
                title: "04. Edema & Nekrosis",
                content: "<p>Membedakan komponen tumor:</p><ul><li><strong>Nekrosis:</strong> Bagian mati di tengah tumor (biasanya gelap pada T1 post-kontras).</li><li><strong>Edema:</strong> Pembengkakan cairan di sekitar tumor (biasanya terang pada T2/FLAIR), menandakan iritasi pada jaringan otak sehat.</li></ul>"
            },
            'c2-05': {
                title: "05. Studi Kasus",
                content: "<p>Analisis perbandingan:</p><ul><li><strong>Glioblastoma:</strong> Tepi tidak rata, menyerap kontras secara cincin (ring enhancement), edema luas.</li><li><strong>Meningioma:</strong> Tepi tegas, menempel pada selaput otak, mendesak otak (bukan menyusup).</li></ul>"
            }
        };

        // ==========================================
        // LOGIKA MODAL (POP-UP)
        // ==========================================
        const modal = document.getElementById('course-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalPanel = document.getElementById('modal-panel');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');

        function openModal(id) {
            const data = courseData[id];
            if (!data) return;

            modalTitle.innerText = data.title;
            modalContent.innerHTML = data.content;

            modal.classList.remove('hidden');
            
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalPanel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
                modalPanel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            }, 10);
        }

        function closeModal() {
            modalBackdrop.classList.add('opacity-0');
            modalPanel.classList.add('opacity-0', 'translate-y-4', 'scale-95');
            modalPanel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape" && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</body>
</html>