<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lengkapi Data - Getjobs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #fff;
      color: #002746;
    }

    

    /* PROFILE */
    .profile {
      text-align: center;
      padding: 50px 0;
    }
    .profile img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #2F4157;
    }
    .profile h3 {
      margin: 15px 0 5px;
    }
    .profile p {
      margin: 0;
      color: #555;
    }

    /* FORM */
    .form-container {
      max-width: 700px;
      margin: auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      padding: 20px;
    }
    .form-container input {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .form-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    .form-buttons button {
      padding: 10px 25px;
      border-radius: 25px;
      border: 1px solid #000;
      font-size: 14px;
      cursor: pointer;
      transition: 0.3s;
    }
    .form-buttons .batal {
      background: none;
      color: #000;
    }
    .form-buttons .batal:hover {
      background: #eee;
    }
    .form-buttons .simpan {
      background: #2F4157;
      color: #fff;
      border: none;
    }
    .form-buttons .simpan:hover {
      background: #577C8E;
    }

    /* FOOTER */
    footer {
      background: #f9f9f9;
      padding: 50px 10% 20px;
      margin-top: 80px;
      position: relative;
      overflow: hidden;
    }
    footer .grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 40px;
    }
    footer h3 {
      font-size: 16px;
      margin-bottom: 15px;
      font-weight: 600;
    }
    footer ul {
      list-style: none;
      padding: 0;
      margin: 0;
      line-height: 2;
    }
    footer p {
      font-size: 14px;
      color: #444;
      line-height: 1.6;
    }
    .footer-input {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 25px;
      overflow: hidden;
      max-width: 220px;
    }
    .footer-input input {
      border: none;
      flex: 1;
      padding: 8px 12px;
      font-size: 14px;
      outline: none;
    }
    .footer-input button {
      background: #2F4157;
      color: #fff;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
    }
    .socials img {
      width: 20px;
      margin-right: 10px;
    }
    footer .ornamen {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
      overflow: hidden;
    }
    footer .ornamen span {
      position: absolute;
      border-radius: 50%;
      opacity: 0.4;
    }
    .circle1 { width:20px; height:20px; background:#577C8E; top:20%; left:15%; }
    .circle2 { width:15px; height:15px; background:#E6F3FF; top:50%; left:40%; }
    .circle3 { width:25px; height:25px; background:#2F4157; top:70%; left:70%; }
    .circle4 { width:18px; height:18px; background:#9c8dff; top:40%; left:80%; }
    footer hr {
      margin: 40px 0 20px;
      border: 0;
      border-top: 1px solid #ddd;
    }
    footer .copy {
      text-align: center;
      font-size: 13px;
      color: #555;
    }
  </style>
</head>
<body>

  @include('layouts.header')
  <!-- PROFILE -->
  <section class="profile">
    <img src="https://i.ibb.co/f9wPtwq/dasha.png" alt="profile">
    <h3>@Dasha Taran</h3>
    <p>Dashaotarn@gmail.com</p>
  </section>

  <!-- FORM -->
  <section>
    <form class="form-container" action="/profil/update" method="POST">
      <!-- kalau Laravel nanti pakai @csrf -->
      <input type="text" name="nama_depan" placeholder="Nama Depan" value="Dasha" required>
      <input type="text" name="nama_belakang" placeholder="Nama Belakang" value="Taran" required>
      <input type="email" name="email" placeholder="Email" value="Dashaotarn@gmail.com" required>
      <input type="tel" name="telp" placeholder="Nomor Telephone" value="8837262801873" required>
    </form>
    <div class="form-buttons">
      <button class="batal" type="button" onclick="window.location.href='/'">Batal</button>
      <button class="simpan" type="submit" form="profilForm">Simpan</button>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="grid">
      <!-- Logo & Deskripsi -->
      <div>
        <h2>Getjobs</h2>
        <p>Searching for a job or hiring? Do both with ease on our smart and intuitive platform.</p>
        <div class="socials">
          <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" alt="fb">
          <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="ig">
          <img src="https://cdn-icons-png.flaticon.com/512/1384/1384062.png" alt="yt">
          <img src="https://cdn-icons-png.flaticon.com/512/1384/1384061.png" alt="tw">
        </div>
      </div>

      <!-- Kota Besar -->
      <div>
        <h3>Kota Besar</h3>
        <ul>
          <li>Bandung</li>
          <li>Jakarta</li>
          <li>Malang</li>
          <li>Semarang</li>
          <li>Surabaya</li>
        </ul>
      </div>

      <!-- Kategori -->
      <div>
        <h3>Kategori</h3>
        <ul>
          <li>Communication</li>
          <li>Engineering</li>
          <li>Business</li>
          <li>Design</li>
          <li>Technology</li>
        </ul>
      </div>

      <!-- Unggah Kerjaan -->
      <div>
        <h3>Unggah Kerjaan</h3>
        <p>Employer? Post your job here</p>
        <div class="footer-input">
          <input type="text" placeholder="masukkan anda">
          <button>→</button>
        </div>
      </div>
    </div>

    <div class="ornamen">
      <span class="circle1"></span>
      <span class="circle2"></span>
      <span class="circle3"></span>
      <span class="circle4"></span>
    </div>

    <hr>
    <p class="copy">© Copyright 2025 All Rights Reserved by GetJobs ID</p>
  </footer>

</body>
</html>
