<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lengkapi Data - GetJobs</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

@include('layouts.Hprofil')

@if($profil)
  <!-- Notifikasi sukses -->
  @if(session('success'))
    <div class="max-w-2xl mx-auto mt-6 bg-green-100 text-green-800 p-4 rounded-xl shadow text-center font-medium">
      {{ session('success') }}
    </div>
  @endif

  <!-- Notifikasi error -->
  @if($errors->any())
    <div class="max-w-2xl mx-auto mt-6 bg-red-100 text-red-800 p-4 rounded-xl shadow">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- PROFILE -->
  <section class="text-center pt-10 pb-2">
    <div class="relative w-32 h-32 mx-auto">
      @if(!empty($profil['foto']))
        <img src="{{ url('storage/profil/' . $profil['foto']) }}" 
          class="w-32 h-32 rounded-full border-4 border-[#2F4157] object-cover shadow-lg" 
          alt="profile">
      @else
        <img src="{{ asset('images/dasha.jpg') }}" 
          class="w-32 h-32 rounded-full border-4 border-[#2F4157] object-cover shadow-lg" 
          alt="profile">
      @endif

      <form id="uploadFotoForm" action="{{ route('profil.updateFoto') }}" method="POST" enctype="multipart/form-data" class="absolute bottom-0 right-0">
        @csrf
        <input type="file" name="foto" id="fotoInput" accept="image/*" class="hidden" onchange="document.getElementById('uploadFotoForm').submit();">
        <button type="button" onclick="document.getElementById('fotoInput').click();" title="Ubah foto profil" class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
          </svg>
        </button>
      </form>
    </div>
  </section>

  <!-- FORM -->
  <section class="max-w-2xl mx-auto px-6">
  <form id="profilForm" action="{{ route('profil.update') }}" method="POST" class="bg-white p-8 rounded-3xl shadow-lg border border-gray-200 mt-2 mb-8">
      @csrf
      <div class="mb-6">
        <input type="text" name="nama" value="{{ old('nama', $profil['nama']) }}" placeholder="Nama Lengkap" class="border border-gray-300 rounded-xl px-4 py-3 w-full text-center text-lg font-semibold focus:ring-2 focus:ring-[#2F4157] focus:outline-none transition" required>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <input type="email" name="email" value="{{ old('email', $profil['email']) }}" placeholder="Email" class="border border-gray-300 rounded-xl px-4 py-3 w-full focus:ring-2 focus:ring-[#2F4157] focus:outline-none transition" required>
        <input type="tel" name="phone" value="{{ old('phone', $profil['phone']) }}" placeholder="Nomor Telepon" class="border border-gray-300 rounded-xl px-4 py-3 w-full focus:ring-2 focus:ring-[#2F4157] focus:outline-none transition" required>
      </div>

      <!-- Tombol aksi -->
      <div class="flex justify-center gap-3 mt-6">
        <a href="{{ route('landing') }}" class="px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 font-medium shadow-sm hover:bg-gray-100 hover:border-black transition duration-150 no-underline text-sm">Batal</a>
        <button type="submit" class="px-4 py-2 rounded-md bg-black text-white font-medium shadow hover:bg-gray-800 transition duration-150 flex items-center justify-center text-sm">
          <span id="btnText">Simpan</span>
          <span id="btnLoading" class="hidden">
            <svg class="animate-spin h-4 w-4 inline-block mr-2" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>Loading...
          </span>
        </button>
      </div>
      <script>
        document.getElementById('profilForm').addEventListener('submit', function(e) {
          document.getElementById('btnText').classList.add('hidden');
          document.getElementById('btnLoading').classList.remove('hidden');
        });
      </script>
    </form>
  </section>

@else
  <!-- Jika user belum login -->
  <section class="text-center py-16">
    <h3 class="text-2xl font-semibold text-red-600">Anda belum login. Silakan login untuk mengakses profil.</h3>
    <a href="{{ route('login') }}" class="mt-6 inline-block bg-[#2F4157] text-white rounded-full px-8 py-3 hover:bg-[#577C8E] transition font-medium">Login</a>
  </section>
@endif

<div class="h-24 bg-white"></div>

@include('layouts.footer')
</body>
</html>
