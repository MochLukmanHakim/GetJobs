<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetJobs - Landing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
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


    /* Hero */
    .hero {
      background: #f9f9f9;
      text-align: center;
      padding: 80px 20px;
      position: relative;
      overflow: hidden;
    }
    .hero h1 {
      font-size: 2.8rem;
      font-weight: 700;
    }
    .hero p {
      font-size: 1.1rem;
      margin-bottom: 40px;
      color: #333;
    }

    /* Search Box */
    .search-box {
      display: flex;
      justify-content: center;
      gap: 10px;
      max-width: 800px;
      margin: auto;
    }
    .search-box input, 
    .search-box select {
      border-radius: 8px;
    }

    /* Lowongan */
    .lowongan {
      margin-top: 20px;
      font-size: 0.95rem;
    }
    .lowongan a {
      color: #002746;
      font-weight: 600;
      text-decoration: none;
    }

    /* Profil Animasi */
    .profile {
      position: absolute;
      border-radius: 50%;
      overflow: hidden;
      width: 70px;
      height: 70px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      animation: floatProfile 4s ease-in-out infinite alternate;
    }
    .profile img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    @keyframes floatProfile {
      0% { transform: translateY(0px); }
      100% { transform: translateY(-15px); }
    }

    /* Posisi Profil */
    .profile.p1 { top: 20%; left: 8%; }
    .profile.p2 { top: 45%; left: 4%; }
    .profile.p3 { bottom: 20%; left: 10%; }
    .profile.p4 { top: 20%; right: 8%; }
    .profile.p5 { top: 45%; right: 5%; }
    .profile.p6 { bottom: 20%; right: 12%; }

    /* Bubble diam */
    .bubble {
      position: absolute;
      border-radius: 50%;
      opacity: 0.6;
    }
    /* Bubble kiri */
    .bubble.b1 { width: 20px; height: 20px; background: #93B3C0; top: 25%; left: 15%; }
    .bubble.b2 { width: 15px; height: 15px; background: #B381AA; top: 50%; left: 12%; }
    .bubble.b3 { width: 25px; height: 25px; background: #76C0A4; bottom: 22%; left: 18%; }

    /* Bubble kanan (simetris) */
    .bubble.b4 { width: 20px; height: 20px; background: #93B3C0; top: 25%; right: 15%; }
    .bubble.b5 { width: 15px; height: 15px; background: #B381AA; top: 50%; right: 12%; }
    .bubble.b6 { width: 25px; height: 25px; background: #76C0A4; bottom: 22%; right: 18%; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <a class="navbar-brand d-flex align-items-center" href="#">
     <img src="{{ asset('images/logo.png') }}" alt="Logo GetJobs">
  </a>

  <div class="navbar-menu">
    <a href="{{ route('landing') }}">Home</a>
    <a href="{{ route('findjob') }}">FindJobs</a>
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

</body>
</html>
