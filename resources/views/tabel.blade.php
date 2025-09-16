<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lamaran Anda - GetJobs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #fff;
      color: #002746;
    }

  
    /* Table Section */
    .table-container {
      margin: 40px 8%;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    thead {
      background: #f5f7fa;
    }

    thead th {
      padding: 15px;
      font-weight: 600;
    }

    tbody td {
      padding: 15px;
      border-top: 1px solid #eee;
    }

    .btn-lihat {
      background: #f5f7fa;
      border: none;
      padding: 6px 12px;
      border-radius: 8px;
      cursor: pointer;
    }

    .status {
      font-weight: 600;
      color: green;
    }

    /* Footer */
    footer {
      background: #f8f8f8;
      padding: 50px 8%;
      margin-top: 60px;
    }

    footer .footer-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 40px;
    }

    footer h4 {
      font-weight: 600;
      margin-bottom: 15px;
    }

    footer ul {
      list-style: none;
    }

    footer ul li {
      margin-bottom: 8px;
      color: #444;
      font-size: 14px;
    }

    footer .logo {
      font-weight: 700;
      margin-bottom: 15px;
    }

    footer .social {
      margin-top: 15px;
    }

    footer .social a {
      margin-right: 10px;
      font-size: 18px;
      color: #002746;
    }

    .copyright {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #ddd;
      font-size: 14px;
      color: #777;
    }
  </style>
</head>
<body>
  @include('layouts.header')
  <!-- Table -->
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Judul pekerjaan</th>
          <th>Posisi</th>
          <th>Detail</th>
          <th>CV</th>
          <th>Tanggal Lamaran</th>
          <th>Pengumuman</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Junior UI/UX</td>
          <td>Teknologi</td>
          <td><button class="btn-lihat">lihat</button></td>
          <td>Moch.pdf</td>
          <td>17 Agustus 2025</td>
          <td><button class="btn-lihat" onclick="showPengumuman('Pengumuman untuk Junior UI/UX: Selamat, Anda diterima!')">lihat</button></td>
          <td class="status">Diterima</td>
        </tr>
        <tr>
          <td>HRD Tambang</td>
          <td>Bisnis</td>
          <td><button class="btn-lihat">lihat</button></td>
          <td>Moch.pdf</td>
          <td>17 Agustus 2025</td>
          <td><button class="btn-lihat" onclick="showPengumuman('Pengumuman untuk HRD Tambang: Anda lolos ke tahap interview.')">lihat</button></td>
          <td class="status">Diterima</td>
        </tr>
        <tr>
          <td>Chef Dapur</td>
          <td>Makanan</td>
          <td><button class="btn-lihat">lihat</button></td>
          <td>Moch.pdf</td>
          <td>17 Agustus 2025</td>
          <td><button class="btn-lihat" onclick="showPengumuman('Pengumuman untuk Chef Dapur: Maaf, Anda belum lolos seleksi.')">lihat</button></td>
          <td class="status">Tidak Lolos</td>
        </tr>
        <tr>
          <td>Software Developer</td>
          <td>Teknologi</td>
          <td><button class="btn-lihat">lihat</button></td>
          <td>Moch.pdf</td>
          <td>17 Agustus 2025</td>
          <td><button class="btn-lihat" onclick="showPengumuman('Pengumuman untuk Software Developer: Selamat, Anda diterima!')">lihat</button></td>
          <td class="status">Diterima</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="logo">GetJobs</div>
        <p>Searching for a job or hiring? Do both with ease on our smart and intuitive platform.</p>
        <div class="social">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div>
        <h4>Kota Besar</h4>
        <ul>
          <li>Bandung</li>
          <li>Jakarta</li>
          <li>Malang</li>
          <li>Semarang</li>
          <li>Surabaya</li>
        </ul>
      </div>
      <div>
        <h4>Kategori</h4>
        <ul>
          <li>Communication</li>
          <li>Engineering</li>
          <li>Business</li>
          <li>Design</li>
          <li>Technology</li>
        </ul>
      </div>
      <div>
        <h4>Unggah Kerjaan</h4>
        <p>Employers? Post your job here</p>
        <input type="text" placeholder="masukkan anda" style="padding:8px; border:1px solid #ccc; border-radius:8px;">
      </div>
    </div>
    <div class="copyright">
      © Copyright 2025 All Rights Reserved by GetJobs ID
    </div>
  </footer>

  <!-- Script untuk pengumuman -->
  <script>
    function showPengumuman(pesan) {
      alert(pesan);
    }
  </script>
</body>
</html>
