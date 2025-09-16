
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
   <a href ="{{ route (name:'login')}}"> <button class="btn-login">Login</button></a>
    <button class="btn-unggah">Unggah Kerja</button>
  </div>
</nav>
<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Menghubungkan Bakat Terbaik<br> dengan Kesempatan Terbaik</h1>
    <p>Cocok-in Skillmu, Dapat-in Kerja yang Worth It!</p>

    <div class="search-box">
      <input type="text" class="form-control" placeholder="Masukkan...">
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
      <button class="btn btn-dark">Search</button>
    </div>

    <div class="lowongan">
      Cari Kandidat? <a href="#">Pasang Lowongan di Sini!</a>
    </div>
  </div>

  <!-- Profil -->
  <div class="profile p1"><img src="{{ asset('images/imgB.jpeg') }}" alt=""></div>
  <div class="profile p2"><img src="{{ asset('images/img2.jpeg') }}" alt=""></div>
  <div class="profile p3"><img src="{{ asset('images/imgC.jpeg') }}" alt=""></div>
  <div class="profile p4"><img src="{{ asset('images/img4.jpeg') }}" alt=""></div>
  <div class="profile p5"><img src="{{ asset('images/img5.jpeg') }}" alt=""></div>
  <div class="profile p6"><img src="{{ asset('images/img6.jpeg') }}" alt=""></div>

  <!-- Bubble -->
  <span class="bubble b1"></span>
  <span class="bubble b2"></span>
  <span class="bubble b3"></span>
  <span class="bubble b4"></span>
  <span class="bubble b5"></span>
  <span class="bubble b6"></span>
</section>
