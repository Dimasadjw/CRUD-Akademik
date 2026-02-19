@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Mata Kuliah</h4>
                <a href="{{ route('mataKuliah.create') }}" class="btn btn-primary btn-sm p-1">
                    <i class="fas fa-plus m-2"></i>Tambah Mata Kuliah
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                        <thead class="table-light">
                            <tr>
                                <th width="15%">Kode</th>
                                <th width="40%">Nama Mata Kuliah</th>
                                <th width="15%">SKS</th>
                                <th width="10%" class="text-center">Semester</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($matakuliah as $mk)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $mk->kode_mk }}</td>
                                    <td>{{ $mk->nama_mk }}</td>
                                    <td><span class="badge text-dark">{{ $mk->sks }} SKS</span></td>
                                    <td class="text-center">{{ $mk->semester }}</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('mataKuliah.edit', $mk->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('mataKuliah.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Data masih kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
