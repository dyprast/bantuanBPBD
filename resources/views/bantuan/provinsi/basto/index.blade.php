@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')

@if(empty($bastoProvinsis))

                                <div class="modal fade" id="ModalBantuanProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @if(!empty($bantuanProvinsis->proposalProvinsi->isi_ringkasan))
                                                <embed id="iframe" src="{{ asset('UploadedFile/Proposal') }}/{{ $bantuanProvinsis->id_provinsi }}/{{ $bantuanProvinsis->jenis_bantuan }}/{{ $bantuanProvinsis->proposalProvinsi->isi_ringkasan }}   " style="width: 100%;height: 100%;"></embed>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Basto BPBD Provinsi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Provinsi</li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Basto</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-xl-10 col-lg-10 col-md-12 col-sm-12">     
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="{{ route('simpanBantuanProvinsiBasto') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Form Basto BPBD <b>Provinsi {{ $bantuanProvinsis->proposalProvinsi->provinsi->provinsi }}</b></h4>
                                    <hr>
                                    <input type="hidden" name="provinsi" value="{{ $bantuanProvinsis->id_provinsi }}">
                                    <input type="hidden" name="jenis_bantuan" value="{{ $bantuanProvinsis->jenis_bantuan }}">
                                    <input type="hidden" name="id_bantuanProvinsi" value="{{ $bantuanProvinsis->id }}">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Tahun Perolehan</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tahun" placeholder="Tahun Perolehan" name="tahun_perolehan" value="{{ $bantuanProvinsis->tahun_perolehan }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-3 text-right control-label col-form-label">BPBD Provinsi</label>
                                        <div class="col-sm-9">
                                            <input id="provinsi" type="text" name="provinsi" required class="form-control" value="{{ $bantuanProvinsis->proposalProvinsi->provinsi->provinsi }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="nomor_basto" class="col-sm-3 text-right control-label col-form-label">Nomor Basto</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="nomor_basto" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="nomor_basto_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="no_permohonan_hibah" class="col-sm-3 text-right control-label col-form-label">No Permohonan Hibah</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_permohonan_hibah" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_permohonan_hibah_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="no_bersedia_menerima_hibah" class="col-sm-3 text-right control-label col-form-label">No Bersedia Menerima Hibah</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_bersedia_menerima_hibah" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_bersedia_menerima_hibah_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="no_inventarisasi_barang" class="col-sm-3 text-right control-label col-form-label">No Inventarisasi Barang</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_inventarisasi_barang" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_inventarisasi_barang_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="bast_hibah" class="col-sm-3 text-right control-label col-form-label">BAST Hibah</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="bast_hibah" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nasah_hibah" class="col-sm-3 text-right control-label col-form-label">Nasah Hibah</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="nasah_hibah" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nilai_bantuan" class="col-sm-3 text-right control-label col-form-label">Nilai Bantuan</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><b>IDR</b></span>
                                            </div>
                                            <input type="text" name="nilai_bantuan" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="proposal" class="col-sm-3 text-right control-label col-form-label">Proposal</label>
                                        <div class="input-group col-sm-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="proposal" type="text" name="proposal" required class="form-control" value="{{ $bantuanProvinsis->proposalProvinsi->isi_ringkasan }}">
                                        </div>
                                        <div class="col-sm-1" style="display: flex;align-items: center;">
                                            @if(!empty($bantuanProvinsis->proposalProvinsi->isi_ringkasan))
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBantuanProv"><i class="mdi mdi-open-in-new"></i></a>
                                            @else
                                            <a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="nilai_bantuan" class="col-sm-3 text-right control-label col-form-label">Rincian (XLSX)</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-excel"></i></span>
                                            </div>
                                            <input type="file" accept=".xlsx, .xls" name="rincian" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Konfirmasi BASTO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#proposal').attr('disabled', 'disabled');
            $('#tahun').attr('disabled', 'disabled');
            $('#provinsi').attr('disabled', 'disabled');
        </script>








@else
                                <div class="modal fade" id="ModalBantuanProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @if(!empty($bantuanProvinsis->proposalProvinsi->isi_ringkasan))
                                                <embed id="iframe" src="{{ asset('UploadedFile/Proposal') }}/{{ $bantuanProvinsis->id_provinsi }}/{{ $bantuanProvinsis->jenis_bantuan }}/{{ $bantuanProvinsis->proposalProvinsi->isi_ringkasan }}   " style="width: 100%;height: 100%;"></embed>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Basto BPBD Provinsi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Provinsi</li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Basto</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-xl-10 col-lg-10 col-md-12 col-sm-12">     
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="{{ url('dataBantuan/provinsi/basto/editBasto/'.$bastoProvinsis->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Form Basto BPBD <b>Provinsi {{ $bantuanProvinsis->proposalProvinsi->provinsi->provinsi }}</b></h4>
                                    <hr>
                                    <input type="hidden" name="provinsi" value="{{ $bantuanProvinsis->proposalProvinsi->provinsi->provinsi }}">
                                    <input type="hidden" name="jenis_bantuan" value="{{ $bantuanProvinsis->jenis_bantuan }}">
                                    <input type="hidden" name="id_bantuanProvinsi" value="{{ $bantuanProvinsis->id }}">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Tahun Perolehan</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tahun" placeholder="Tahun Perolehan" name="tahun_perolehan" value="{{ $bantuanProvinsis->tahun_perolehan }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-3 text-right control-label col-form-label">BPBD Provinsi</label>
                                        <div class="col-sm-9">
                                            <input id="provinsi" type="text" name="provinsi" required class="form-control" value="{{ $bantuanProvinsis->proposalProvinsi->provinsi->provinsi }}">
                                        </div>
                                    </div>

                                    @if(!empty($bastoProvinsis->nomor_basto) && !empty($bastoProvinsis->nomor_basto_file))
                                    <hr>
                                    <div class="modal fade" id="ModalNomorBasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Nomor Basto/'.$bastoProvinsis->nomor_basto_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomor_basto" class="col-sm-3 text-right control-label col-form-label">Nomor Basto</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="nomor_basto" type="text" name="nomor_basto" required class="form-control" value="{{ $bastoProvinsis->nomor_basto }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorBasto"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=nomor_basto') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    @else
                                    <hr>
                                    <div class="form-group row">
                                        <label for="nomor_basto" class="col-sm-3 text-right control-label col-form-label">Nomor Basto</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="nomor_basto" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="nomor_basto_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    @if(!empty($bastoProvinsis->no_permohonan_hibah) && !empty($bastoProvinsis->no_permohonan_hibah_file))
                                    <div class="modal fade" id="ModalNomorPermohonanHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Nomor Permohonan Hibah/'.$bastoProvinsis->no_permohonan_hibah_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_permohonan_hibah" class="col-sm-3 text-right control-label col-form-label">No Permohonan Hibah</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="no_permohonan_hibah" type="text" name="no_permohonan_hibah" required class="form-control" value="{{ $bastoProvinsis->no_permohonan_hibah }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorPermohonanHibah"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=nomor_permohonan_hibah') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_permohonan_hibah" class="col-sm-3 text-right control-label col-form-label">No Permohonan Hibah</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_permohonan_hibah" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_permohonan_hibah_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    @if(!empty($bastoProvinsis->no_bersedia_menerima_hibah) && !empty($bastoProvinsis->no_bersedia_menerima_hibah_file))
                                    <div class="modal fade" id="ModalNomorBersediaMenerimaHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Nomor Bersedia Menerima Hibah/'.$bastoProvinsis->no_bersedia_menerima_hibah_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_bersedia_menerima_hibah" class="col-sm-3 text-right control-label col-form-label">No Bersedia Menerima Hibah</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="no_bersedia_menerima_hibah" type="text" name="no_bersedia_menerima_hibah" required class="form-control" value="{{ $bastoProvinsis->no_bersedia_menerima_hibah }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorBersediaMenerimaHibah"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=no_bersedia_menerima_hibah') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_bersedia_menerima_hibah" class="col-sm-3 text-right control-label col-form-label">No Bersedia Menerima Hibah</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_bersedia_menerima_hibah" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_bersedia_menerima_hibah_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    @if(!empty($bastoProvinsis->no_inventarisasi_barang) && !empty($bastoProvinsis->no_inventarisasi_barang_file))
                                    <div class="modal fade" id="ModalNomorInventarisasiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Nomor Inventarisasi Barang/'.$bastoProvinsis->no_inventarisasi_barang_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_inventarisasi_barang" class="col-sm-3 text-right control-label col-form-label">No Inventarisasi Barang</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="no_inventarisasi_barang" type="text" name="no_inventarisasi_barang" required class="form-control" value="{{ $bastoProvinsis->no_inventarisasi_barang }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorInventarisasiBarang"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=no_inventarisasi_barang') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_inventarisasi_barang" class="col-sm-3 text-right control-label col-form-label">No Inventarisasi Barang</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5 col-xl-7">
                                            <input type="text" name="no_inventarisasi_barang" class="form-control">
                                        </div>
                                        <div class="input-group col-md-12 col-lg-4 col-xl-2">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="no_inventarisasi_barang_file" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    @if(!empty($bastoProvinsis->bast_hibah))
                                    <div class="modal fade" id="ModalBastHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/BAST Hibah/'.$bastoProvinsis->bast_hibah) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bast_hibah" class="col-sm-3 text-right control-label col-form-label">Bast Hibah</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="bast_hibah" type="text" name="bast_hibah" required class="form-control" value="{{ $bastoProvinsis->bast_hibah }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBastHibah"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=bast_hibah') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="bast_hibah" class="col-sm-3 text-right control-label col-form-label">Bast Hibah</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="bast_hibah" class="form-control">
                                        </div>
                                    </div>
                                    @endif

                                    @if(!empty($bastoProvinsis->nasah_hibah))
                                    <div class="modal fade" id="ModalNasahHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Nasah Hibah/'.$bastoProvinsis->nasah_hibah) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nasah_hibah" class="col-sm-3 text-right control-label col-form-label">Nasah Hibah</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="nasah_hibah" type="text" name="nasah_hibah" required class="form-control" value="{{ $bastoProvinsis->nasah_hibah }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNasahHibah"><i class="mdi mdi-open-in-new"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=nasah_hibah') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="nasah_hibah" class="col-sm-3 text-right control-label col-form-label">Nasah Hibah</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" name="nasah_hibah" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    @endif
                                    
                                    <div class="form-group row">
                                        <label for="nilai_bantuan" class="col-sm-3 text-right control-label col-form-label">Nilai Bantuan</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><b>IDR</b></span>
                                            </div>
                                            <input id="nilai_bantuan" type="text" name="nilai_bantuan" required class="form-control" value="{{ $bastoProvinsis->nilai_bantuan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="proposal" class="col-sm-3 text-right control-label col-form-label">Proposal</label>
                                        <div class="input-group col-sm-7 col-7">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="proposal" type="text" name="proposal" required class="form-control" value="{{ $bantuanProvinsis->proposalProvinsi->isi_ringkasan }}">
                                        </div>
                                        <div class="col-sm-2 col-2" style="display: flex;align-items: center;">
                                            @if(!empty($bantuanProvinsis->proposalProvinsi->isi_ringkasan))
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBantuanProv"><i class="mdi mdi-open-in-new"></i></a>
                                            @else
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    @if(!empty($bastoProvinsis->rincian))
                                    <div class="form-group row">
                                        <label for="rincian" class="col-sm-3 text-right control-label col-form-label">Rincian (XLSX)</label>
                                        <div class="col-sm-7 col-7">
                                            <input id="rincian" type="text" name="rincian" required disabled class="form-control" value="{{ $bastoProvinsis->rincian }}">
                                        </div>
                                        <div class="col-sm-2 col-2 action-table" style="display: flex;align-items: center;">
                                            <a href="{{ asset('UploadedFile/Basto/Provinsi/'.$bantuanProvinsis->id.'/Rincian/'.$bastoProvinsis->rincian) }}" class="btn btn-success btn-sm"><i class="mdi mdi-download"></i></a>
                                            <a href="{{ url('dataBantuan/provinsi/basto/deleteField/'.$bastoProvinsis->id.'/?validasiField=rincian') }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="rincian" class="col-sm-3 text-right control-label col-form-label">Rincian (XLSX)</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-excel"></i></span>
                                            </div>
                                            <input type="file" accept=".xlsx, .xls" name="rincian" class="form-control">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Perbarui BASTO</button>
                                        <a href="{{ url('dataBantuan/provinsi/basto/hapusBasto/'.$bastoProvinsis->id) }}?validasiFolder={{ $bantuanProvinsis->id }}" class="btn btn-danger">Hapus BASTO</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#proposal').attr('disabled', 'disabled');
            $('#tahun').attr('disabled', 'disabled');
            $('#provinsi').attr('disabled', 'disabled');
            $('#nomor_basto').attr('disabled', 'disabled');
            $('#no_permohonan_hibah').attr('disabled', 'disabled');
            $('#no_bersedia_menerima_hibah').attr('disabled', 'disabled');
            $('#no_inventarisasi_barang').attr('disabled', 'disabled');
            $('#bast_hibah').attr('disabled', 'disabled');
            $('#nasah_hibah').attr('disabled', 'disabled');

            function dataNull()
            {
                toastr.info("Data belum Anda diupload", "Data Proposal tidak tersedia!");
            }
        </script>
@endif
@endsection