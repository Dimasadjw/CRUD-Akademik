<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-3">Tambah Mahasiswa</h4>

                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                                value="{{ old('nim') }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                                value="{{ old('kelas') }}" required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="number" name="semester" id="semester_input"
                                class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}"
                                min="1" max="12" required>
                            <small class="text-muted">Masukkan semester aktif (1-12)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mata Kuliah (KRS)</label>
                            <div class="row">
                                @foreach ($matakuliah as $mk)
                                    <div class="col-md-4 mk-item" data-semester="{{ $mk->semester }}">
                                        <div class="form-check p-2 border rounded mb-2">
                                            <input class="form-check-input ms-1" type="checkbox" name="matakuliah_id[]"
                                                value="{{ $mk->id }}" id="mk{{ $mk->id }}"
                                                {{ in_array($mk->id, old('matakuliah_id', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-4" for="mk{{ $mk->id }}">
                                                {{ $mk->nama_mk }} (Smt {{ $mk->semester }})
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="pesan_kosong" class="alert alert-warning d-none">
                                <i class="fas fa-exclamation-triangle me-2"></i>Maaf mata kuliah semester ini belum tersedia
                            </div>
                        </div>
                        @error('matakuliah_id')
                            <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label fw-bold">Bukti Pembayaran UKT</label>
                            <input type="file" name="bukti_pembayaran" class="dropify" data-height="200"
                                data-allowed-file-extensions="jpg png jpeg pdf"
                                @if (old('bukti_pembayaran')) data-default-file="{{ old('bukti_pembayaran') }}" @endif>
                            @error('bukti_pembayaran')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                </div>

                <div class="mt-3 mb-4 ms-3">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                $('.dropify').dropify({
                    messages: {
                        'default': 'Drag and drop a file here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happened.'
                    }
                });

                const inputSemester = document.getElementById('semester_input');
                const mkItems = document.querySelectorAll('.mk-item');
                const pesanKosong = document.getElementById('pesan_kosong');
                const errorValidation = document.getElementById('error_validation');

                function filterMatakuliah() {
                    let selectedSmt = inputSemester.value;
                    let countVisible = 0;

                    if (errorValidation) errorValidation.classList.add('d-none');

                    mkItems.forEach(function(item) {
                        let itemSmt = item.getAttribute('data-semester');

                        if (selectedSmt === "" || itemSmt === selectedSmt) {
                            item.style.display = 'block';
                            countVisible++;
                        } else {
                            item.style.display = 'none';
                            let checkbox = item.querySelector('input[type="checkbox"]');
                            if (checkbox) checkbox.checked = false;
                        }
                    });

                    if (countVisible === 0 && selectedSmt !== "") {
                        pesanKosong.classList.remove('d-none');
                    } else {
                        pesanKosong.classList.add('d-none');
                    }
                }

                inputSemester.addEventListener('input', filterMatakuliah);
                filterMatakuliah();
            });
        </script>
    @endsection
</body>

</html>
