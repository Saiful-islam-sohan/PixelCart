<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body, html {
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar-btn {
            text-align: left;
            margin-bottom: 10px;
        }
        .sidebar-btn i {
            margin-right: 8px;
        }
    </style>

    @yield('admin.style')
</head>
<body>

    <!-- Navbar -->
      @include('admin.layouts.partials.navbar')

    <!-- Sidebar + Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
              @include('admin.layouts.partials.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                @yield('admin.content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        toggleBtn.addEventListener('click', () => {
            let currentTheme = html.getAttribute('data-bs-theme');
            let newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-bs-theme', newTheme);
            themeIcon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
        });
    </script>

    @yield('admin.script')
</body>
</html>
