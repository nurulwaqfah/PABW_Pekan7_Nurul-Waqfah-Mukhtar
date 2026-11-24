@extends('layouts.app')

@section('title', 'Dashboard Laporan')

@section('content')

<div class="dashboard-header">
    <div>
        <span class="section-label">PANEL ADMINISTRASI</span>
        <h1>Dashboard Laporan Banjir</h1>
        <p>Kelola dan pantau laporan banjir yang masuk.</p>
    </div>

    <div class="admin-badge">👤 Petugas BPBD</div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <span>Total Laporan</span>
        <h2>{{ $laporans->total() }}</h2>
        <small>Seluruh laporan yang masuk</small>
    </div>

    <div class="stat-card">
        <span>Halaman Aktif</span>
        <h2>{{ $laporans->currentPage() }}</h2>
        <small>Daftar laporan</small>
    </div>
</div>

<div class="table-card">
    <div class="table-heading">
        <div>
            <h2>Daftar Laporan Masyarakat</h2>
            <p>Informasi kejadian banjir yang telah dikirim.</p>
        </div>
    </div>

    @if($laporans->count())
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelapor</th>
                        <th>Lokasi</th>
                        <th>Tinggi Air</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($laporans as $laporan)
                        <tr>
                            <td>{{ $loop->iteration + $laporans->firstItem() - 1 }}</td>
                            <td>
                                <strong>{{ $laporan->nama_pelapor }}</strong>
                                <small class="table-sub">{{ $laporan->no_hp }}</small>
                            </td>
                            <td>
                                {{ $laporan->lokasi }}
                                <small class="table-sub">{{ $laporan->kecamatan }}</small>
                            </td>
                            <td>{{ $laporan->tinggi_air }} cm</td>
                            <td>
                                @if($laporan->foto)
                                    <img class="table-photo"
                                         src="{{ asset('storage/'.$laporan->foto) }}"
                                         alt="Foto laporan">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="status status-{{ strtolower($laporan->status) }}">
                                    {{ $laporan->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('laporan.show', $laporan) }}"
                                       class="btn-small btn-detail">Detail</a>

                                    <a href="{{ route('laporan.edit', $laporan) }}"
                                       class="btn-small btn-edit">Edit</a>

                                    <form action="{{ route('laporan.destroy', $laporan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-small btn-delete"
                                                type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $laporans->links() }}
        </div>
    @else
        <div class="empty-state">
            <div>📋</div>
            <h3>Belum Ada Laporan</h3>
            <p>Laporan masyarakat akan muncul di halaman ini.</p>
        </div>
    @endif
</div>

@endsection