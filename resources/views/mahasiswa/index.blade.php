@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> Data
                    Mahasiswa</h4>
                <hr class="text-muted opacity-25">
            </div>
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('mahasiswa.create') }}"
                    class="btn btn-success px-3 py-2 d-flex align-items-center shadow-sm"
                    style="border-radius: 6px; font-weight: 500;">
                    <i class="fa fa-plus me-2"></i> Tambah Mahasiswa
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-hover" id="tableMahasiswa">
                <thead class="table-primary">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Mata Kuliah</th>
                        <th>Bukti Pembayaran</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td>{{ $mhs->kelas }}</td>
                            <td>{{ $mhs->semester }}</td>

                            <td>
                                @if ($mhs->matakuliah->count() > 0)
                                    @foreach ($mhs->matakuliah as $mk)
                                        <span class="badge bg-info text-dark">
                                            {{ $mk->nama_mk }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted small italic">Belum pilih MK</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($mhs->bukti_pembayaran)
                                    @php
                                        $extension = pathinfo($mhs->bukti_pembayaran, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('uploads/pembayaran/' . $mhs->bukti_pembayaran) }}"
                                            target="_blank">
                                            <img src="{{ asset('uploads/pembayaran/' . $mhs->bukti_pembayaran) }}"
                                                alt="Foto Bukti"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                        </a>
                                    @else
                                        <a href="{{ asset('uploads/pembayaran/' . $mhs->bukti_pembayaran) }}"
                                            target="_blank" class="text-decoration-none">
                                            <div class="text-danger small">
                                                <i class="fas fa-file-pdf fa-2x"></i><br>
                                                <span class="text-dark">Lihat PDF</span>
                                            </div>
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted small italic">Belum ada bukti pembayaran</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus data?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMahasiswa').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "Pencarian:",
                    "searchPlaceholder": "Cari Mahasiswa",
                    "lengthMenu": "Show _MENU_ Entries",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ mahasiswa",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(disaring dari total _MAX_ data)",
                    "paginate": {
                        "previous": "previous",
                        "next": "next"
                    }
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": [4, 5, 6]
                }]
            });
        });
    </script>
@endpush
