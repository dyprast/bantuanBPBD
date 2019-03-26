@extends('layouts.app')

@section('content')
		<div class="page-wrapper">
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Manajemen Pengguna</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen Pengguna</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-xl-6 col-lg-8 col-md-12 col-sm-12">		
						<div class="card">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('simpanPengguna') }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Tambah Pengguna</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="profile" class="col-sm-3 text-right control-label col-form-label">Profil</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="profile" name="profile" placeholder="Profil">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="conf_password" class="col-sm-3 text-right control-label col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Konfirmasi Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="conf_password" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing3" required>
                                                <label class="custom-control-label" for="customControlAutosizing3">Saya setuju untuk menjadi <a href="{{ url('manajemenPengguna') }}">pengguna aplikasi</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->has('id'))
            <script>
                toastr.warning('Kode Provinsi Telah Terdaftar!', 'Dicekal!');
            </script>
        @elseif(session('alertBack'))
            <script>
                toastr.warning('{{ session('alertBack') }}', 'Dicekal!');
            </script>
        @elseif($errors->has('email'))
            <script>
                toastr.warning('E-mail telah digunakan!', 'Dicekal!');
            </script>
        @endif
        <script>
            $("#profile").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                    toastr.warning('File harus memuat gambar (JPEG/JPG/PNG)', 'Dicekal!');
                    $("#profile").val('');
                    return false;
                }
            });
        </script>
@endsection