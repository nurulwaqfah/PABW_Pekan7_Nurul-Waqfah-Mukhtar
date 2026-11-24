@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')

<div class="page-heading">
    <span class="section-label">INFORMASI LAPORAN</span>
    <h1>Detail Laporan Banjir</h1>
    <p>Informasi lengkap mengenai laporan masyarakat.</p>
</div>

<div class="detail-card">

    @if($laporan->foto)
        <img class="detail-photo"
             src="{{ asset('storage/'.$laporan->foto) }}"
             alt="Foto kondisi banjir">
    @endif

    <div class="detail-content">
        <div class="detail-row">
            <span>Nama Pelapor</span>
            <strong>{{ $laporan->nama_pelapor }}</strong>
        </div>

        <div class="detail-row">
            <span>Nomor HP</span>
            <strong>{{ $laporan->no_hp }}</strong>
        </div>

        <div class="detail-row">
            <span>Lokasi</span>
            <strong>{{ $laporan->lokasi }}</strong>
        </div>

        <div class="detail-row">
            <span>Kecamatan</span>
            <strong>{{ $laporan->kecamatan }}</strong>
        </div>

        <div class="detail-row">
            <span>Tinggi Air</span>
            <strong>{{ $laporan->tinggi_air }} cm</strong>
        </div>

        <div class="detail-row">
            <span>Status</span>
            <strong>{{ $laporan->status }}</strong>
        </div>

        <div class="detail-row">
            <span>Keterangan</span>
            <strong>{{ $laporan->keterangan ?: '-' }}</strong>
        </div>

        <div class="detail-row">
            <span>Waktu Laporan</span>
            <strong>{{ $laporan->created_at->format('d-m-Y H:i') }}</strong>
        </div>
    </div>

    <div class="action-group detail-actions">
        <a href="{{ route('laporan.index') }}" class="btn-secondary">Kembali</a>
        <a href="{{ route('laporan.edit', $laporan) }}" class="btn-primary">Edit Laporan</a>
    </div>

</div>

@endsection