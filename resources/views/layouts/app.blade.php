<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Contador de Impressão')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .navbar-brand i { font-size: 1.4rem; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .table thead th { background-color: #343a40; color: #fff; border: none; }
        .table tbody tr:hover { background-color: #f8f9fa; }
        .stat-card { border-radius: 12px; color: #fff; padding: 1.2rem 1.5rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <i class="bi bi-printer-fill"></i>
                <span>Contador de Impressão</span>
            </a>
            <div class="d-flex gap-3">
                <a href="{{ url('/') }}" class="text-white text-decoration-none d-flex align-items-center gap-1">
                    <i class="bi bi-house-fill"></i> Início
                </a>
                <a href="{{ url('/status') }}" class="text-white text-decoration-none d-flex align-items-center gap-1">
                    <i class="bi bi-activity"></i> Status
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
