<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SRC UCUP</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('aset-admin/img/gambarlogo1.jpg') }}" type="image/x-icon" />
    @include('layout.admin.css')

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layout.admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">

                <!-- Navbar Header -->
                @include('layout.admin.navbar')
                <!-- End Navbar -->
            </div>
            @yield('content')
        </div>
    </div>

    @include('layout.admin.js')


</body>

</html>
