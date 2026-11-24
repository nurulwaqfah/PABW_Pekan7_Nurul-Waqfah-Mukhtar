@extends('layouts.app')

@section('title', 'Login Petugas')

@section('content')

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-icon">🔐</div>

        <span class="section-label">AREA PETUGAS BPBD</span>
        <h1>Selamat Datang!</h1>
        <p>Silakan login untuk mengelola laporan banjir.</p>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email petugas" required>
                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Masukkan password" required>
                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-primary btn-full">
                Login Sekarang
            </button>
        </form>

        <a href="{{ route('laporan.create') }}" class="back-link">
            ← Kembali ke halaman masyarakat
        </a>

    </div>
</div>

@endsection