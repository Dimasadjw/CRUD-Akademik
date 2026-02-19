<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD Akademik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
    .dataTables_filter {
        margin-bottom: 10px !important;
    }

    .dataTables_filter input {
        width: 350px !important;
        height: 45px !important;
        font-size: 1rem !important;
        border: 2px solid #dee2e6 !important;
        border-radius: 10px !important;
        padding: 10px 15px !important;
        background-color: #ffffff !important;
        transition: all 0.3s ease;
    }
</style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand">CRUD AKADEMIK</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                <a class="nav-link" href="{{ route('mataKuliah.index') }}">Mata Kuliah</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-lg-5 mb-5">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
