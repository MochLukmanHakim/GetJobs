<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - GetJobs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  @vite(['resources/css/findjob.css'])
  <style>
   body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background: #fff;
}

.btn {
  padding: 8px 18px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  font-weight: 600;
}
.btn-login {
  background: #fff;
  border: 1px solid #000;
}
.btn-upload {
  background: #000;
  color: #fff;
}

/* ====== FAQ ====== */
.faq-section {
  width: 80%;
  margin: 40px auto;
}
.faq-section h2 {
  text-align: center;
  font-size: 26px;
  color: #002746;
  margin-bottom: 30px;
}

.faq-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  align-items: start; /* ✅ tambahan ini */
}

.faq {
  background: #fff;
  padding: 15px 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  cursor: pointer;
  transition: all 0.3s ease;
}
.faq h3 {
  font-size: 16px;
  margin: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.faq span {
  font-weight: bold;
  transition: transform 0.3s;
}
.faq.active span {
  transform: rotate(45deg); /* dari + jadi x */
}

.faq p {
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  margin: 0;
  transition: max-height 0.4s ease, opacity 0.3s ease, margin 0.3s ease;
}

.faq.active p {
  max-height: 200px; /* cukup untuk isi, bisa dinaikkan kalau kontennya panjang */
  opacity: 1;
  margin-top: 10px;
}



  </style>
</head>
<body>

  @include('layouts.header2')

  <!-- FAQ -->
  <div class="faq-section">
    <h2>Frequently Ask Questions</h2>
    <div class="faq-grid">
      <div class="faq">
        <h3>Bagaimana cara agar bisa menemukan pekerjaan sesuai skillku? <span>+</span></h3>
        <p>Gunakan filter pencarian di GetJobs berdasarkan kategori, lokasi, level pengalaman, dan kata kunci yang relevan dengan kemampuan Anda.</p>
      </div>
      <div class="faq">
        <h3>Bagaimana cara membuat akun di GetJobs? <span>+</span></h3>
        <p>Anda dapat membuat akun dengan mendaftar menggunakan email aktif, lalu melengkapi data profil dan CV Anda.</p>
      </div>
      <div class="faq">
        <h3>Apakah aku harus mengunggah CV untuk menggunakan GetJobs? <span>+</span></h3>
        <p>Tidak wajib, tetapi sangat disarankan agar peluang Anda dilihat perusahaan lebih besar.</p>
      </div>
      <div class="faq">
        <h3>Apakah hanya perusahaan yang bisa membagikan lowongan? <span>+</span></h3>
        <p>Ya, hanya akun perusahaan yang diverifikasi dapat mengunggah lowongan kerja di platform GetJobs.</p>
      </div>
      <div class="faq">
        <h3>Apa itu GetJobs? <span>+</span></h3>
        <p>GetJobs adalah platform pencarian kerja modern yang menghubungkan pencari kerja dengan perusahaan secara cepat dan efisien.</p>
      </div>
      <div class="faq">
        <h3>Apakah GetJobs berbayar? <span>+</span></h3>
        <p>Tidak, GetJobs gratis digunakan oleh pencari kerja. Perusahaan dapat memilih paket premium untuk fitur tambahan.</p>
      </div>
      <div class="faq">
        <h3>Bagaimana cara perusahaan mendaftar di GetJobs? <span>+</span></h3>
        <p>Perusahaan dapat mendaftar dengan email bisnis, melengkapi profil perusahaan, dan memverifikasi akun untuk dapat mengunggah lowongan.</p>
      </div>
      <div class="faq">
        <h3>Apakah saya bisa melamar lebih dari satu pekerjaan? <span>+</span></h3>
        <p>Tentu, Anda bisa melamar banyak pekerjaan sekaligus sesuai minat dan kualifikasi Anda.</p>
      </div>
      <div class="faq">
        <h3>Bagaimana cara mengedit profil saya di GetJobs? <span>+</span></h3>
        <p>Buka menu profil di dashboard, lalu pilih edit profil untuk memperbarui data diri, CV, atau foto Anda.</p>
      </div>
      <div class="faq">
  <h3>Apakah saya bisa melacak status lamaran saya? <span>+</span></h3>
  <p>Ya, Anda bisa melihat status lamaran di dashboard. Setiap lamaran akan ditandai apakah sedang diproses, ditolak, atau diterima untuk tahap berikutnya.</p>
</div>

<div class="faq">
  <h3>Apakah ada fitur notifikasi jika ada pekerjaan baru? <span>+</span></h3>
  <p>Ada. Anda dapat mengaktifkan notifikasi email atau notifikasi aplikasi agar selalu update dengan lowongan terbaru sesuai preferensi Anda.</p>
</div>

<div class="faq">
  <h3>Apakah saya bisa menyimpan pekerjaan untuk dilamar nanti? <span>+</span></h3>
  <p>Tentu, gunakan fitur bookmark untuk menyimpan pekerjaan favorit dan melamarnya kapan saja.</p>
</div>

<div class="faq">
  <h3>Apakah ada tes online di GetJobs? <span>+</span></h3>
  <p>Beberapa perusahaan mungkin menyertakan tes online sebagai bagian dari proses rekrutmen. Tes dapat diakses langsung melalui platform GetJobs.</p>
</div>

<div class="faq">
  <h3>Apakah GetJobs hanya untuk pekerjaan full-time? <span>+</span></h3>
  <p>Tidak. GetJobs menyediakan lowongan full-time, part-time, freelance, dan internship dari berbagai industri.</p>
</div>

      <div class="faq">
        <h3>Apakah data saya aman di GetJobs? <span>+</span></h3>
        <p>Ya, GetJobs menggunakan sistem enkripsi dan keamanan data agar informasi pribadi Anda tetap terlindungi.</p>
      </div>
    </div>
  </div>

 @include('layouts.footer')
  
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const faqs = document.querySelectorAll(".faq");

    faqs.forEach(faq => {
      faq.addEventListener("click", () => {
        // tutup semua dulu
        faqs.forEach(f => f.classList.remove("active"));

        // kalau yg diklik belum aktif → buka dia
        if (!faq.classList.contains("active")) {
          faq.classList.add("active");
        }
      });
    });
  });
</script>


</body>
</html>
