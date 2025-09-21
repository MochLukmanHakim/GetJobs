<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetJobs - Header Findjob</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-900">
  @include('layouts.header2')

  <!-- Lowongan Unggulan -->
  <section class="relative py-20 bg-white z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @php
          // Mapping kategori => icon
      $icons = [
        'IT' => 'fas fa-laptop-code text-blue-500 text-2xl',
        'Backend' => 'fas fa-server text-yellow-500 text-2xl',
        'Desainer' => 'fas fa-pencil-ruler text-purple-500 text-2xl',
        'Marketing' => 'fas fa-bullhorn text-red-500 text-2xl',
        'Finance' => 'fas fa-coins text-green-600 text-2xl',
        'HR' => 'fas fa-user-tie text-pink-500 text-2xl',
        'Sales' => 'fas fa-handshake text-orange-500 text-2xl',
        'Support' => 'fas fa-headset text-indigo-500 text-2xl',
        'UMKM' => 'fas fa-store text-teal-500 text-2xl',
        'Legal' => 'fas fa-balance-scale text-gray-700 text-2xl',
      ];

          $jobs = [
        [
          'title' => 'Karyawan jaga Cilok',
          'company' => 'Cilok Enak',
          'location' => 'Solo',
          'salary' => 'Rp 2-3juta',
          'type' => 'Penuh Waktu',
          'category' => 'UMKM',
        ],
        [
          'title' => 'Legal Officer',
          'company' => 'Law & Co',
          'location' => 'Jakarta',
          'salary' => 'Rp 10-18 juta',
          'type' => 'Hybrid',
          'category' => 'Legal',
        ],
        [
          'title' => 'Senior Frontend Developer',
          'company' => 'TechCorp Indonesia',
          'location' => 'Jakarta',
          'salary' => 'Rp 15-25 juta',
          'type' => 'Penuh Waktu',
          'category' => 'IT',
        ],
        [
          'title' => 'Backend Developer',
          'company' => 'InnovateLab',
          'location' => 'Yogyakarta',
          'salary' => 'Rp 12-20 juta',
          'type' => 'Remote',
          'category' => 'Backend',
        ],
        [
          'title' => 'Mobile App Developer (Flutter)',
          'company' => 'Appify',
          'location' => 'Semarang',
          'salary' => 'Rp 12-22 juta',
          'type' => 'Penuh Waktu',
          'category' => 'IT',
        ],
        [
          'title' => 'Data Scientist',
          'company' => 'BigData ID',
          'location' => 'Bandung',
          'salary' => 'Rp 25-40 juta',
          'type' => 'Penuh Waktu',
          'category' => 'IT',
        ],
        [
          'title' => 'UI/UX Designer',
          'company' => 'AmandaCorp',
          'location' => 'Malang',
          'salary' => 'Rp 18-40 juta',
          'type' => 'Penuh Waktu',
          'category' => 'Desainer',
        ],
        [
          'title' => 'Graphic Designer',
          'company' => 'CreativeHouse',
          'location' => 'Bali',
          'salary' => 'Rp 8-14 juta',
          'type' => 'Penuh Waktu',
          'category' => 'Desainer',
        ],
        [
          'title' => 'Digital Marketing Specialist',
          'company' => 'Brandify',
          'location' => 'Bandung',
          'salary' => 'Rp 10-18 juta',
          'type' => 'Penuh Waktu',
          'category' => 'Marketing',
        ],
        [
          'title' => 'Social Media Strategist',
          'company' => 'ViralMedia',
          'location' => 'Jakarta',
          'salary' => 'Rp 9-16 juta',
          'type' => 'Hybrid',
          'category' => 'Marketing',
        ],
        [
          'title' => 'Finance Analyst',
          'company' => 'MoneyCare',
          'location' => 'Jakarta',
          'salary' => 'Rp 20-30 juta',
          'type' => 'Hybrid',
          'category' => 'Finance',
        ],
        [
          'title' => 'Accountant',
          'company' => 'Finansia Group',
          'location' => 'Surabaya',
          'salary' => 'Rp 12-18 juta',
          'type' => 'Penuh Waktu',
          'category' => 'Finance',
        ],
        [
          'title' => 'HR Recruitment Officer',
          'company' => 'TalentHub',
          'location' => 'Surabaya',
          'salary' => 'Rp 8-15 juta',
          'type' => 'Penuh Waktu',
          'category' => 'HR',
        ],
        [
          'title' => 'HR Manager',
          'company' => 'PeopleFirst',
          'location' => 'Jakarta',
          'salary' => 'Rp 15-25 juta',
          'type' => 'Hybrid',
          'category' => 'HR',
        ],
        [
          'title' => 'Sales Executive',
          'company' => 'GlobalMart',
          'location' => 'Medan',
          'salary' => 'Rp 7-12 juta + bonus',
          'type' => 'Penuh Waktu',
          'category' => 'Sales',
        ],
        [
          'title' => 'Sales Manager',
          'company' => 'MarketLeaders',
          'location' => 'Bandung',
          'salary' => 'Rp 15-25 juta',
          'type' => 'Hybrid',
          'category' => 'Sales',
        ],
        [
          'title' => 'Customer Support Specialist',
          'company' => 'HelpDesk ID',
          'location' => 'Remote',
          'salary' => 'Rp 6-10 juta',
          'type' => 'Remote',
          'category' => 'Support',
        ],
        [
          'title' => 'Customer Service Officer',
          'company' => 'Servisindo',
          'location' => 'Jakarta',
          'salary' => 'Rp 8-13 juta',
          'type' => 'Penuh Waktu',
          'category' => 'Support',
        ],
      ];
      @endphp

      <!-- Search Box Border (Sesuai Hero Header) -->
      <!-- Search Box dihapus sesuai permintaan user -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($jobs as $job)
        <div x-data="{ open: false }" class="bg-white border border-gray-200 p-6 rounded-xl hover:shadow-lg transition flex flex-col h-full">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg">
              <i class="{{ $icons[$job['category']] ?? 'fas fa-briefcase text-gray-500 text-2xl' }}"></i>
            </div>
            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">
              {{ $job['type'] }}
            </span>
          </div>
          <h3 class="font-bold text-gray-900 mb-2">{{ $job['title'] }}</h3>
          <p class="text-gray-600 font-medium mb-3">{{ $job['company'] }}</p>
          <p class="text-sm text-gray-500">{{ $job['location'] }} • {{ $job['salary'] }}</p>

          <div class="mt-auto">
            <button @click="open = true" class="w-full bg-gray-100 text-gray-800 py-3 rounded-lg font-medium hover:bg-black hover:text-white transition">
              Lamar Sekarang
            </button>
          </div>

          <!-- Modal -->
          <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50" x-transition>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="open = false"></div>

            <!-- Box -->
            <div class="relative bg-white rounded-xl w-96 p-7 shadow-2xl border border-gray-200">
              <button @click="open = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
              </button>
              <h2 class="text-2xl font-bold text-gray-900 mb-3">Melamar Pekerjaan</h2>
              <p class="text-gray-600 text-sm mb-5">
                Jika Anda ingin melamar posisi <b>{{ $job['title'] }}</b>, silakan unggah CV Anda (PDF).
              </p>
              <form x-data="{ showNotif: false }" @submit.prevent="showNotif = true" action="{{ route('send.cv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="cv" accept="application/pdf" required
                  class="w-full p-3 mb-4 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-700">
                <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
                  Kirim CV ke Perusahaan
                </button>
                <!-- Popup Notifikasi -->
                <div x-show="showNotif" x-cloak class="fixed inset-0 flex items-center justify-center z-50" x-transition>
                  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showNotif = false"></div>
                  <div class="relative bg-white rounded-xl w-96 p-7 shadow-2xl border border-gray-200 text-center">
                    <button @click="showNotif = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                      <i class="fas fa-times"></i>
                    </button>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Pengiriman Berhasil</h2>
                    <p class="text-gray-700 mb-5">Terima kasih, CV Anda telah berhasil dikirim. Untuk memantau kelanjutan proses lamaran, silakan kunjungi halaman <b>Riwayat</b> pada akun Anda.</p>
                    <a href="{{ route('riwayat') }}" class="inline-block bg-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-800 transition">Lihat Riwayat</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  @include('layouts.footer')
</body>
</html>
