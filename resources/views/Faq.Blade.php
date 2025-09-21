<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - GetJobs</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .answer {
      max-height: 0;
      overflow: hidden;
      opacity: 0;
      transition: max-height 0.35s ease, padding 0.3s ease, opacity 0.3s ease;
    }
    .faq.open .answer {
      max-height: 200px;
      padding-top: 0.6rem;
      opacity: 1;
    }
    .chevron {
      transition: transform 0.3s ease;
    }
    .faq.open .chevron {
      transform: rotate(180deg);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900">

  @include('layouts.header3')

  <section class="max-w-6xl mx-auto px-4 py-10 mb-16">
    <h2 class="text-2xl md:text-3xl font-semibold text-center text-[#002746] mb-8">
      Frequently Asked Questions
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
      <!-- Kolom kiri -->
      <div class="space-y-4">
        @foreach ([
          ['Bagaimana cara mendaftar di GetJobs?', 'Klik tombol "Daftar" di pojok kanan atas, isi data Anda, lalu konfirmasi email.'],
          ['Bagaimana cara melamar pekerjaan?', 'Cari lowongan, klik "Lamar", lalu kirim CV.'],
          ['Apakah saya harus unggah CV setiap melamar?', 'Tidak, sistem otomatis memakai CV terbaru.'],
          ['Bagaimana cara tahu status lamaran?', 'Cek menu Riwayat Lamaran di dashboard Anda.'],
          ['Bagaimana melihat pengumuman interview?', 'Klik tombol "Lihat" pada lamaran Anda.'],
          ['Apa yang harus dilakukan jika dipanggil interview?', 'Ikuti jadwal & lokasi pada pengumuman.'],
          ['Apakah saya bisa membatalkan lamaran?', 'Ya, selama status masih Ditinjau.'],
          ['Apakah saya mendapat notifikasi status?', 'Ya, notifikasi muncul di dashboard & email.'],
          ['Bagaimana cara mengubah password?', 'Masuk ke menu Pengaturan > Ganti Password.'],
          ['Bagaimana cara mengganti email akun?', 'Hubungi admin melalui form bantuan.'],
          ['Apakah saya bisa login dengan Google?', 'Ya, klik tombol "Login dengan Google".'],
          ['Bagaimana cara menambahkan portofolio?', 'Masuk ke Profil, lalu unggah file portofolio Anda.'],
          ['Apakah saya bisa menghapus CV lama?', 'Ya, cukup unggah CV baru, versi lama akan terganti.'],
          ['Apakah saya bisa melamar tanpa CV?', 'Tidak, CV wajib agar HR bisa menilai kualifikasi.'],
          ['Bagaimana melihat perusahaan favorit?', 'Klik menu Favorit di dashboard Anda.']
        ] as $faq)
          <div class="faq bg-white rounded-xl border border-gray-200 shadow-sm px-4 py-3 cursor-pointer hover:shadow-md transition-all">
            <h3 class="flex justify-between items-center text-base font-semibold">
              <span class="text-gray-800">{{ $faq[0] }}</span>
              <svg class="chevron w-5 h-5 text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 15.5l-7-7h14l-7 7z"/>
              </svg>
            </h3>
            <div class="answer">
              <p class="text-sm text-gray-700 leading-relaxed mt-1">{{ $faq[1] }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Kolom kanan -->
      <div class="space-y-4">
        @foreach ([
          ['Berapa lama perusahaan meninjau lamaran?', 'Umumnya 3–7 hari kerja, tergantung perusahaan.'],
          ['Apakah saya bisa melamar banyak lowongan?', 'Bisa, Anda boleh melamar lebih dari satu.'],
          ['Apakah ada lowongan freelance?', 'Ya, gunakan filter jenis pekerjaan.'],
          ['Bagaimana mencari lowongan di kota tertentu?', 'Gunakan kolom lokasi di pencarian.'],
          ['Bagaimana jika saya lupa password?', 'Klik "Lupa Password" lalu reset via email.'],
          ['Bagaimana jika email verifikasi tidak masuk?', 'Periksa spam atau kirim ulang email.'],
          ['Apakah data saya aman?', 'Ya, data dilindungi enkripsi dan server aman.'],
          ['Bagaimana cara menghapus akun?', 'Menu Hapus Akun tersedia di Pengaturan.'],
          ['Apakah saya bisa menonaktifkan notifikasi email?', 'Ya, atur di Pengaturan > Notifikasi.'],
          ['Apakah ada aplikasi GetJobs?', 'Saat ini hanya website, aplikasi segera hadir.'],
          ['Apakah saya bisa melamar dari HP?', 'Ya, website responsif di semua ukuran layar.'],
          ['Bagaimana cara melihat lowongan terbaru?', 'Urutkan hasil pencarian berdasarkan "Terbaru".'],
          ['Apakah saya bisa filter berdasarkan gaji?', 'Ya, gunakan filter rentang gaji di pencarian.'],
          ['Bagaimana cara menghubungi HR?', 'Jika HR mengaktifkan chat, Anda bisa kirim pesan.'],
          ['Apakah GetJobs berbayar?', 'Tidak, semua fitur gratis untuk pelamar.']
        ] as $faq)
          <div class="faq bg-white rounded-xl border border-gray-200 shadow-sm px-4 py-3 cursor-pointer hover:shadow-md transition-all">
            <h3 class="flex justify-between items-center text-base font-semibold">
              <span class="text-gray-800">{{ $faq[0] }}</span>
              <svg class="chevron w-5 h-5 text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 15.5l-7-7h14l-7 7z"/>
              </svg>
            </h3>
            <div class="answer">
              <p class="text-sm text-gray-700 leading-relaxed mt-1">{{ $faq[1] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <div class="h-20 bg-white"></div>

  @include('layouts.footer')

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const faqs = document.querySelectorAll(".faq");
      faqs.forEach(faq => {
        faq.addEventListener("click", () => {
          faqs.forEach(item => {
            if (item !== faq) item.classList.remove("open");
          });
          faq.classList.toggle("open");
        });
      });
    });
  </script>

</body>
</html>
