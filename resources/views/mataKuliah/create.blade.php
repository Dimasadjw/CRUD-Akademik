@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mataKuliah.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror" value="{{ old('kode_mk') }}" placeholder="Contoh: MK001" required>
                        @error('kode_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" class="form-control @error('nama_mk') is-invalid @enderror" value="{{ old('nama_mk') }}" placeholder="Masukkan nama mata kuliah" required>
                        @error('nama_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}" min="1" max="6" placeholder="2- 6" required>
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" placeholder="1 - 8" value="{{ old('semester') }}" min="1" max="12" required>
                        <small class="text-muted">Masukkan jatah semester mata kuliah ini (Maksimal 8)</small>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 border-top pt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('mataKuliah.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
