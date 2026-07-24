<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gym Admin') }} - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900 mb-2">
                                    <i class="fas fa-dumbbell"></i>
                                    {{ config('app.name', 'Gym Admin') }}
                                </h1>
                                <p class="text-muted">Silakan login untuk melanjutkan</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $errors->first('email') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="alert alert-info py-2 small" role="alert">
                                <i class="fas fa-info-circle me-1"></i>
                                <strong>Test Akun:</strong> test@example.com / <strong>password</strong>
                            </div>

                            <form method="POST" action="/login" class="user">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label text-gray-900">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email"
                                        value="{{ old('email', 'test@example.com') }}"
                                        required
                                        autofocus
                                        autocomplete="email"
                                    >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label text-gray-900">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password"
                                        value="password"
                                        required
                                        autocomplete="current-password"
                                    >
                                </div>

                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="remember"
                                            id="remember"
                                            class="form-check-input"
                                            {{ old('remember') ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label text-gray-900" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block w-100">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="/">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

