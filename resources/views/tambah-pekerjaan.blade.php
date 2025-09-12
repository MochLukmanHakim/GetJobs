@extends('layouts.app')

@section('page-title', 'Tambah Pekerjaan')

@section('header-actions')
@endsection

@php
    $activePage = 'pekerjaan';
@endphp

@section('content')
<style>
    .job-form-wrapper {
        background: #fafbfc;
        min-height: 100vh;
        padding: 2rem 1rem;
    }

    .job-form-container {
        max-width: 840px;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid #e6eaed;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(43, 45, 80, 0.08);
        overflow: hidden;
    }

    .form-header-section {
        background: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem;
        border-bottom: 1px solid #f0f2f5;
    }

    .header-content h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1c1e21;
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.01em;
    }

    .header-content p {
        color: #65676b;
        font-size: 0.95rem;
        margin: 0;
        line-height: 1.4;
    }

    .form-body {
        padding: 0;
    }

    .section-block {
        padding: 2rem 2.5rem;
        border-bottom: 1px solid #f0f2f5;
    }

    .section-block:last-child {
        border-bottom: none;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-number {
        width: 28px;
        height: 28px;
        background: #1877f2;
        color: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 600;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1c1e21;
        margin: 0;
    }

    .field-row {
        display: grid;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .field-row.two-col {
        grid-template-columns: 1fr 1fr;
    }

    .field-group {
        position: relative;
    }

    .field-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #1c1e21;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .required-mark {
        color: #e41e3f;
    }

    .field-input, .field-select, .field-textarea {
        width: 100%;
        padding: 0.75rem 0.875rem;
        border: 1px solid #ccd0d5;
        border-radius: 6px;
        font-size: 0.9rem;
        font-family: inherit;
        background: #ffffff;
        transition: border-color 0.15s ease;
        color: #1c1e21;
    }

    .field-input:focus, .field-select:focus, .field-textarea:focus {
        outline: none;
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
    }

    .field-textarea {
        min-height: 88px;
        resize: vertical;
        line-height: 1.4;
    }

    .field-help {
        font-size: 0.8rem;
        color: #8a8d91;
        margin-top: 0.375rem;
        line-height: 1.3;
    }

    .salary-field {
        position: relative;
    }

    .currency-symbol {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.9rem;
        color: #65676b;
        font-weight: 500;
        pointer-events: none;
    }

    .salary-input {
        padding-left: 2.25rem;
    }

    .form-actions-section {
        background: #f7f8fa;
        padding: 1.5rem 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid transparent;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.15s ease;
        line-height: 1.4;
    }

    .btn-primary {
        background: #1877f2;
        color: #ffffff;
        border-color: #1877f2;
    }

    .btn-primary:hover {
        background: #166fe5;
        border-color: #166fe5;
    }

    .btn-secondary {
        background: #ffffff;
        color: #1c1e21;
        border-color: #ccd0d5;
    }

    .btn-secondary:hover {
        background: #f7f8fa;
        border-color: #bcc0c4;
    }

    .progress-indicator {
        font-size: 0.8rem;
        color: #8a8d91;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .job-form-wrapper {
            padding: 1rem 0.75rem;
        }

        .job-form-container {
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(43, 45, 80, 0.12);
        }

        .form-header-section,
        .section-block {
            padding: 1.5rem 1.25rem;
        }

        .form-actions-section {
            padding: 1.25rem;
            flex-direction: column;
            align-items: stretch;
        }

        .action-buttons {
            order: 1;
            flex-direction: column;
        }

        .progress-indicator {
            order: 2;
            text-align: center;
            margin-top: 0.75rem;
        }

        .field-row.two-col {
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .header-content h1 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="job-form-wrapper">
    <div class="job-form-container">
        <div class="form-header-section">
            <div class="header-content">
                <h1>Tambah Pekerjaan</h1>
                <p>Lengkapi informasi di bawah untuk membuat lowongan kerja baru</p>
            </div>
        </div>

        <form action="{{ route('pekerjaan.store') }}" method="POST" id="addJobForm">
            @csrf
            
            <div class="form-body">
                <!-- Basic Information -->
                <div class="section-block">
                    <div class="section-header">
                        <div class="section-number">1</div>
                        <h2 class="section-title">Informasi Umum</h2>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label" for="judul_pekerjaan">
                                Nama Posisi <span class="required-mark">*</span>
                            </label>
                            <input type="text" id="judul_pekerjaan" name="judul_pekerjaan" class="field-input" 
                                   placeholder="Mis. Senior Frontend Developer" required>
                            <div class="field-help">Tulis nama posisi yang jelas dan spesifik</div>
                        </div>
                    </div>

                    <div class="field-row two-col">
                        <div class="field-group">
                            <label class="field-label" for="kategori">
                                Kategori <span class="required-mark">*</span>
                            </label>
                            <select id="kategori" name="kategori" class="field-select" required>
                                <option value="">Pilih kategori</option>
                                <option value="IT">IT & Technology</option>
                                <option value="Marketing">Marketing & Sales</option>
                                <option value="Finance">Finance & Accounting</option>
                                <option value="HR">Human Resources</option>
                                <option value="Operations">Operations</option>
                                <option value="Design">Design & Creative</option>
                                <option value="Customer Service">Customer Service</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="lokasi">
                                Lokasi <span class="required-mark">*</span>
                            </label>
                            <input type="text" id="lokasi" name="lokasi" class="field-input" 
                                   placeholder="Jakarta Selatan, DKI Jakarta" required>
                        </div>
                    </div>

                    <div class="field-row two-col">
                        <div class="field-group">
                            <label class="field-label" for="tipe_pekerjaan">
                                Tipe Pekerjaan <span class="required-mark">*</span>
                            </label>
                            <select id="tipe_pekerjaan" name="tipe_pekerjaan" class="field-select" required>
                                <option value="">Pilih tipe</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="level">
                                Level Pengalaman <span class="required-mark">*</span>
                            </label>
                            <select id="level" name="level" class="field-select" required>
                                <option value="">Pilih level</option>
                                <option value="Entry Level">Entry Level</option>
                                <option value="Junior">Junior (1-2 tahun)</option>
                                <option value="Mid Level">Mid Level (3-5 tahun)</option>
                                <option value="Senior">Senior (5+ tahun)</option>
                                <option value="Lead">Lead</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Compensation -->
                <div class="section-block">
                    <div class="section-header">
                        <div class="section-number">2</div>
                        <h2 class="section-title">Kompensasi</h2>
                    </div>

                    <div class="field-row two-col">
                        <div class="field-group">
                            <label class="field-label" for="gaji_min">
                                Gaji Minimum
                            </label>
                            <div class="salary-field">
                                <span class="currency-symbol">Rp</span>
                                <input type="number" id="gaji_min" name="gaji_min" class="field-input salary-input" 
                                       placeholder="8000000" min="0">
                            </div>
                            <div class="field-help">Opsional - kosongkan jika tidak ingin ditampilkan</div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="gaji_max">
                                Gaji Maksimum
                            </label>
                            <div class="salary-field">
                                <span class="currency-symbol">Rp</span>
                                <input type="number" id="gaji_max" name="gaji_max" class="field-input salary-input" 
                                       placeholder="15000000" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="section-block">
                    <div class="section-header">
                        <div class="section-number">3</div>
                        <h2 class="section-title">Deskripsi Pekerjaan</h2>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label" for="deskripsi">
                                Deskripsi & Tanggung Jawab <span class="required-mark">*</span>
                            </label>
                            <textarea id="deskripsi" name="deskripsi" class="field-textarea" rows="4"
                                      placeholder="Jelaskan peran, tanggung jawab utama, dan apa yang akan dikerjakan kandidat sehari-hari..." required></textarea>
                            <div class="field-help">Berikan gambaran jelas tentang pekerjaan ini</div>
                        </div>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label" for="persyaratan">
                                Kualifikasi & Persyaratan <span class="required-mark">*</span>
                            </label>
                            <textarea id="persyaratan" name="persyaratan" class="field-textarea" rows="4"
                                      placeholder="• Pendidikan S1 Teknik Informatika atau setara&#10;• Pengalaman minimal 3 tahun dengan React.js&#10;• Mahir JavaScript, TypeScript, HTML5, CSS3&#10;• Familiar dengan Git, REST API" required></textarea>
                            <div class="field-help">Cantumkan persyaratan wajib dan yang diinginkan</div>
                        </div>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label" for="benefit">
                                Benefit & Tunjangan
                            </label>
                            <textarea id="benefit" name="benefit" class="field-textarea" rows="3"
                                      placeholder="• BPJS Kesehatan & Ketenagakerjaan&#10;• Tunjangan makan & transport&#10;• Flexible working hours&#10;• Annual leave 12 hari"></textarea>
                            <div class="field-help">Sebutkan benefit menarik untuk menarik kandidat</div>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="section-block">
                    <div class="section-header">
                        <div class="section-number">4</div>
                        <h2 class="section-title">Pengaturan</h2>
                    </div>

                    <div class="field-row two-col">
                        <div class="field-group">
                            <label class="field-label" for="batas_lamaran">
                                Batas Waktu Melamar <span class="required-mark">*</span>
                            </label>
                            <input type="date" id="batas_lamaran" name="batas_lamaran" class="field-input" required>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="status">
                                Status Publikasi <span class="required-mark">*</span>
                            </label>
                            <select id="status" name="status" class="field-select" required>
                                <option value="draft">Draft - Belum dipublikasi</option>
                                <option value="active">Aktif - Langsung dipublikasi</option>
                                <option value="inactive">Tidak aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions-section">
                <div class="progress-indicator">
                    Langkah 4 dari 4 - Hampir selesai
                </div>
                <div class="action-buttons">
                    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Pekerjaan
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12l5 5L20 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Set minimum date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.getElementById('batas_lamaran').min = tomorrow.toISOString().split('T')[0];

    // Form validation
    document.getElementById('addJobForm').addEventListener('submit', function(e) {
        const gajiMin = document.getElementById('gaji_min').value;
        const gajiMax = document.getElementById('gaji_max').value;

        if (gajiMin && gajiMax && parseInt(gajiMin) > parseInt(gajiMax)) {
            e.preventDefault();
            alert('Gaji minimum tidak boleh lebih besar dari gaji maksimum');
            return false;
        }
    });
</script>
@endsection