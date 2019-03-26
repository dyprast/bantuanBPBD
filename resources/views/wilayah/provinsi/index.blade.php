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
                                    <li class="breadcrumb-item active" aria-current="page">Index</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">		
						<div class="card">
                            <div class="card-body">
                                <div style="display: flex;justify-content: space-between;">
                                	<h5 class="card-title">Data BPBD Provinsi</h5>
                                	<a href="{{ url('provinsi/tambahProvinsi') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Tambah Provinsi"><i class="fas fa-plus"></i></a>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Provinsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($provinsis as $res)
                                        	<tr>
                                        		<td>{{ $loop->iteration }}</td>
                                        		<td>{{ $res->provinsi }}</td>
                                        		<td class="action-table">
                                        			<a href="{{ url('provinsi/editProvinsi/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                        			<a href="#" data-uri="{{ url('provinsi/hapusProvinsi/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                        		</td>
                                        	</tr>
                                        	@endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session('alertHapus'))
        <script>
            toastr.success("BPBD Provinsi {{ session('alertHapus') }}", "Berhasil Menghapus Data");
        </script>
        @elseif(session('alertEdit'))
        <script>
            toastr.success("BPBD Provinsi {{ session('alertEdit') }}", "Berhasil Memperbarui Data");
        </script>
        @elseif(session('alertTambah'))
        <script>
            toastr.success("BPBD Provinsi {{ session('alertTambah') }}", "Berhasil Menambah Data");
        </script>
        @endif
@endsection