<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SRC Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('aset-admin/css/login.css') }}">
</head>
<body>
    <main>
        <section class="login-section">
            <div class="login-card">
                <div style="text-align: center">
                    <img src="{{ asset('aset-admin/img/gambarlogo1.png') }}" alt="SRC Logo" width="200px" height="200px" >
                    <h2>Login</h2><br>
                </div>

                <form action="{{ route('login.form')}}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <input type="text"
                           class="form-control"
                           name="email"
                           placeholder="email anda"
                           value="{{ old('email') }}"
                           required>

                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Password"
                           required>

                    <button type="submit" class="btn btn-danger btn-login">Login</button>
                    <a href="{{ route('redirect.google') }}" class="btn btn-secondary btn-login">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-1" viewBox="0 0 16 16">
                            <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                          </svg>
                        Login with Google
                    </a>
                </form>
                <div style="text-align: center; margin-top: 1rem;">
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>
            </div>
        </section>
    </main>
</body>
</html>
