<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Akun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="flex h-screen overflow-hidden">

 <!-- Left -->
  <div class="flex-1 h-screen bg-[#ECEFEC] flex justify-center items-end">
    <img src="{{ asset('images/person.png') }}" 
         alt="Person"
         class="h-full object-contain scale-150 translate-y-8">
  </div>

  <!-- Right -->
  <div class="flex-1 h-screen bg-white flex items-center justify-center">
    <div class="w-4/5 max-w-md text-center">
  <h2 class="text-2xl font-semibold mb-6 text-[#0b0c0c]">Buat Akun</h2>

      @if ($errors->any())
  <div class="mb-4 text-red-600 text-sm">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('success'))
  <div class="mb-4 text-green-600 text-sm">
          {{ session('success') }}
        </div>
      @endif

  <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
        @csrf

  <!-- Input Nama -->
        <div class="relative">
          <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="text" name="name" placeholder="Nama" required
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
        </div>

          <!-- Input Nomor Telepon -->
          <div class="relative">
            <i class="fa fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
            <input type="text" name="phone" placeholder="Nomor Telepon" required
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
          </div>

  <!-- Input Email -->
        <div class="relative">
          <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="email" name="email" placeholder="Email" required
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
        </div>

  <!-- Input Kata Sandi -->
        <div class="relative">
          <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="password" name="password" placeholder="Kata Sandi" required
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
        </div>

  <!-- Input Konfirmasi Kata Sandi -->
        <div class="relative">
          <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
        </div>

  <!-- Input Peran -->
          <div class="relative text-left">
            <label class="block mb-2 text-sm font-medium text-[#577C8E]">Peran</label>
            <select name="role" required class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-[10px] text-sm focus:border-[#577C8E] focus:ring-2 focus:ring-[#577C8E] outline-none">
              <option value="pelamar">Pelamar</option>
              <option value="perusahaan">Perusahaan</option>
            </select>
          </div>

      <!-- Tombol -->
      <button type="submit"
        class="block w-full bg-black text-white text-[15px] font-medium py-3 rounded-[10px] mt-2 hover:bg-[#2F4157] transition duration-300 shadow">
        Daftar
      </button>
      </form>

      <p class="text-center mt-3 text-[13px]">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-[#070707] hover:underline">Masuk</a>
      </p>
    </div>
  </div>

</body>
</html>
