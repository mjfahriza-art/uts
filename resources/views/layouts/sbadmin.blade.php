<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gym Admin') }} - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* ===== PAGE TRANSITIONS ===== */
        @keyframes fadeSlideIn {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        #content-wrapper {
            animation: fadeSlideIn 0.35s ease-out;
        }
        /* Card muncul bergantian */
        .card {
            animation: fadeSlideIn 0.4s ease-out;
        }
        .card:nth-child(2) { animation-delay: 0.05s; }
        .card:nth-child(3) { animation-delay: 0.1s; }
        .card:nth-child(4) { animation-delay: 0.15s; }

        /* Make text more prominent and remove faded/muted opacity */
        body { color: #111 !important; font-weight: 600 !important; }
        .text-muted { color: #6c757d !important; opacity: 1 !important; font-weight: 600 !important; }
        .table th, .table td { font-weight: 600 !important; color: #111 !important; }
        .btn i { margin-right: .45rem; }

        /* ===== SIDEBAR MODERN ala Simahaswa ===== */
        .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15) !important;
        }
        .sidebar-brand {
            background: rgba(255,255,255,0.06) !important;
            border-bottom: 1px solid rgba(255,255,255,0.08) !important;
            padding: 1.2rem 1rem !important;
            transition: all 0.3s ease;
            min-height: 70px;
        }
        .sidebar-brand:hover {
            background: rgba(255,255,255,0.1) !important;
        }
        .sidebar-brand-icon {
            font-size: 1.8rem !important;
            color: #e94560 !important;
            filter: drop-shadow(0 2px 4px rgba(233,69,96,0.3));
        }
        .sidebar-brand-text {
            font-size: 1.1rem !important;
            font-weight: 800 !important;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #fff, #a8d8ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Sidebar heading (pemisah section) */
        .sidebar .sidebar-heading {
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            color: rgba(255,255,255,0.4) !important;
            padding: 0.9rem 1.25rem 0.4rem !important;
        }
        .sidebar .nav-item {
            margin: 2px 10px !important;
        }
        .sidebar .nav-item .nav-link {
            border-radius: 8px !important;
            padding: 10px 14px !important;
            font-weight: 500 !important;
            font-size: 0.88rem !important;
            color: rgba(255,255,255,0.65) !important;
            transition: all 0.25s ease !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px;
        }
        .sidebar .nav-item .nav-link i {
            font-size: 1rem !important;
            width: 22px;
            text-align: center;
            color: rgba(255,255,255,0.4) !important;
            transition: all 0.25s ease !important;
        }
        .sidebar .nav-item .nav-link:hover {
            background: rgba(255,255,255,0.08) !important;
            color: #fff !important;
        }
        .sidebar .nav-item .nav-link:hover i {
            color: #e94560 !important;
        }
        .sidebar .nav-item.active > .nav-link {
            background: linear-gradient(135deg, rgba(233,69,96,0.2), rgba(233,69,96,0.08)) !important;
            color: #fff !important;
            border: 1px solid rgba(233,69,96,0.15);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
        }
        .sidebar .nav-item.active > .nav-link i {
            color: #e94560 !important;
            transition: color 0.5s ease !important;
        }
        .sidebar .sidebar-divider {
            border-color: rgba(255,255,255,0.07) !important;
            margin: 6px 12px !important;
        }
        /* Sidebar toggle button di bawah */
        .sidebar #sidebarToggle {
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.12);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: rgba(255,255,255,0.6);
        }
        .sidebar #sidebarToggle:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Topbar improvements */
        .topbar {
            background: #fff !important;
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04) !important;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-start">
                    <div class="fw-bold">GYM</div>
                    <div class="small text-gray-200">Admin</div>
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            {{-- Menu: Dashboard --}}
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Manajemen Data</div>

            {{-- Menu: Trainers --}}
            <li class="nav-item {{ request()->routeIs('trainers.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('trainers.index') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Trainers</span>
                </a>
            </li>

            {{-- Menu: Members --}}
            <li class="nav-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('members.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Members</span>
                </a>
            </li>

            {{-- Menu: Memberships --}}
            <li class="nav-item {{ request()->routeIs('memberships.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('memberships.index') }}">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Memberships</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            {{-- Sidebar Toggler --}}
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </nav>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small fw-bold">
                                        <i class="fas fa-user-circle me-1"></i>Administrator
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-1 text-gray-400"></i>
                                        Logout
                                    </button>
                                </div>
                            </li>
                        @else
                            <li class="nav-item d-none d-sm-inline-block">
                                <a class="nav-link" href="/login">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                        @endauth
                    </ul>
                </nav>

                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">
                        <i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Logout
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah anda ingin keluar dari management aplikasi gym?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batalkan
                    </button>
                    <form method="POST" action="/logout" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Sidebar Toggle Manual
            $('#sidebarToggle').on('click', function(e) {
                e.preventDefault();
                $('body').toggleClass('sidebar-toggled');
                $('.sidebar').toggleClass('toggled');
            });
        });
    </script>
</body>
</html>
