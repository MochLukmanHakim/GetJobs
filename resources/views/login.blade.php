<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - GetJobs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen overflow-hidden">

  <!-- Left -->
  <div class="flex-1 h-screen bg-[#ECEFEC] flex justify-center items-end">
    <img src="{{ asset('images/person.png') }}" 
         alt="Person"
         class="h-full object-contain scale-150 translate-y-8">
  </div>

  <!-- Right -->
  <div class="flex-1 flex justify-center items-center px-10">
    <div class="w-full max-w-md">
  <h2 class="text-[28px] font-bold text-center mb-6 text-[#2F4157]">Masuk</h2>

    <!-- Formulir Masuk Laravel -->
  <form action="{{ route('login.process') }}" method="POST">
        @csrf
        
  <!-- Email -->
        <div class="relative mb-5">
          <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="email" name="email" placeholder="Email"
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#577C8E]"
            required>
        </div>

  <!-- Kata Sandi -->
        <div class="relative mb-3">
          <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-[#577C8E]"></i>
          <input type="password" name="password" placeholder="Kata Sandi"
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#577C8E]"
            required>
        </div>

        <!-- Lupa kata sandi -->
        <div class="text-right text-xs mb-4">
          <a href="#" class="text-[#577C8E] hover:underline">Lupa kata sandi?</a>
        </div>

        <!-- Tombol Masuk -->
        <button type="submit"
          class="w-full py-3 bg-black text-white rounded-lg font-semibold hover:bg-[#2F4157] transition">
          Masuk
        </button>
      </form>

      <!-- Login Sosial -->
      <div class="text-center text-gray-600 my-4">atau lanjutkan dengan :</div>
      <div class="flex justify-center gap-6 text-xl mb-5">
        <a href="#" class="hover:text-[#2F4157]"><i class="fa-brands fa-google"></i></a>
        <a href="#" class="hover:text-[#2F4157]"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="hover:text-[#2F4157]"><i class="fa-brands fa-facebook-f"></i></a>
      </div>

      <!-- Tautan Daftar -->
      <div class="text-center text-sm">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-[#2F4157] hover:underline">Daftar</a>
      </div>
    </div>
  </div>

  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
