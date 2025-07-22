<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SRC Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('aset-admin/css/login.css') }}"> <!-- Gunakan file CSS yang sama dengan login -->
    <style>
        /* Hanya tambahan khusus untuk register jika diperlukan */
        .register-card {
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <section class="login-section"> <!-- Gunakan class yang sama -->
            <div class="login-card register-card"> <!-- Tambahkan register-card -->
                <div style="text-align: center">
                    <img src="{{ asset('aset-admin/img/gambarlogo1.png') }}" alt="SRC Logo" width="200px" height="200px">
                    <h2>Register</h2><br>
                </div>

                <form action="{{ route('register.form') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="nama"
                               placeholder="Nama Lengkap"
                               value="{{ old('nama') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="username"
                               placeholder="Username"
                               value="{{ old('username') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="alamat"
                               placeholder="Alamat"
                               value="{{ old('alamat') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="date"
                               class="form-control"
                               name="tgl_lahir"
                               value="{{ old('tgl_lahir') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Email"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="role">
                            <option value="admin">Admin</option>
                            <option value="pelanggan">Pelanggan</option>
                            <option value="mitra">Mitra</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Password"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="password"
                               class="form-control"
                               name="password_confirmation"
                               placeholder="Konfirmasi Password"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="file"
                               class="form-control"
                               name="foto_profil"
                               accept="image/*">
                        <small class="text-muted">Upload foto dengan format JPG, PNG, atau GIF (max 2MB)</small>
                    </div>

                    <button type="submit" class="btn btn-danger btn-login">Register</button>

                    <div style="text-align: center; margin-top: 1rem;">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
