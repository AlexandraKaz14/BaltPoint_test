<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <title>@yield('title') Управление товарами</title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        .container {
            max-width: 1200px;
        }

        .table th {
            font-weight: 600;
            color: #495057;
            border-top: none;
        }

    </style>

</head>
<body>
<div class="container flex-grow-1 d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">
                Управление товарами
            </a>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="alert-heading mb-2">
                <i class="bi bi-exclamation-octagon me-2"></i>Обнаружены ошибки:
            </h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="mt-5 pt-4 border-top text-center text-muted">
        <p class="mb-4">Управление товарами &copy; {{ date('Y') }}. Тестовое задание на Laravel.</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            if (alert.classList.contains('show')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 3000);

    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[data-confirm]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm(this.getAttribute('data-confirm') || 'Вы уверены?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

@stack('scripts')
</body>
</html>
