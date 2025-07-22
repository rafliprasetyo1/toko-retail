<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - SRC Indonesia</title>
    <!-- Link ke CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link type="text/css" href="{{asset('aset-admin/css/volt.css')}}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/src.jpg') }}" alt="SRC Logo" height="50px">

        </div>
        <nav>
        <a href="{{route('mitra.list')}}" class="logout-btn">Data Mitra</a>
        <a href="{{route('pelanggan.list')}}" class="logout-btn">Data Pelanggan</a>
        <a href="{{ route('login') }}" class="logout-btn">Logout</a>
        </nav>
    </header>
    <main>

    </main>

    <footer>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
