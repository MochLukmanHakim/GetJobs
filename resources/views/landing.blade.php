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



                 <!-- Talent Needs Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Left: Images Grid -->
            <div class="grid grid-cols-2 gap-6">

                <!-- Card 1 -->
                <div class="relative w-full h-52 overflow-hidden shadow-md rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&h=400&fit=crop&crop=face"
                        alt="Professional Working 1" class="w-full h-full object-cover" />
                    <div
                        class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-medium shadow flex items-center">
                        <span>1k+ Lowongan Terpenuhi</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="relative w-full h-52 overflow-hidden shadow-md rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=400&fit=crop&crop=face"
                        alt="Meeting" class="w-full h-full object-cover" />
                </div>

                <!-- Card 3 -->
                <div class="relative w-full h-52 overflow-hidden shadow-md rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face"
                        alt="Candidate 3" class="w-full h-full object-cover" />
                </div>

                <!-- Card 4 -->
                <div class="relative w-full h-52 overflow-hidden shadow-md rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?w=400&h=400&fit=crop&crop=face"
                        alt="Professional Working 2" class="w-full h-full object-cover" />
                    <div
                        class="absolute bottom-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-medium shadow flex items-center">
                        <span class="mr-2">18k+ Kandidat</span>
                        <div class="flex -space-x-1">
                            <div class="w-5 h-5 rounded-full bg-blue-500 border-2 border-white"></div>
                            <div class="w-5 h-5 rounded-full bg-green-500 border-2 border-white"></div>
                            <div class="w-5 h-5 rounded-full bg-yellow-400 border-2 border-white"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Text Content -->
            <div class="lg:pl-8">
                <div class="text-sm text-blue-600 font-semibold mb-3">Mengapa Harus Kami?</div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-snug">
                    Talenta yang Anda Butuhkan, Ada dalam Genggaman
                </h2>
                <p class="text-lg text-gray-700 mb-3 font-medium">
                    Talenta yang Anda Butuhkan, Ada dalam Genggaman
                </p>
                <p class="text-gray-600 mb-8 max-w-xl leading-relaxed">
                    Dalam 5 menit, semuanya siap. Pengaturan simpel dan desain halaman yang fleksibel
                    akan memanjakan mata Anda.
                </p>
                <button
                    class="bg-gray-900 text-white px-6 py-3 rounded-full font-medium hover:bg-gray-800 transition-all shadow-md">
                    Unggah Kerja
                </button>
            </div>
        </div>
    </div>
</section>



  <!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
  <div class="max-w-4xl mx-auto px-6 text-center" x-data="testimonialSlider()">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">Apa Kata Mereka:</h2>

      <!-- Profil Avatars -->
      <div class="flex justify-center space-x-4 mb-8">
          <template x-for="(t, i) in testimonials" :key="i">
              <img :src="t.img" :alt="t.name"
                  class="w-16 h-16 rounded-full object-cover border-4 cursor-pointer transition-all duration-500"
                  :class="activeIndex === i ? 'border-blue-600 scale-110 shadow-lg' : 'border-gray-300 opacity-60 hover:opacity-100'"
                  @click="setActive(i)">
          </template>
      </div>

      <!-- Review aktif -->
      <div class="relative max-w-2xl mx-auto min-h-[200px]">
          <template x-for="(t, i) in testimonials" :key="i">
              <div x-show="activeIndex === i" x-transition.opacity.duration.500
                  class="absolute inset-0 flex flex-col items-center justify-center">
                  <h3 class="text-xl font-bold text-gray-900" x-text="t.name"></h3>
                  <p class="text-gray-600 text-sm mb-3" x-text="t.role"></p>
                  <p class="text-lg text-gray-700 italic leading-relaxed px-4" x-text="t.review"></p>
              </div>
          </template>
      </div>
  </div>
</section>

        <!-- Dots navigation -->
        <div class="flex justify-center mt-6 space-x-2">
            <button class="testimonial-dot w-2 h-2 rounded-full bg-white-500"></button>
            <button class="testimonial-dot w-2 h-2 rounded-full bg-white-300"></button>
            <button class="testimonial-dot w-2 h-2 rounded-full bg-white-300"></button>
            <button class="testimonial-dot w-2 h-2 rounded-full bg-white-300"></button>
        </div>
    </div>
</section>

{{-- Footer dipanggil seperti biasa --}}

    @include('layouts.footer')



<script>
function testimonialSlider() {
  return {
      activeIndex: 0,
      interval: null,
      testimonials: [
          {
              img: "https://images.unsplash.com/photo-1502685104226-ee32379fefbe?w=200&h=200&fit=crop&crop=face",
              name: "Alex Johnson",
              role: "Frontend Developer – TechCorp",
              review: "Platform ini sangat membantu saya menemukan pekerjaan impian. Proses apply mudah dan respons cepat."
          },
          {
              img: "https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=200&h=200&fit=crop&crop=face",
              name: "Maria Garcia",
              role: "UI/UX Designer – Creative Studio",
              review: "GetJobs memberikan akses ke perusahaan-perusahaan terbaik. Interface user-friendly banget!"
          },
          {
              img: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop&crop=face",
              name: "David Chen",
              role: "Data Scientist – DataCorp",
              review: "Sangat terkesan dengan kualitas lowongan yang tersedia. Filter detail sangat membantu."
          },
          {
              img: "https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=200&h=200&fit=crop&crop=face",
              name: "Sarah Wilson",
              role: "Product Manager – StartupXYZ",
              review: "Platform terpercaya untuk mencari talenta berkualitas. Matching kandidat akurat banget."
          }
      ],
      setActive(i) {
          this.activeIndex = i;
      },
      next() {
          this.activeIndex = (this.activeIndex + 1) % this.testimonials.length;
      },
      init() {
          this.interval = setInterval(() => this.next(), 4000);
      }
  }
}
</script>