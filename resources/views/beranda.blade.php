{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetJobs - Platform Pencarian Kerja Terbaik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/landing.css'])

    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <style>
        .search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: searchBoxFloat 3s ease-in-out infinite;
        }

        @keyframes searchBoxFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .search-container:hover {
            animation-play-state: paused;
            transform: translateY(-8px) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .job-card-animated {
            opacity: 0;
            transform: translateY(30px);
            animation: jobCardSlideIn 0.6s ease-out forwards;
        }

        @keyframes jobCardSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-field-focus {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        .featured-job-hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Testimonials Animation Styles */
        .testimonial-container {
            perspective: 1000px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(147, 51, 234, 0.02) 100%);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.6s ease-in-out;
        }

        .testimonial-container:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(147, 51, 234, 0.05) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .testimonial-content {
            backface-visibility: hidden;
            will-change: transform, opacity;
        }

        .testimonial-avatar {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .testimonial-avatar:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .testimonial-dot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .testimonial-dot:hover {
            transform: scale(1.2);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
                transform: translate3d(0, -30px, 0);
            }

            70% {
                transform: translate3d(0, -15px, 0);
            }

            90% {
                transform: translate3d(0, -4px, 0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .quote-icon {
            transition: transform 0.6s ease-in-out;
        }

        .quote-icon.rotate {
            transform: rotate(10deg);
        }
    </style>
</head>

@section('title', 'Home')

@section('content')

    {{-- Include Header + Hero --}}
    @include('layouts.header')




    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Bagaimana akan bekerja?</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user text-2xl text-white"></i>
                        </div>

                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-16 w-32 h-0.5 bg-gray-300">
                            <div
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-8 border-l-gray-300 border-t-4 border-t-transparent border-b-4 border-b-transparent">
                            </div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Masukkan akun</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Masuk ke akun Anda untuk mulai mencari pekerjaan yang sesuai dengan keahlian dan minat Anda
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-paper-plane text-2xl text-white"></i>
                        </div>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-16 w-32 h-0.5 bg-gray-300">
                            <div
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-8 border-l-gray-300 border-t-4 border-t-transparent border-b-4 border-b-transparent">
                            </div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kirim lamaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pilih pekerjaan yang sesuai dan kirim lamaran Anda dengan mudah melalui platform kami
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="mb-8">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-eye text-2xl text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Periksa Lamaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Cek status kelanjutan lamaran Anda dan dapatkan notifikasi update terbaru dari perusahaan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Wrapper utama -->
    <section class="relative overflow-hidden" x-data="{ activeCategory: 'Lowongan Baru' }">

        <!-- Background kategori -->
        <div class="absolute inset-0 h-60 bg-cover bg-center"
            style="background-image: url('{{ asset('images/categori.png') }}');">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <!-- Header + tombol kategori -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-60 flex flex-col justify-center items-center z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 text-center">
                Cari Berdasarkan Kategori :
            </h2>

            <div class="flex flex-wrap justify-center gap-3">
                @php
                    $categoryButtons = [
                        'Lowongan Baru',
                        'Desainer',
                        'Customer Service',
                        'Analis Data',
                        'Logistik',
                        'Teknik',
                        'Medis',
                        'Keuangan',
                        'Pendidikan',
                        'Penjualan',
                        'Gudang',
                        'Bengkel',
                        'IT',
                    ];
                @endphp

                @foreach ($categoryButtons as $button)
                    <button @click="activeCategory = '{{ $button }}'"
                        class="category-filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === '{{ $button }}' ? 'text-white' :
                            'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                        :style="activeCategory === '{{ $button }}' ? 'background-color:#002746;' : ''">
                        {{ $button }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Lowongan Unggulan -->
        <section class="relative py-20 bg-white z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                @php
                    $jobs = [
                        [
                            'title' => 'Senior Frontend Developer',
                            'company' => 'TechCorp Indonesia',
                            'location' => 'Jakarta',
                            'salary' => 'Rp 15-25 juta',
                            'type' => 'Penuh Waktu',
                            'category' => 'IT',
                            'icon' => 'fas fa-laptop-code text-blue-500 text-2xl',
                        ],
                        [
                            'title' => 'Backend Developer',
                            'company' => 'InnovateLab',
                            'location' => 'Yogyakarta',
                            'salary' => 'Rp 12-20 juta',
                            'type' => 'Remote',
                            'category' => 'IT',
                            'icon' => 'fas fa-server text-yellow-500 text-2xl',
                        ],
                        [
                            'title' => 'UI/UX Designer',
                            'company' => 'AmandaCorp',
                            'location' => 'Malang',
                            'salary' => 'Rp 18-40 juta',
                            'type' => 'Penuh Waktu',
                            'category' => 'Desainer',
                            'icon' => 'fas fa-pencil-ruler text-purple-500 text-2xl',
                        ],
                        [
                            'title' => 'Customer Support Specialist',
                            'company' => 'HelpMe Co',
                            'location' => 'Bandung',
                            'salary' => 'Rp 7-12 juta',
                            'type' => 'Penuh Waktu',
                            'category' => 'Customer Service',
                            'icon' => 'fas fa-headset text-green-500 text-2xl',
                        ],
                        [
                            'title' => 'Data Analyst',
                            'company' => 'DataCorp',
                            'location' => 'Jakarta',
                            'salary' => 'Rp 12-18 juta',
                            'type' => 'Remote',
                            'category' => 'Analis Data',
                            'icon' => 'fas fa-chart-line text-indigo-500 text-2xl',
                        ],
                        [
                            'title' => 'Marketing Executive',
                            'company' => 'StartupXYZ',
                            'location' => 'Surabaya',
                            'salary' => 'Rp 9-15 juta',
                            'type' => 'Hybrid',
                            'category' => 'Pemasaran',
                            'icon' => 'fas fa-bullhorn text-red-500 text-2xl',
                        ],
                    ];

                    // ambil 6 job terbaru
                    $newJobs = collect($jobs)->take(6);
                @endphp

                <!-- Container modal + jobs -->
                <div x-data="{ open: false, selectedJob: '' }">

                    <!-- Modal Wrapper -->
                    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                        <div class="absolute inset-0 bg-black/10 backdrop-blur-sm" @click="open=false"></div>


                        <!-- Modal Box tanpa overlay -->
                        <div class="relative bg-white rounded-xl w-96 p-7 shadow-2xl border border-gray-200 transform transition-transform"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                            <!-- Close button -->
                            <button @click="open=false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>

                            <h2 class="text-2xl font-bold text-gray-900 mb-3">Melamar Pekerjaan</h2>
                            <p class="text-gray-600 text-sm mb-5"
                                x-text="Jika Anda ingin melamar posisi ${selectedJob}, silakan unggah CV Anda (PDF) melalui form berikut. Pastikan file Anda maksimal 2MB.">
                            </p>

                            <form action="{{ route('send.cv') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="cv" accept="application/pdf" required
                                    class="w-full p-3 mb-4 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-700">
                                <button type="submit"
                                    class="w-full bg-blue-900 text-white py-3 rounded-lg font-semibold hover:bg-blue-800">
                                    Kirim CV ke Perusahaan
                                </button>
                            </form>
                        </div>
                    </div>



                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($jobs as $index => $job)
                            <div x-show="(activeCategory === 'Lowongan Baru' && {{ $index }} < 6) 
                    || activeCategory === '{{ $job['category'] }}'"
                                class="bg-white border border-gray-200 p-6 rounded-xl hover:shadow-lg transition-shadow flex flex-col h-full">

                                <!-- Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg">
                                        <i class="{{ $job['icon'] }}"></i>
                                    </div>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">
                                        {{ $job['type'] }}
                                    </span>
                                </div>

                                <!-- Info -->
                                <h3 class="font-bold text-gray-900 mb-2 min-h-[70px] flex items-center">
                                    {{ $job['title'] }}
                                </h3>
                                <p class="text-gray-600 font-medium mb-3">{{ $job['company'] }}</p>

                                <div class="mb-4 space-y-1">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        <span>{{ $job['location'] }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-money-bill-wave mr-2"></i>
                                        <span>{{ $job['salary'] }}</span>
                                    </div>
                                </div>

                                <!-- Tombol -->
                                <div class="mt-auto">
                                    <button @click="open = true"
                                        class="w-full bg-gray-100 text-gray-800 py-3 rounded-lg font-medium hover:bg-black hover:text-white transition-colors">
                                        Lamar Sekarang
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>



                    <!-- Talent Needs Section (4 Grid with Meeting + Badge Moved) -->
                    <section class="py-24 bg-white">
                        <div class="max-w-7xl mx-auto px-6 lg:px-12">
                            <div class="grid lg:grid-cols-2 gap-16 items-center">

                                <!-- Left: Images Grid -->
                                <div class="grid grid-cols-2 gap-6">

                                    <!-- Card 1 (Professional Working) -->
                                    <div class="relative w-full h-52 bg-green-100 rounded-2xl overflow-hidden shadow-md">
                                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&h=400&fit=crop&crop=face"
                                            alt="Professional Working 1" class="w-full h-full object-cover" />
                                        <div
                                            class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-lg text-xs font-medium shadow flex items-center">
                                            <span class="mr-2">1k+ Lowongan Terpenuhi</span>
                                        </div>
                                    </div>

                                    <!-- Card 2 (Meeting Photo) -->
                                    <div class="relative w-full h-52 bg-pink-100 rounded-2xl overflow-hidden shadow-md">
                                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=400&fit=crop&crop=face"
                                            alt="Meeting" class="w-full h-full object-cover" />
                                    </div>

                                    <!-- Card 3 (Candidate 3 without badge) -->
                                    <div class="relative w-full h-52 bg-blue-100 rounded-2xl overflow-hidden shadow-md">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face"
                                            alt="Candidate 3" class="w-full h-full object-cover" />
                                    </div>

                                    <!-- Card 4 (Professional Working + 18k Badge moved here) -->
                                    <div class="relative w-full h-52 bg-gray-100 rounded-2xl overflow-hidden shadow-md">
                                        <img src="https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=400&h=400&fit=crop&crop=face"
                                            alt="Professional Working 2" class="w-full h-full object-cover" />
                                        <div
                                            class="absolute bottom-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-lg text-xs font-medium shadow flex items-center">
                                            <span class="mr-2">18k+ Kandidat</span>
                                            <div class="flex -space-x-1">
                                                <div class="w-5 h-5 rounded-full bg-blue-500 border-2 border-white"></div>
                                                <div class="w-5 h-5 rounded-full bg-green-500 border-2 border-white"></div>
                                                <div class="w-5 h-5 rounded-full bg-yellow-400 border-2 border-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right: Text Content -->
                                <div class="lg:pl-8">
                                    <div class="text-sm text-blue-600 font-semibold mb-3">Mengapa Harus Kami?</div>
                                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-snug">
                                        Kebutuhan Talenta Anda, Tepat di Ujung Jari
                                    </h2>
                                    <p class="text-lg text-gray-700 mb-3 font-medium">
                                        Talenta yang Anda Butuhkan, Ada dalam Genggaman
                                    </p>
                                    <p class="text-gray-600 mb-8 max-w-xl leading-relaxed">
                                        Dalam 5 menit, semuanya siap. Pengaturan simpel dan desain halaman yang fleksibel
                                        akan memanjakan mata Anda.
                                    </p>
                                    <button
                                        class="bg-gray-900 text-white px-6 py-3 rounded-xl font-medium hover:bg-gray-800 transition-all shadow-md">
                                        Unggah Kerja
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>



                    @php
                        // Opsi cepat: definisikan array gambar langsung di Blade
                        $testimonialProfiles = [
                            'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?w=200&h=200&fit=crop&crop=face',
                            'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=200&h=200&fit=crop&crop=face',
                            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop&crop=face',
                            'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=200&h=200&fit=crop&crop=face',
                        ];
                    @endphp

                    <!-- Testimonials Section (Static, Blade-safe) -->
                    <section class="py-20 bg-gray-50">
                        <div class="max-w-5xl mx-auto px-6 text-center">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">Apa Kata Mereka:</h2>

                            <!-- Slider wrapper -->
                            <div class="relative overflow-hidden">
                                <div id="testimonial-track" class="flex transition-transform duration-700 ease-in-out">

                                    <!-- Testimonial 1 -->
                                    <div class="min-w-full px-6">
                                        <div class="max-w-2xl mx-auto">
                                            <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?w=200&h=200&fit=crop&crop=face"
                                                alt="Alex Johnson"
                                                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover shadow">
                                            <h3 class="text-xl font-bold text-gray-900">Alex Johnson</h3>
                                            <p class="text-gray-600 text-sm mb-4">Frontend Developer – TechCorp</p>
                                            <p class="text-lg md:text-xl text-gray-700 leading-relaxed italic">
                                                "Platform ini sangat membantu saya menemukan pekerjaan impian. Proses apply
                                                yang mudah dan respons yang cepat dari perusahaan membuat pengalaman mencari
                                                kerja menjadi menyenangkan."
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Testimonial 2 -->
                                    <div class="min-w-full px-6">
                                        <div class="max-w-2xl mx-auto">
                                            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=200&h=200&fit=crop&crop=face"
                                                alt="Maria Garcia"
                                                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover shadow">
                                            <h3 class="text-xl font-bold text-gray-900">Maria Garcia</h3>
                                            <p class="text-gray-600 text-sm mb-4">UI/UX Designer – Creative Studio</p>
                                            <p class="text-lg md:text-xl text-gray-700 leading-relaxed italic">
                                                "GetJobs memberikan akses ke perusahaan-perusahaan terbaik. Interface yang
                                                user-friendly dan fitur-fitur lengkap membuat saya bisa fokus pada hal yang
                                                penting."
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Testimonial 3 -->
                                    <div class="min-w-full px-6">
                                        <div class="max-w-2xl mx-auto">
                                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop&crop=face"
                                                alt="David Chen"
                                                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover shadow">
                                            <h3 class="text-xl font-bold text-gray-900">David Chen</h3>
                                            <p class="text-gray-600 text-sm mb-4">Data Scientist – DataCorp</p>
                                            <p class="text-lg md:text-xl text-gray-700 leading-relaxed italic">
                                                "Sangat terkesan dengan kualitas lowongan yang tersedia di platform ini.
                                                Filter pencarian yang detail membantu saya menemukan posisi sesuai keahlian
                                                saya."
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Testimonial 4 -->
                                    <div class="min-w-full px-6">
                                        <div class="max-w-2xl mx-auto">
                                            <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=200&h=200&fit=crop&crop=face"
                                                alt="Sarah Wilson"
                                                class="w-20 h-20 rounded-full mx-auto mb-4 object-cover shadow">
                                            <h3 class="text-xl font-bold text-gray-900">Sarah Wilson</h3>
                                            <p class="text-gray-600 text-sm mb-4">Product Manager – StartupXYZ</p>
                                            <p class="text-lg md:text-xl text-gray-700 leading-relaxed italic">
                                                "Platform terpercaya untuk mencari talenta berkualitas. Sistem matching yang
                                                akurat dan database kandidat yang luas membuat proses rekrutmen efisien."
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Dots navigation -->
                            <div class="flex justify-center mt-6 space-x-2">
                                <button class="testimonial-dot w-3 h-3 rounded-full bg-blue-500"></button>
                                <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300"></button>
                                <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300"></button>
                                <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300"></button>
                            </div>
                        </div>
                    </section>

                    @include('layouts.footer')

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const track = document.getElementById("testimonial-track");
                            const dots = document.querySelectorAll(".testimonial-dot");
                            const total = dots.length;
                            let index = 0;

                            function showSlide(i) {
                                track.style.transform = translateX(-${i * 100}%);
                                dots.forEach((dot, dIndex) => {
                                    dot.classList.toggle("bg-blue-500", dIndex === i);
                                    dot.classList.toggle("bg-gray-300", dIndex !== i);
                                });
                                index = i;
                            }

                            function nextSlide() {
                                let next = (index + 1) % total;
                                showSlide(next);
                            }

                            dots.forEach((dot, i) => {
                                dot.addEventListener("click", () => showSlide(i));
                            });

                            setInterval(nextSlide, 3000); // auto geser tiap 5 detik
                        });
                    </script>