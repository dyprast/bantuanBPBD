@extends('layouts.app')

@section('content')
		<div class="page-wrapper">
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Pembentukan BPBD</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Pembentukan BPBD</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Pembentukan BPBD</li>
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
                            <form class="form-horizontal" method="POST" action="{{ url('pembentukan/prosesEditPembentukan/'.$pembentukans->id) }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Edit Pembentukan BPBD</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="pembentukan" class="col-sm-3 text-right control-label col-form-label">Pembentukan BPBD</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pembentukan" name="pembentukan" placeholder="Pembentukan BPBD" value="{{ $pembentukans->pembentukan }}">
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
@endsection