<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Faculty Dashboard - College Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #34495e;
            min-height: 100vh;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #2c3e50;
            color: #f39c12;
            padding-left: 30px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="px-4 py-3 border-bottom border-secondary">
            <h5 class="text-white mb-0">
                <i class="fas fa-chalkboard-user"></i> Faculty Portal
            </h5>
        </div>
        <nav class="nav flex-column mt-3">
            <a href="{{ route('faculty.dashboard') }}" class="nav-link {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('faculty.courses.index') }}" class="nav-link {{ request()->routeIs('faculty.courses.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> My Courses
            </a>
            <?php $pendingCount = \App\Models\Notice::where('approved', false)->count(); ?>
            <a href="{{ route('faculty.notices.index') }}" class="nav-link {{ request()->routeIs('faculty.notices.*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> Notices
                @if($pendingCount)
                    <span class="badge bg-danger ms-1">{{ $pendingCount }}</span>
                @endif
            </a>
        </nav>
        <hr class="border-secondary">
        <div class="px-4">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <span class="navbar-text ms-auto">
                    Welcome, <strong>{{ auth()->user()->name }}</strong>
                </span>
            </div>
        </nav>

        @if(session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
