<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetJobs - header findjob</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: #fff;
    }
.navbar {
  background: #ffffff;
  padding: 0 120px;
  display: flex;
  align-items: center;         /* ✅ semua isi rata tengah vertikal */
  justify-content: space-between;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  height: 70px;                /* ✅ tinggi background fix */
  width: 100%;
  overflow: hidden;            /* ✅ biar logo yg lebih tinggi tidak melebarkan bg */
}

.navbar-brand img {
  height: 80px;                /* ✅ logo lebih besar */
  width: auto;
  object-fit: contain;
  display: block;
  margin-top: -10px;           /* ✅ geser ke atas biar center vertikal */
}

.navbar-menu {
  display: flex;
  gap: 22px;
  justify-content: center;
  align-items: center;
  flex: 1;
}

.navbar-menu a {
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  color: #333;
  transition: 0.2s;
  padding: 6px 8px;
  margin-top: -10px;           /* ✅ geser ke atas biar center vertikal */
}

.navbar-menu a:hover {
  color: #002746;
}

.navbar-actions {
  display: flex;
  gap: 10px;
  align-items: center;
}

.navbar-actions button {
  font-size: 0.9rem;
  padding: 4px 14px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  margin-top: -10px;
}

/* Tombol */
.navbar-actions .btn-login {
  background: #fff !important;
  border: 2px solid #000 !important;
  color: #000 !important;
}

.navbar-actions .btn-login:hover {
  background: #f2f2f2 !important;
}

.navbar-actions .btn-unggah {
  background: #000 !important;
  color: #fff !important;
}

.navbar-actions .btn-unggah:hover {
  background: #333 !important;
}



.hero {
  position: relative; 
  width: 100%;
  padding: 60px 0;
  overflow: hidden;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 55%;
  height: 100%;
  background: linear-gradient(135deg, #f9fafb 0%, #eef5fa 100%);
  border-top-right-radius: 30px;
  border-bottom-right-radius: 30px;
  z-index: 0;
}

.hero .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  max-width: 1140px;
  margin: 0 120px;
  gap: 60px;
  position: relative;
  z-index: 1;
}

.hero-text {
  flex: 1;
  max-width: 520px;
  z-index: 2;
}

.hero-text h1 {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #002746;
  line-height: 1.3;
}

.hero-text p {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 30px;
  line-height: 1.6;
}

.search-box {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  background: #fff;
  padding: 14px;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.08);
}

.search-box input, 
.search-box select {
  border-radius: 8px;
  height: 48px;
  flex: 1;
  border: 1px solid #ddd;
  padding: 0 12px;
  font-size: 0.95rem;
}

.search-box button {
  border-radius: 8px;
  height: 48px;
  font-weight: 600;
  background: #002746;
  color: #fff;
  border: none;
  padding: 0 22px;
  transition: 0.3s;
}

.search-box button:hover { background: #004070; }

.hero-img {
  position: absolute;
  right: 0;   /* nempel ke kanan */
  bottom: 0;  /* nempel ke bawah */
  z-index: 1; /* di belakang dekorasi */
  height: 100%;
}

.hero-img img.main-img {
  height: 120%;          /* biar tinggi lebih besar dari hero */
  max-height: 600px;     /* batas tinggi lebih besar */
  width: auto;
  object-fit: contain;
  border-radius: 0;
  transform: translateX(-5px); /* geser ke kiri 15px dari posisi sebelumnya */
}


/* ================= DEKORASI ================= */
.decor-img { 
  position: absolute; 
  z-index: 3; 
  opacity: 0.95; 
}

/* Atur masing-masing dekorasi */
.decor-uiux {
  top: 156px;
  right: 220px;
  width: 120px;
}

.decor-engineer {
  bottom: 55px;
  right: 20px;
  width: 110px;
}

.decor-google {
  top: 239px;
  left: 70px;
  width:65px;
}

.decor-lowongan {
  bottom: -44px;
  left: 137px;
  width: 200px;
}

.decor-chrome {
  bottom: 186px;
  left: 70%;
  width: 65px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
  .hero .container {
    flex-direction: column;
    text-align: center;
    margin: 0 20px;
    gap: 30px;
  }

  .hero-text h1 { font-size: 2rem; }

  .hero-img { justify-content: center; }

  .hero-img img.main-img {
    max-width: 300px;
    transform: translateX(0);
  }

  .search-box { flex-direction: column; }
}

/* Animasi elegan: melayang + sedikit scale */
@keyframes elegantFloat {
  0%   { transform: translateY(0px) scale(1); }
  50%  { transform: translateY(-8px) scale(1.03); }
  100% { transform: translateY(0px) scale(1); }
}

.decor-img {
  position: absolute;
  z-index: 3;
  opacity: 0.95;
  animation: elegantFloat 6s ease-in-out infinite;
}

/* beda tempo biar nggak bareng */
.decor-uiux     { animation-duration: 7s; }
.decor-engineer { animation-duration: 8s; }
.decor-google   { animation-duration: 6.5s; }
.decor-lowongan { animation-duration: 7.5s; }
.decor-chrome   { animation-duration: 9s; }



  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="{{ asset('images/logo-getjobs2.png') }}" alt="Logo GetJobs">
  </a>

  <div class="navbar-menu">
    <a href="javascript:void(0)" onclick="alert('Beranda page not connected')">Beranda</a>
    <a href="javascript:void(0)" onclick="alert('Temukan page not connected')">Temukan</a>
    <a href="javascript:void(0)" onclick="alert('FAQ page not connected')">FAQ</a>
  </div>

  <div class="navbar-actions">
    <button class="btn-login">Login</button>
    <button class="btn-unggah">Unggah Kerja</button>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <!-- Teks Kiri -->
    <div class="hero-text">
      <h1>Temukan Pekerjaan Impianmu.</h1>
      <p>Akses ribuan lowongan kerja terpercaya dan mulai bangun kariermu sekarang.</p>

      <div class="search-box">
        <input type="text" class="form-control" placeholder="Job Title">
        <select class="form-select">
          <option selected>Location</option>
          <option>Bandung</option>
          <option>Jakarta</option>
          <option>Surabaya</option>
        </select>
        <select class="form-select">
          <option selected>Categories</option>
          <option>Technology</option>
          <option>Design</option>
          <option>Business</option>
        </select>
        <button>Search</button>
      </div>
    </div>

    <!-- Gambar Kanan dengan Dekorasi -->
    <div class="hero-img">
      <img src="{{ asset('images/pria.png') }}" alt="Hero Image" class="main-img">

      <!-- Bubble dekorasi -->
      <img src="{{ asset('images/icon-uiux.png') }}" class="decor-img decor-uiux" alt="UI/UX">
      <img src="{{ asset('images/icon-engineer.png') }}" class="decor-img decor-engineer" alt="Engineer">
      <img src="{{ asset('images/icon-google.png') }}" class="decor-img decor-google" alt="Google">
      <img src="{{ asset('images/icon-lowongan.png') }}" class="decor-img decor-lowongan" alt="Lowongan">
      <img src="{{ asset('images/icon-chrome.png') }}" class="decor-img decor-chrome" alt="chrome">
    </div>
  </div>
</section>

<!-- Talent Needs Section (4 Grid with Meeting + Badge Moved) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Left: Images Grid -->
            <div class="relative w-full h-80">
                
                <!-- Large Card (Left Side - Professional Man) -->
                <div class="absolute top-0 left-0 w-56 h-72 bg-green-200 overflow-hidden shadow-lg" style="border-radius: 0 50px 50px 0;">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop&crop=face"
                        alt="Professional Man" class="w-full h-full object-cover" />
                    <div class="absolute top-4 right-4 bg-white text-gray-800 px-3 py-2 rounded-lg text-xs font-medium shadow flex items-center">
                        <span class="mr-2">1k+ Lowongan Terpenuhi</span>
                        <div class="w-4 h-4 bg-gray-800 rounded-sm flex items-center justify-center">
                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12l-5-5h10l-5 5z"/>
                            </svg>
                        </div>
                    </div>
                    <!-- Decorative dots pattern -->
                    <div class="absolute top-16 right-6">
                        <div class="grid grid-cols-6 gap-1">
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                            <div class="w-1 h-1 bg-gray-400 rounded-full opacity-60"></div>
                        </div>
                    </div>
                </div>

                <!-- Medium Card (Top Right - Professional Woman) -->
                <div class="absolute top-0 right-0 w-44 h-56 bg-pink-200 overflow-hidden shadow-lg" style="border-radius: 50px 0 0 50px;">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616c9c8b8b1?w=400&h=500&fit=crop&crop=face"
                        alt="Professional Woman" class="w-full h-full object-cover" />
                </div>

                <!-- Small Card (Bottom Left - Young Professional) -->
                <div class="absolute bottom-0 left-16 w-36 h-44 bg-blue-200 overflow-hidden shadow-lg z-10" style="border-radius: 50px 0 50px 0;">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=400&fit=crop&crop=face"
                        alt="Young Professional" class="w-full h-full object-cover" />
                    <div class="absolute bottom-3 left-3 bg-white text-gray-800 px-2 py-1 rounded-lg text-xs font-medium shadow flex items-center">
                        <span class="mr-2">18k+ Kandidat</span>
                        <div class="flex -space-x-1">
                            <div class="w-4 h-4 rounded-full bg-blue-500 border-2 border-white"></div>
                            <div class="w-4 h-4 rounded-full bg-green-500 border-2 border-white"></div>
                            <div class="w-4 h-4 rounded-full bg-yellow-400 border-2 border-white"></div>
                            <div class="w-4 h-4 rounded-full bg-red-400 border-2 border-white"></div>
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

</body>
</html> 