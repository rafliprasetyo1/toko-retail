@extends('layout.admin.app')
@section('content')

	<main class="container ms-4">



        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.list')}}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
                <h2 class="h4">Edit User</h2>
                <p class="mb-0"> Form perubahan data User  </p>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{route('user.list')}}" class="btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Kembali
                </a>

            </div>
        </div>

        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">General information</h2>
            <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="name">name </label>
                            <input value="{{ $dataUser->name }}" class="form-control" id="name" name="name" type="text" required value={{old('name')}} >
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="alamat">Alamat</label>
                            <input  value="{{ $dataUser->alamat }}" class="form-control" id="alamat"  name="alamat" type="text"  value={{old('alamat')}}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input  value="{{ $dataUser->email }}" class="form-control" id="email" name="email" type="email" required value={{old('email')}}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role">Role</label>
                        <select class="form-select mb-0" id="role" name="role" aria-label="jenisMitra select example">
                            <option value="admin" {{$dataUser->role == 'admin' ? 'selected' : ''}}>Admin</option>
                            <option value="pelanggan" {{$dataUser->role == 'pelanggan' ? 'selected' : ''}}>Pelanggan</option>
                            <option value="mitra" {{$dataUser->role == 'mitra' ? 'selected' : ''}}>Mitra</option>
                        </select>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <label for="tgl_lahir">Tanggal lahir</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                            <input  value="{{ $dataUser->tgl_lahir }}" data-datepicker="" class="form-control" id="tgl_lahir" name="tgl_lahir" type="date" placeholder="dd/mm/yyyy" required value={{old('tgl_lahir')}}>
                         </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="foto_profile">foto_profile</label>
                            <input class="form-control" id="foto_profile"  name="foto_profile" type="file">
                            @if($dataUser->foto_profile)
                            <img src="{{ asset('foto_profile/' . $dataUser->foto_profile) }}"
                                 alt="foto profil"
                                 style="width: 100px; height: 100px;"
                                 class="img-thumbnail">
                        @else
                            <img src="{{ asset('foto_profile/gambarprofil.jpg') }}"
                                 alt="default profile"
                                 style="width: 100px; height: 100px;"
                                 class="img-thumbnail">
                        @endif
                        </div>
                    </div>
                </div>


                <div class="mt-3">
                    <button class="btn btn-info" type="submit">Simpan Perubahan</button>
                </div>
                <input type="hidden" name="id" value="{{ $dataUser->id}}"/>
            </form>
        </div>

	</main>
@endsection
