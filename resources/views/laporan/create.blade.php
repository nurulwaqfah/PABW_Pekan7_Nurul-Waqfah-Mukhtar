@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')

<section class="hero">
    <div class="hero-content">
        <span class="hero-label">LAYANAN PELAPORAN BPBD</span>
        <h1>Laporkan Kejadian Banjir di Sekitarmu</h1>
        <p>
            Bantu kami mendapatkan informasi kondisi banjir
            agar penanganan dapat dilakukan dengan lebih cepat.
        </p>
    </div>
    <div class="hero-icon">🌧️</div>
</section>

<div class="form-wrapper">
    <div class="section-heading">
        <span class="section-label">FORMULIR MASYARAKAT</span>
        <h2>Data Laporan Banjir</h2>
        <p>Silakan isi informasi berikut dengan benar.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Terdapat data yang belum sesuai. Silakan periksa kembali formulir.
        </div>
    @endif

    <form action="{{ route('laporan.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Pelapor</label>
                <input type="text" name="nama_pelapor"
                       value="{{ old('nama_pelapor') }}"
                       placeholder="Masukkan nama lengkap">
                @error('nama_pelapor')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="no_hp"
                       value="{{ old('no_hp') }}"
                       placeholder="Contoh: 081234567890">
                @error('no_hp')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Lokasi Banjir</label>
                <input type="text" name="lokasi"
                       value="{{ old('lokasi') }}"
                       placeholder="Nama jalan atau alamat">
                @error('lokasi')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan"
                       value="{{ old('kecamatan') }}"
                       placeholder="Masukkan nama kecamatan">
                @error('kecamatan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Tinggi Genangan Air (cm)</label>
                <input type="number" name="tinggi_air"
                       value="{{ old('tinggi_air') }}"
                       min="1" placeholder="Contoh: 50">
                @error('tinggi_air')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full-width">
                <label>Keterangan Tambahan</label>
                <textarea name="keterangan" rows="4"
                    placeholder="Ceritakan kondisi banjir di lokasi...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full-width">
                <label>Foto Kondisi Banjir</label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png">
                <small class="hint">Format JPG, JPEG, PNG. Maksimal 2 MB.</small>
                @error('foto')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <button type="submit" class="btn-primary">
            Kirim Laporan →
        </button>
    </form>
</div>

@endsection