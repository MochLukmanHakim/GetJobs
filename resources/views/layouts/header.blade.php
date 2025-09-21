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
          <img src="{{ $user->foto ? url('storage/profil/' . $user->foto) : asset('images/dasha.jpg') }}" class="w-10 h-10 rounded-full object-cover ml-[-10px]" alt="Foto Profil">
          <div class="flex flex-col justify-center">
            <span class="font-semibold leading-tight">{{ $user->nama }}</span>
            <span class="text-xs text-gray-500 leading-tight">{{ $user->email }}</span>
          </div>
          <div class="relative">
            <button class="flex items-center px-2 py-2 rounded-full hover:bg-gray-100 transition focus:outline-none">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50 hidden group-hover:block">
              <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">Profil</a>
              <a href="{{ route('riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">Riwayat</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
              </form>
            </div>
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




<!-- HERO (FULL WIDTH) -->
<section class="w-full bg-gray-50 text-center relative overflow-hidden px-6 pt-10 pb-10">
  <div class="max-w-7xl mx-auto">
    <h1 class="text-3xl md:text-5xl font-bold mb-4">
      Menghubungkan Bakat Terbaik <br> dengan Kesempatan Terbaik
    </h1>
    <p class="text-base md:text-lg text-gray-700 mb-8">
      Cocokin Skillmu, Dapetin Kerja yang Worth It!
    </p>

    <!-- Search Box -->
    <form action="{{ route('findjob') }}" method="GET" class="flex flex-wrap justify-center gap-3 max-w-3xl mx-auto">
      <input type="text" name="search" id="search" placeholder="Cari lowongan..." class="w-60 px-3 py-2 border rounded-lg">
      <select name="location" class="w-40 px-3 py-2 border rounded-lg">
        <option value="">Location</option>
        <option value="Bandung">Bandung</option>
        <option value="Jakarta">Jakarta</option>
        <option value="Surabaya">Surabaya</option>
      </select>
      <select name="category" class="w-40 px-3 py-2 border rounded-lg">
        <option value="">Categories</option>
        <option value="Technology">Technology</option>
        <option value="Design">Design</option>
        <option value="Business">Business</option>
      </select>
      <button type="submit" class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
        <i class="fas fa-search mr-2"></i> Search
      </button>
    </form>

    <!-- Lowongan -->
    <div class="mt-6 text-sm">
      Cari Kandidat?
      <a href="{{ route('register') }}" class="font-semibold text-[#002746] no-underline hover:no-underline">
        Pasang Lowongan di Sini!
      </a>
    </div>

    <!-- Floating Profile Images (gunakan class profile dari landing.css agar proporsional) -->
    <div class="hidden sm:block profile p1">
      <img src="{{ asset('images/imgB.jpeg') }}" alt="Profile 1">
    </div>
    <div class="hidden sm:block profile p2">
      <img src="{{ asset('images/img2.jpeg') }}" alt="Profile 2">
    </div>
    <div class="hidden sm:block profile p3">
      <img src="{{ asset('images/imgC.jpeg') }}" alt="Profile 3">
    </div>
    <div class="hidden sm:block profile p4">
      <img src="{{ asset('images/img4.jpeg') }}" alt="Profile 4">
    </div>
    <div class="hidden sm:block profile p5">
      <img src="{{ asset('images/img5.jpeg') }}" alt="Profile 5">
    </div>
    <div class="hidden sm:block profile p6">
      <img src="{{ asset('images/img6.jpeg') }}" alt="Profile 6">
    </div>

    <!-- Bubble (gunakan class bubble dari landing.css agar proporsional) -->
    <span class="hidden sm:block bubble b1"></span>
    <span class="hidden sm:block bubble b2"></span>
    <span class="hidden sm:block bubble b3"></span>
    <span class="hidden sm:block bubble b4"></span>
    <span class="hidden sm:block bubble b5"></span>
    <span class="hidden sm:block bubble b6"></span>
  </div>
</section>

<style>
@keyframes float {
  0% { transform: translateY(0px); }
  100% { transform: translateY(-15px); }
}

document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    }
});

</style>
