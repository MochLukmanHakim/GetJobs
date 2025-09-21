
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

<!-- HERO ala Hprofil, lebih besar dan ada jarak dari navbar -->
<section class="relative w-full bg-gradient-to-r from-[#f9fafb] to-[#eef5fa] pt-16 pb-10 overflow-hidden">
  <!-- Ornamen lingkaran lembut -->
  <div class="absolute -top-20 -left-20 w-64 h-64 bg-gradient-to-tr from-gray-200 to-transparent rounded-full opacity-30 pointer-events-none"></div>
  <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-gradient-to-tr from-gray-300 to-transparent rounded-full opacity-25 pointer-events-none"></div>

  <div class="relative z-10 max-w-2xl mx-auto px-6 text-center">
    <!-- Judul -->
  <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-snug mb-4">
      Riwayat Lamaran
    </h1>

    <!-- Subjudul -->
  <p class="text-base text-gray-600 max-w-xl mx-auto">
      Lihat status dan riwayat lamaran pekerjaan Anda di sini.
    </p>
  </div>
</section>

