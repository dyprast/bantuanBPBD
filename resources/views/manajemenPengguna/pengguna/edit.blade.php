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
                                    <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
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
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('manajemenPengguna/prosesEditPengguna/'.$users->id) }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Edit Pengguna</h4>
                                    <hr>
                                    <div id="change_profile" class="form-group row">
                                        <label for="profile" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="profile" name="profile" placeholder="Profil">
                                        </div>
                                    </div>
                                    <div id="default_profile" class="form-group row">
                                        <label for="profile" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <img src="{{ asset('img/default-profile.png') }}" alt="Default Profile" width="100" height="100" style="object-fit: cover;">
                                            <input type="hidden" class="form-control" id="profile_default" name="profile_default" placeholder="Profil" value="">
                                        </div>
                                    </div>
                                    <div id="show_profile" class="form-group row">
                                        <label for="profile" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            @if(empty($users->profile))
                                                <img src="{{ asset('img/default-profile.png') }}" alt="Profile" width="100" height="100" style="object-fit: cover;">
                                            @else
                                                <img src="{{ asset('UploadedFile/Profile/'.$users->email.'/'.$users->profile) }}" alt="Profile" width="100" height="100" style="object-fit: cover;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Profil</label>
                                        <div class="col-sm-9">
                                            <button id="btn_show_profile" type="button" class="btn btn-primary btn-sm">Lihat Profil</button>
                                            <button id="btn_show_profile_close" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-close"></i></button>
                                            <button id="btn_change_profile" type="button" class="btn btn-success btn-sm">Ubah Profil</button>
                                            <button id="btn_change_profile_close" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-close"></i></button>
                                            <button id="btn_default_profile" type="button" class="btn btn-secondary btn-sm">Default Profil</button>
                                            <button id="btn_default_profile_close" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required value="{{ $users->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="{{ $users->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button id="btn_pw_change" type="button" class="btn btn-success btn-sm">Ganti Password</button>
                                            <button id="btn_pw_change_close" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-close"></i></button>
                                        </div>
                                    </div>
                                    <div id="pw_change">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="conf_password" class="col-sm-3 text-right control-label col-form-label">Konfirmasi Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Konfirmasi Password">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Perbarui</button>
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
            $('#pw_change').hide();
            $('#btn_pw_change_close').hide();
            $('#btn_pw_change').click(function(e){
                e.preventDefault();
                $('#pw_change').slideDown("slow");
                $(this).hide();
                $('#btn_pw_change_close').slideDown("slow");
            });
            $('#btn_pw_change_close').click(function(e){
                e.preventDefault();
                $('#pw_change').slideUp("slow");
                $('#password').val('');
                $('#conf_password').val('');
                $(this).hide();
                $('#btn_pw_change').slideDown("slow");
            });
            $('#change_profile').hide();
            $('#btn_change_profile_close').hide();
            $('#btn_change_profile').click(function(e){
                e.preventDefault();
                $('#change_profile').slideDown("slow");
                $('#btn_show_profile').attr('disabled', 'disabled');
                $('#btn_default_profile').attr('disabled', 'disabled');
                $(this).hide();
                $('#btn_change_profile_close').slideDown("slow");
            });
            $('#btn_change_profile_close').click(function(e){
                e.preventDefault();
                $('#change_profile').slideUp("slow");
                $('#btn_show_profile').attr('disabled', false);
                $('#btn_default_profile').attr('disabled', false);
                $("#profile").val('');
                $(this).hide();
                $('#btn_change_profile').slideDown("slow");
            });
            $('#default_profile').hide();
            $('#btn_default_profile_close').hide();
            $('#btn_default_profile').click(function(e){
                e.preventDefault();
                $('#default_profile').slideDown("slow");
                $('#btn_change_profile').attr('disabled', 'disabled');
                $('#btn_show_profile').attr('disabled', 'disabled');
                $('#profile_default').val('default');
                $(this).hide();
                $('#btn_default_profile_close').slideDown("slow");
            });
            $('#btn_default_profile_close').click(function(e){
                e.preventDefault();
                $('#default_profile').slideUp("slow");
                $('#btn_change_profile').attr('disabled', false);
                $('#btn_show_profile').attr('disabled', false);
                $('#profile_default').val('');
                $(this).hide();
                $('#btn_default_profile').slideDown("slow");
            });
            $('#show_profile').hide();
            $('#btn_show_profile_close').hide();
            $('#btn_show_profile').click(function(e){
                e.preventDefault();
                $('#show_profile').slideDown("slow");
                $('#btn_change_profile').attr('disabled', 'disabled');
                $('#btn_default_profile').attr('disabled', 'disabled');
                $(this).hide();
                $('#btn_show_profile_close').slideDown("slow");
            });
            $('#btn_show_profile_close').click(function(e){
                e.preventDefault();
                $('#show_profile').slideUp("slow");
                $('#btn_change_profile').attr('disabled', false);
                $('#btn_default_profile').attr('disabled', false);
                $(this).hide();
                $('#btn_show_profile').slideDown("slow");
            });
        </script>
@endsection