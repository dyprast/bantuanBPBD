@extends('layouts.app')

@section('content')
		<div class="page-wrapper">
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Jenis Bantuan</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Jenis Bantuan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                            <form class="form-horizontal" method="POST" action="{{ route('simpanJenisBantuan') }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Tambah Jenis Bantuan</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="jenis_bantuan" class="col-sm-3 text-right control-label col-form-label">Jenis Bantuan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="jenis_bantuan" name="jenis_bantuan" placeholder="Jenis Bantuan">
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
@endsection