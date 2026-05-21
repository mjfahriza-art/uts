<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gym Admin') }} - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Make text more prominent and remove faded/muted opacity */
        body { color: #111 !important; font-weight: 600 !important; }
        .text-muted { color: #6c757d !important; opacity: 1 !important; font-weight: 600 !important; }
        .table th, .table td { font-weight: 600 !important; color: #111 !important; }
        .sidebar-brand-text .small { font-weight: 500 !important; color: rgba(255,255,255,0.85) !important; }
        .btn i { margin-right: .45rem; }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-start">
                    <div class="fw-bold">Gym</div>
                    <div class="small text-gray-200">Admin</div>
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('members.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Members</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
        </nav>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
