@extends('layout.admin.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Dashboard Website Toko SRC UCUP</h6>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <a class="card-category" href="{{ route('pelanggan.list') }}">{{ $jumlahPelanggan }}
                                            Pelanggan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <a class="card-category" href="{{ route('mitra.list') }}">{{ $jumlahMitra }}
                                            Mitra</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <a class="card-category" href="{{ route('produk.list') }}">{{ $jumlahProduk }}
                                            Produk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Produk Expired</h3>
                </div>

            </div>
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">Nama Produk</th>
                                    <th class="border-0">Gambar Produk</th>
                                    <th class="border-0">Tanggal Expired</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($dataProduk as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td><img src="{{ asset('storage/' . $row->gambar) }}" alt="Gambar Produk"
                                                style="width: 100px; height: 100px; object-fit: cover;"></td>
                                        <td>{{ \Carbon\Carbon::parse($row->tgl_expired)->format('d F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Pelanggan Terbaru</h3>
                </div>

            </div>
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">Nama Awal</th>
                                    <th class="border-0">Nama Akhir</th>
                                    <th class="border-0">Tanggal Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($pelangganTerbaru as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->first_name }}</td>
                                        <td>{{ $row->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Produk Terbaru</h3>
                </div>

            </div>
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">Nama Produk</th>
                                    <th class="border-0">Gambar Produk</th>
                                    <th class="border-0">Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($produkTerbaru as $row)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td><img src="{{ asset('storage/' . $row->gambar) }}" alt="Gambar Produk"
                                                style="width: 100px; height: 100px; object-fit: cover;"></td>
                                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Lokasi Toko</h3>
                </div>
            </div>
            <div class="card border-0 shadow mb-4">
                <div class="card-body" >
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d327.4799378673829!2d101.42756192185017!3d0.5660655044504533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab6405aa3c6f%3A0x4db17a9ae58fa0d6!2sJl.%20Tegalsari%20No.12%2C%20Umban%20Sari%2C%20Kec.%20Rumbai%2C%20Kota%20Pekanbaru%2C%20Riau%2028266!5e0!3m2!1sen!2sid!4v1733613631922!5m2!1sen!2sid"
                        width="100%" height="275" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>

            </div>

        </div>
    </div>
@endsection
