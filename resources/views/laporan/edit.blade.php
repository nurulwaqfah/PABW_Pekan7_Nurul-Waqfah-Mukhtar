@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')

<div class="form-wrapper">
    <div class="section-heading">
        <span class="section-label">PENGELOLAAN DATA</span>
        <h2>Edit Laporan Banjir</h2>
        <p>Perbarui informasi laporan dan status penanganan.</p>
    </div>

    <form action="{{ route('laporan.update', $laporan) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Pelapor</label>
                <input type="text" name="nama_pelapor"
                       value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}">
                @error('nama_pelapor') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="no_hp"
                       value="{{ old('no_hp', $laporan->no_hp) }}">
                @error('no_hp') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Lokasi Banjir</label>
                <input type="text" name="lokasi"
                       value="{{ old('lokasi', $laporan->lokasi) }}">
                @error('lokasi') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan"
                       value="{{ old('kecamatan', $laporan->kecamatan) }}">
                @error('kecamatan') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Tinggi Air (cm)</label>
                <input type="number" name="tinggi_air"
                       value="{{ old('tinggi_air', $laporan->tinggi_air) }}" min="1">
                @error('tinggi_air') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Status Laporan</label>
                <select name="status">
                    <option value="Menunggu" {{ old('status', $laporan->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ old('status', $laporan->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ old('status', $laporan->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group full-width">
                <label>Keterangan</label>
                <textarea name="keterangan" rows="4">{{ old('keterangan', $laporan->keterangan) }}</textarea>
                @error('keterangan') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group full-width">
                <label>Foto Saat Ini</label>
                @if($laporan->foto)
                    <img class="edit-photo"
                         src="{{ asset('storage/'.$laporan->foto) }}"
                         alt="Foto laporan">
                @else
                    <p>Belum ada foto.</p>
                @endif

                <label>Ganti Foto (Opsional)</label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png">
                <small class="hint">Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.</small>
                @error('foto') <small class="error">{{ $message }}</small> @enderror
            </div>

        </div>

        <div class="action-group">
            <a href="{{ route('laporan.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>

    </form>
</div>

@endsection