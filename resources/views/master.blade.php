<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Employee System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('departments.index') }}" class="nav-link">Departments</a></li>
                    <li class="nav-item"><a href="{{ route('positions.index') }}" class="nav-link">Positions</a></li>
                    <li class="nav-item"><a href="{{ route('employees.index') }}" class="nav-link">Employees</a></li>
                    <li class="nav-item"><a href="{{ route('attendance.index') }}" class="nav-link">Attendance</a></li>
                    <li class="nav-item"><a href="{{ route('salary.index') }}" class="nav-link">Salary</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
