@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">Edit Mata Kuliah</div>
    <div class="card-body">
        <form action="{{ route('mataKuliah.update', $matakuliah->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode MK</label>
                <input type="text" name="kode" value="{{ old('kode', $matakuliah->kode_mk) }}" class="form-control @error('kode') is-invalid @enderror">
                @error('kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama" value="{{ old('nama', $matakuliah->nama_mk) }}" class="form-control @error('nama') is-invalid @enderror">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" value="{{ old('sks', $matakuliah->sks) }}" class="form-control @error('sks') is-invalid @enderror" min="1">
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number"
                       name="semester"
                       value="{{ old('semester', $matakuliah->semester) }}"
                       class="form-control @error('semester') is-invalid @enderror"
                       placeholder="Contoh: 1 - 12"
                       min="1"
                       max="12"
                       required>
                <small class="text-muted">Masukkan angka semester mata kuliah ini (Maksimal 12).</small>
                @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="{{ route('mataKuliah.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
