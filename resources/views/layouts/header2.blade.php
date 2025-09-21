<!-- NAVBAR -->
<nav class="bg-white border-b border-gray-200 h-16 flex items-center sticky top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto grid grid-cols-3 items-center w-full px-6">
    
    <!-- Logo -->
    <div class="flex items-center">
      <a href="{{ route('landing') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo GetJobs" class="h-20 -my-2">
      </a>
    </div>

    <!-- Menu (Desktop) -->
    <div class="hidden md:flex items-center justify-center space-x-8 font-bold text-base">
      <a href="{{ route('landing') }}" class="text-black hover:text-gray-600 no-underline transition">Beranda</a>
      <a href="{{ route('findjob') }}" class="text-black hover:text-gray-600 no-underline transition">Temukan</a>
      <a href="{{ route('faq') }}" class="text-black hover:text-gray-600 no-underline transition">FAQ</a>
    </div>

  <!-- Tombol Aksi (Desktop) -->
  <div class="hidden md:flex items-center justify-end gap-2">
      @if(auth('pelamar')->check())
        @php $user = auth('pelamar')->user(); @endphp
        <div class="relative flex items-center gap-4 group">
          <img src="{{ $user->foto ? url('storage/profil/' . $user->foto) : asset('images/dasha.jpg') }}" class="w-10 h-10 rounded-full object-cover ml-[-10px] mr-1" alt="Foto Profil">
          <div class="flex flex-col justify-center">
            <span class="font-semibold leading-tight">{{ $user->nama }}</span>
            <span class="text-xs text-gray-500 leading-tight">{{ $user->email }}</span>
          </div>
          <div class="relative">
            <button id="dropdownBtn2" class="flex items-center px-2 py-2 rounded-full hover:bg-gray-100 transition focus:outline-none">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div id="dropdownMenu2" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50 hidden">
              <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">Profil</a>
              <a href="{{ route('riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">Riwayat</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
              </form>
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                var btn2 = document.getElementById('dropdownBtn2');
                var menu2 = document.getElementById('dropdownMenu2');
                btn2.addEventListener('click', function(e) {
                  e.stopPropagation();
                  menu2.classList.toggle('hidden');
                });
                document.addEventListener('click', function(e) {
                  if (!btn2.contains(e.target)) {
                    menu2.classList.add('hidden');
                  }
                });
              });
            </script>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" 
           class="no-underline text-black px-3 py-1 border border-black rounded-md font-medium hover:bg-gray-100 transition">
          Masuk
        </a>
        <a href="{{ route('register') }}" 
           class="no-underline px-3 py-1 bg-black text-white rounded-md font-medium hover:bg-gray-800 transition">
          Daftar
        </a>
      @endif
    </div>

    <!-- Burger Menu (Mobile) -->
    <button id="menu-btn" class="md:hidden flex flex-col gap-1.5 focus:outline-none">
      <span class="w-6 h-0.5 bg-black"></span>
      <span class="w-6 h-0.5 bg-black"></span>
      <span class="w-6 h-0.5 bg-black"></span>
    </button>

  </div>
</nav>

<!-- HERO -->
<section class="relative w-full bg-gradient-to-br from-[#f9fafb] to-[#eef5fa] h-[400px] overflow-hidden">
  <div class="max-w-[1140px] mx-auto px-8 flex items-center justify-between h-full">

    <!-- Kiri: Teks + Search -->
    <div class="flex-1 max-w-[500px] z-20">
      <h1 class="text-5xl font-bold leading-snug text-[#002746] mb-5">
        Temukan lowongan yang tepat.
      </h1>
      <p class="text-lg text-gray-600 leading-relaxed mb-6">
        Akses ribuan lowongan kerja terpercaya dan mulai bangun kariermu sekarang.
      </p>

      <!-- Search Box -->
      <form action="{{ route('findjob') }}" method="GET"
            class="bg-white shadow-md rounded-xl border border-gray-300 p-2 flex items-center gap-0 overflow-hidden w-full max-w-lg mt-2">
        <input type="text" name="keyword" placeholder="Cari pekerjaan..."
               class="flex-1 px-4 py-2 text-sm border-none focus:outline-none focus:ring-0 min-w-0">
        <span class="w-px h-6 bg-gray-300/50"></span>
        <input type="text" name="lokasi" placeholder="Lokasi"
               class="flex-1 px-4 py-2 text-sm border-none focus:outline-none focus:ring-0 min-w-0">
        <span class="w-px h-6 bg-gray-300/50"></span>
        <select name="kategori"
                class="flex-1 px-4 py-2 text-sm border-none focus:outline-none focus:ring-0 bg-transparent min-w-0">
          <option value="">Kategori</option>
          <option value="IT">IT</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance">Finance</option>
          <option value="Desain">Desain</option>
          <option value="Lainnya">Lainnya</option>
        </select>
        <button type="submit"
                class="bg-black text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-800 transition ml-2 text-sm">
          Cari
        </button>
      </form>
    </div>

    <!-- Kanan: Orang + Icon -->
    <div class="relative flex-1 h-full flex justify-center translate-x-10"> 
      <!-- Geser seluruh container ke kanan pakai translate-x-10 -->

      <img src="{{ asset('images/pria.png') }}" 
           class="absolute bottom-0 h-[380px] object-contain z-10" 
           alt="Hero Image">

      <!-- Dekorasi (posisi diatur ulang agar ikut geser) -->
      <img src="{{ asset('images/icon-uiux.png') }}" 
           class="absolute top-[180px] left-[25%] w-[110px] animate-[float_7s_ease-in-out_infinite] z-20" alt="UI/UX">

      <img src="{{ asset('images/icon-engineer.png') }}" 
           class="absolute top-[280px] right-[8%] w-[80px] animate-[float_8s_ease-in-out_infinite] z-20" alt="Engineer">

      <img src="{{ asset('images/icon-google.png') }}" 
           class="absolute bottom-[40px] left-[28%] w-[50px] animate-[float_6s_ease-in-out_infinite] z-20" alt="Google">

      <img src="{{ asset('images/icon-lowongan.png') }}" 
           class="absolute bottom-[-30px] right-[18%] w-[180px] animate-[float_7s_ease-in-out_infinite] z-20" alt="Lowongan">

      <img src="{{ asset('images/icon-chrome.png') }}" 
           class="absolute bottom-[180px] left-[70%] w-[55px] animate-[float_9s_ease-in-out_infinite] z-20" alt="Chrome">
    </div>

  </div>
</section>

<style>
  /* Animasi floating */
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); } /* naik 12px lalu turun */
  }
</style>

