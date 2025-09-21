<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lamaran Anda - GetJobs</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .detail-label { display: inline-block; width: 120px; font-weight: 600; }
  </style>
</head>
<body class="bg-white text-[#002746]">
  @include('layouts.Hriwayat')
  <!-- Table -->
  <div class="mx-auto my-10 overflow-hidden rounded-lg shadow-md max-w-6xl">
    <table class="w-full border-collapse text-left">
      <thead class="bg-[#002746]">
        <tr>
          <th class="p-4 font-semibold text-left text-white">Judul Pekerjaan</th>
          <th class="p-4 font-semibold text-left text-white">Posisi</th>
          <th class="p-4 font-semibold text-left text-white">Detail</th>
          <th class="p-4 font-semibold text-left text-white">CV</th>
          <th class="p-4 font-semibold text-left text-white">Tanggal Melamar</th>
          <th class="p-4 font-semibold text-left text-white">Pengumuman</th>
          <th class="p-4 font-semibold text-left text-white">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">

        <!-- Contoh: Junior UI/UX (Diterima) -->
        <tr>
          <td class="p-4">Junior UI/UX</td>
          <td class="p-4">Teknologi</td>
          <td class="p-4">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm"
              onclick="showDetailModal('PT Kreatif Digital','Jakarta','Fulltime','Junior UI/UX Designer untuk project aplikasi mobile','MochUIUX.pdf')">
              Lihat
            </button>
          </td>
          <td class="p-4">MochUIUX.pdf</td>
          <td class="p-4">17 Agustus 2025</td>
          <td class="p-4 text-center">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm mx-auto block"
              onclick="showPengumumanModal([
                'Lamaran dikirim: 17 Agustus 2025',
                'Lolos seleksi administrasi: 18 Agustus 2025',
                'Interview dilakukan: 25 Agustus 2025, 10:00 WIB',
                'Diterima dan mulai bekerja: 1 September 2025'
              ], 'Jl. Sudirman No.123, Jakarta', 'hr@kreatifdigital.com')">
              Lihat
            </button>
          </td>
          <td class="p-4 font-semibold text-green-600">Diterima</td>
        </tr>

        <!-- HRD Tambang -->
        <tr>
          <td class="p-4">HRD Tambang</td>
          <td class="p-4">Bisnis</td>
          <td class="p-4">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm"
              onclick="showDetailModal('PT Bumi Tambang','Kalimantan','Fulltime','HRD untuk tambang batubara','MochHRD.pdf')">
              Lihat
            </button>
          </td>
          <td class="p-4">MochHRD.pdf</td>
          <td class="p-4">18 Agustus 2025</td>
          <td class="p-4 text-center">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm mx-auto block"
              onclick="showPengumumanModal([
                'Lamaran dikirim: 18 Agustus 2025',
                'Lolos seleksi administrasi',
                'Interview dijadwalkan: 25 Agustus 2025, 10:00 WIB'
              ], 'Jl. Tambang No.45, Kalimantan', 'hrd@bumitambang.com')">
              Lihat
            </button>
          </td>
          <td class="p-4 font-semibold text-yellow-600">Sedang Interview</td>
        </tr>

        <!-- Chef Dapur -->
        <tr>
          <td class="p-4">Chef Dapur</td>
          <td class="p-4">Makanan</td>
          <td class="p-4">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm"
              onclick="showDetailModal('PT Kuliner Nusantara','Bandung','Part-time','Chef untuk restoran modern','MochChef.pdf')">
              Lihat
            </button>
          </td>
          <td class="p-4">MochChef.pdf</td>
          <td class="p-4">19 Agustus 2025</td>
          <td class="p-4 text-center">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm mx-auto block"
              onclick="showPengumumanModal(['Lamaran dikirim: 19 Agustus 2025','Tidak lolos seleksi Chef Dapur'], '-', '-')">
              Lihat
            </button>
          </td>
          <td class="p-4 font-semibold text-red-600">Tidak Lolos</td>
        </tr>

        <!-- Marketing Digital -->
        <tr>
          <td class="p-4">Marketing Digital</td>
          <td class="p-4">Bisnis</td>
          <td class="p-4">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm"
              onclick="showDetailModal('PT MarketPlus','Surabaya','Fulltime','Digital marketing untuk media sosial','MochMarketing.pdf')">
              Lihat
            </button>
          </td>
          <td class="p-4">MochMarketing.pdf</td>
          <td class="p-4">21 Agustus 2025</td>
          <td class="p-4 text-center">
            <button class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm mx-auto block"
              onclick="showPengumumanModal(['Lamaran dikirim: 21 Agustus 2025','Lamaran sedang ditinjau'], '-', '-')">
              Lihat
            </button>
          </td>
          <td class="p-4 font-semibold text-orange-500">Sedang Ditinjau</td>
        </tr>

      </tbody>
    </table>
  </div>

  <<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black/50 hidden z-50 flex justify-center items-center px-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 mx-auto my-auto overflow-auto">
    <h2 class="text-xl font-bold mb-3 text-left">Detail Lamaran</h2>
    <div id="detailContent" class="text-gray-700 text-sm leading-relaxed space-y-2 text-left">
      <!-- Isi akan diisi JS -->
    </div>
    <div class="mt-4 text-right">
      <button onclick="closeModal('detailModal')" class="px-4 py-2 bg-[#002746] text-white rounded-lg hover:bg-[#02314f]">Tutup</button>
    </div>
  </div>
</div>

<!-- Modal Pengumuman -->
<div id="pengumumanModal" class="fixed inset-0 bg-black/50 hidden z-50 flex justify-center items-center px-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 mx-auto my-auto overflow-auto">
    <h2 class="text-xl font-bold mb-3 text-left">Pengumuman</h2>
    <div class="mb-4 text-gray-600 text-sm text-left">
      Berikut status dan tahapan lamaran Anda. Jika ada pertanyaan, silakan hubungi kontak HR yang tertera.
    </div>
    <div id="pengumumanContent" class="text-gray-700 text-sm leading-relaxed space-y-2 text-left">
      <!-- Isi akan diisi JS -->
    </div>
    <div class="mt-4 text-right">
      <button onclick="closeModal('pengumumanModal')" class="px-4 py-2 bg-[#002746] text-white rounded-lg hover:bg-[#02314f]">Tutup</button>
    </div>
  </div>
</div>

<script>
  function showDetailModal(perusahaan, lokasi, tipe, deskripsi, cv) {
    document.getElementById("detailContent").innerHTML = `
      <div class="space-y-2">
        <div class="flex"><span class="font-semibold min-w-[120px]">Perusahaan</span><span class="mx-1">:</span><span>${perusahaan}</span></div>
        <div class="flex"><span class="font-semibold min-w-[120px]">Lokasi</span><span class="mx-1">:</span><span>${lokasi}</span></div>
        <div class="flex"><span class="font-semibold min-w-[120px]">Tipe</span><span class="mx-1">:</span><span>${tipe}</span></div>
        <div class="flex"><span class="font-semibold min-w-[120px]">Deskripsi</span><span class="mx-1">:</span><span>${deskripsi}</span></div>
        <div class="flex"><span class="font-semibold min-w-[120px]">CV</span><span class="mx-1">:</span><span>${cv}</span></div>
      </div>
    `;
    document.getElementById("detailModal").classList.remove("hidden");
  }

  function showPengumumanModal(historyArray, alamat='-', kontak='-') {
    let html = `<div class="space-y-2">`;
    historyArray.forEach((item, index) => {
      html += `<div class='flex'><span class='font-semibold min-w-[120px]'>${index === 0 ? 'History' : ''}</span>${index === 0 ? "<span class='mx-1'>:</span>" : "<span class='mx-1'></span>"}<span>${item}</span></div>`;
    });
    if(alamat !== '-') html += `<div class='flex'><span class='font-semibold min-w-[120px]'>Alamat</span><span class='mx-1'>:</span><span>${alamat}</span></div>`;
    if(kontak !== '-') html += `<div class='flex'><span class='font-semibold min-w-[120px]'>Kontak HR</span><span class='mx-1'>:</span><span>${kontak}</span></div>`;
    html += `</div>`;
    document.getElementById("pengumumanContent").innerHTML = html;
    document.getElementById("pengumumanModal").classList.remove("hidden");
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
  }
</script>
@include('layouts.footer')
</body>

</html>
