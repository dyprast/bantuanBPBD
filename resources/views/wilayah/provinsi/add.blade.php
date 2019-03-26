@extends('layouts.app')

@section('content')
		<div class="page-wrapper">
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">BPBD Provinsi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">BPBD</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Provinsi</li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Provinsi</li>
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
                            <form class="form-horizontal" method="POST" action="{{ route('simpanProvinsi') }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Tambah BPBD Provinsi</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Nama Provinsi" required>
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
        @endif
@endsection