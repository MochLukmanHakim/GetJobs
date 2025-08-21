# Cara Menggunakan Sidebar Component

## Struktur yang telah dibuat:

### 1. Layout Utama
- `resources/views/layouts/app.blade.php` - Layout utama dengan sidebar
- `resources/views/components/sidebar.blade.php` - Komponen sidebar
- `resources/views/components/sidebar-styles.blade.php` - CSS untuk sidebar

### 2. Cara Menggunakan di Halaman Baru

```blade
@extends('layouts.app')

@section('title', 'Nama Halaman - GetJobs')
@section('page-title', 'Nama Halaman')

@php
    $activePage = 'nama_menu'; // dashboard, pekerjaan, pelamar, statistik, perusahaan
@endphp

@push('styles')
<style>
    /* CSS khusus untuk halaman ini */
</style>
@endpush

@section('content')
    <!-- Konten halaman di sini -->
@endsection

@push('scripts')
<script>
    // JavaScript khusus untuk halaman ini
</script>
@endpush
```

### 3. Halaman yang sudah dikonversi:
- ✅ dashboard.blade.php
- ✅ pekerjaan.blade.php (sebagian)
- ✅ pelamar.blade.php (sebagian)
- 🔄 statistik.blade.php (dalam proses)
- ⏳ perusahaan.blade.php (belum)

### 4. Fitur Sidebar:
- Responsive design
- Collapsible sidebar
- Mobile-friendly dengan overlay
- Active state untuk menu
- Tooltip saat collapsed

### 5. Parameter $activePage:
- `'dashboard'` - untuk halaman dashboard
- `'pekerjaan'` - untuk halaman manajemen pekerjaan
- `'pelamar'` - untuk halaman manajemen pelamar
- `'statistik'` - untuk halaman statistik
- `'perusahaan'` - untuk halaman perusahaan
