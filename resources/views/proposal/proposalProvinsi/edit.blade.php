@extends('layouts.app')

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Proposal Permintaan BPBD Provinsi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Proposal</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Provinsi</li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Proposal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-xl-6 col-lg-10 col-md-12 col-sm-12">     
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="{{ url('proposalPermintaan/provinsi/prosesEditProposalProvinsi/'.$proposalsProv->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Edit Proposal</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="id_provinsiBantuan" class="col-sm-3 text-right control-label col-form-label">BPBD Provinsi</label>
                                        <div class="col-sm-9">
                                            <select id="id_provinsiBantuan" class="select2 form-control" name="id_provinsi" required disabled>
                                                <option value="">Nama Provinsi</option>
                                                <optgroup label="BPBD Provinsi">
                                                    @foreach($provinsis as $res)
                                                    @if($proposalsProv->provinsi->provinsi == $res->provinsi)
                                                    <option value="{{ $res->id }}" data="{{ $res->provinsi }}" selected>{{ $res->provinsi }}</option>
                                                    @else
                                                    <option value="{{ $res->id }}" data="{{ $res->provinsi }}">{{ $res->provinsi }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis_bantuan" class="col-sm-3 text-right control-label col-form-label">Jenis Bantuan</label>
                                        <div class="col-sm-9">
                                            <select id="jenis_bantuan" class="select2 form-control" name="jenis_bantuan" required disabled>
                                                <option value="">Jenis Bantuan</option>
                                                <optgroup label="Jenis Bantuan BPBD">
                                                    @foreach($jenisBantuans as $res)
                                                    @if($proposalsProv->jenis_bantuan == $res->jenis_bantuan)
                                                    <option value="{{ $res->jenis_bantuan }}" selected>{{ $res->jenis_bantuan }}</option>
                                                    @else
                                                    <option value="{{ $res->jenis_bantuan }}">{{ $res->jenis_bantuan }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomor" class="col-sm-3 text-right control-label col-form-label">Isi Ringkasan</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="isi_ringkasan" class="form-control" id="validatedCustomFile">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomor" class="col-sm-3 text-right control-label col-form-label">Nomor</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor" value="{{ $proposalsProv->nomor }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Tanggal</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tanggal" placeholder="dd mm yyyy" name="tanggal" value="{{ $proposalsProv->tanggal }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
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
@endsection