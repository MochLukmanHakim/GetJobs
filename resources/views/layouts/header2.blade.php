
<!-- Navbar -->
<nav class="navbar">
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="{{ asset('images/logo.png') }}" alt="Logo GetJobs">
  </a>

  <div class="navbar-menu">
    <a href="{{ route('landing') }}">Beranda</a>
    <a href="{{ route('findjob') }}">Temukan</a>
    <a href="{{ route('faq') }}">FAQ</a>
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
