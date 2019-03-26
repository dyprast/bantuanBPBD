@extends('layouts.app')

@section('content')
<style>
    .form-control:disabled, .form-control[readonly]{
        background-color: #fff;
        border: none;
        border-bottom: 1px solid #ccc;
    }
    .input-group-text{
        background-color: #fff;
        border: none;
        border-bottom: 1px solid #ccc;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')

                                <div class="modal fade" id="ModalBantuanProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @if(!empty($bantuanKabupatenKotas->proposalKabupatenKota->isi_ringkasan))
                                                <embed id="iframe" src="{{ asset('UploadedFile/Proposal') }}/{{ $bantuanKabupatenKotas->id_provinsi }}/{{ $bantuanKabupatenKotas->id_kabupatenKota }}/{{ $bantuanKabupatenKotas->jenis_bantuan }}/{{ $bantuanKabupatenKotas->proposalKabupatenKota->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Detail Bantuan BPBD Provinsi</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Provinsi</li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Bantuan</li>
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
                            <form class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <div style="text-align: center;">
                                        <div class="m-b-10">
                                            <img src="{{ asset('assets/images/bpbd.png') }}" style="width: 70px;">
                                        </div>
                                        <h4 class="card-title">Bantuan BPBD <b>{{ $bantuanKabupatenKotas->proposalKabupatenKota->kabupatenKota->kabupaten_kota }}, {{ $bantuanKabupatenKotas->proposalKabupatenKota->provinsi->provinsi }}</b></h4>
                                    </div>
                                    <hr>
                                    <h4><i class="fas fa-hands"></i> <b>DATA BANTUAN</b></h4>
                                    <div class="form-group row">
                                        <label for="jenis_bantuan" class="col-sm-2 text-right control-label col-form-label">Jenis Bantuan</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="col-sm-9">
                                            <input id="jenis_bantuan" type="text" name="jenis_bantuan" required class="form-control" disabled value="{{ $bantuanKabupatenKotas->jenis_bantuan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_nomor" class="col-sm-2 text-right control-label col-form-label">Tanggal / Nomor</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="col-sm-9">
                                            <input id="tanggal_nomor" type="text" name="tanggal_nomor" required class="form-control" disabled value="{{ $bantuanKabupatenKotas->proposalKabupatenKota->tanggal }} / {{ $bantuanKabupatenKotas->proposalKabupatenKota->nomor }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="proposal" class="col-sm-2 text-right control-label col-form-label">Proposal</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="proposal" type="text" name="proposal" required class="form-control" disabled value="{{ $bantuanKabupatenKotas->proposalKabupatenKota->isi_ringkasan }}">
                                        </div>
                                        <div class="col-sm-1 col-1" style="display: flex;align-items: center;">
                                            @if(!empty($bantuanKabupatenKotas->proposalKabupatenKota->isi_ringkasan))
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBantuanProv"><i class="mdi mdi-open-in-new"></i></a>
                                            @else
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm" ><i class="mdi mdi-open-in-new"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan" class="col-sm-2 text-right control-label col-form-label">Keterangan</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="col-sm-9">
                                            <input id="keterangan" type="text" name="keterangan" required class="form-control" value="{{ $bantuanKabupatenKotas->keterangan }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nilai" class="col-sm-2 text-right control-label col-form-label">Nilai</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><b>IDR</b></span>
                                            </div>
                                            <input id="nilai" type="text" name="nilai" required class="form-control" value="{{ $bantuanKabupatenKotas->nilai }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="risiko" class="col-sm-2 text-right control-label col-form-label">Risiko</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="col-sm-9">
                                            <input id="risiko" type="text" name="risiko" required class="form-control" value="{{ $bantuanKabupatenKotas->risiko }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pembentukan" class="col-sm-2 text-right control-label col-form-label">Pembentukan BPBD</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="col-sm-9">
                                            <input id="pembentukan" type="text" name="pembentukan" required class="form-control" disabled value="{{ $bantuanKabupatenKotas->pembentukan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 text-right control-label col-form-label">Tahun Perolehan</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tahun" placeholder="Tahun Perolehan" name="tahun_perolehan" value="{{ $bantuanKabupatenKotas->tahun_perolehan }}" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                @if(!empty($bastoKabupatenKotas))
                                    <h4><i class="fas fa-hands"></i> <b>DATA BASTO</b></h4>
                                    @if(!empty($bastoKabupatenKotas->nomor_basto_file))
                                    <div class="modal fade" id="ModalNomorBasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Nomor Basto/'.$bastoKabupatenKotas->nomor_basto_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomor_basto" class="col-sm-2 text-right control-label col-form-label">Nomor Basto</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="nomor_basto" type="text" name="nomor_basto" required class="form-control" value="{{ $bastoKabupatenKotas->nomor_basto }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorBasto"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="nomor_basto" class="col-sm-2 text-right control-label col-form-label">Nomor Basto</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="nomor_basto" type="text" name="nomor_basto" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($bastoKabupatenKotas->no_permohonan_hibah_file))
                                    <div class="modal fade" id="ModalNomorPermohonanHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Nomor Permohonan Hibah/'.$bastoKabupatenKotas->no_permohonan_hibah_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_permohonan_hibah" class="col-sm-2 text-right control-label col-form-label">No Permohonan Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_permohonan_hibah" type="text" name="no_permohonan_hibah" required class="form-control" value="{{ $bastoKabupatenKotas->no_permohonan_hibah }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorPermohonanHibah"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_permohonan_hibah" class="col-sm-2 text-right control-label col-form-label">No Permohonan Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_permohonan_hibah" type="text" name="no_permohonan_hibah" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($bastoKabupatenKotas->no_bersedia_menerima_hibah_file))
                                    <div class="modal fade" id="ModalNomorBersediaMenerimaHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Nomor Bersedia Menerima Hibah/'.$bastoKabupatenKotas->no_bersedia_menerima_hibah_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_bersedia_menerima_hibah" class="col-sm-2 text-right control-label col-form-label">No Bersedia Menerima Hibah</label>
       
       <label class="col-sm-1 text-right control-label col-form-label">:</label>                                 <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_bersedia_menerima_hibah" type="text" name="no_bersedia_menerima_hibah" required class="form-control" value="{{ $bastoKabupatenKotas->no_bersedia_menerima_hibah }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorBersediaMenerimaHibah"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_bersedia_menerima_hibah" class="col-sm-2 text-right control-label col-form-label">No Bersedia Menerima Hibah</label>
       
       <label class="col-sm-1 text-right control-label col-form-label">:</label>                                 <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_bersedia_menerima_hibah" type="text" name="no_bersedia_menerima_hibah" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($bastoKabupatenKotas->no_inventarisasi_barang_file))
                                    <div class="modal fade" id="ModalNomorInventarisasiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Nomor Inventarisasi Barang/'.$bastoKabupatenKotas->no_inventarisasi_barang_file) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_inventarisasi_barang" class="col-sm-2 text-right control-label col-form-label">No Inventarisasi Barang</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_inventarisasi_barang" type="text" name="no_inventarisasi_barang" required class="form-control" value="{{ $bastoKabupatenKotas->no_inventarisasi_barang }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNomorInventarisasiBarang"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="no_inventarisasi_barang" class="col-sm-2 text-right control-label col-form-label">No Inventarisasi Barang</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="no_inventarisasi_barang" type="text" name="no_inventarisasi_barang" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($bastoKabupatenKotas->bast_hibah))
                                    <div class="modal fade" id="ModalBastHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/BAST Hibah/'.$bastoKabupatenKotas->bast_hibah) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bast_hibah" class="col-sm-2 text-right control-label col-form-label">Bast Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="bast_hibah" type="text" name="bast_hibah" required class="form-control" value="{{ $bastoKabupatenKotas->bast_hibah }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBastHibah"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="bast_hibah" class="col-sm-2 text-right control-label col-form-label">Bast Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="bast_hibah" type="text" name="bast_hibah" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($bastoKabupatenKotas->nasah_hibah))
                                    <div class="modal fade" id="ModalNasahHibah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <embed id="iframe" src="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Nasah Hibah/'.$bastoKabupatenKotas->nasah_hibah) }}" style="width: 100%;height: 100%;"></embed>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nasah_hibah" class="col-sm-2 text-right control-label col-form-label">Nasah Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="nasah_hibah" type="text" name="nasah_hibah" required class="form-control" value="{{ $bastoKabupatenKotas->nasah_hibah }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalNasahHibah"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="nasah_hibah" class="col-sm-2 text-right control-label col-form-label">Nasah Hibah</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="nasah_hibah" type="text" name="nasah_hibah" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="nilai_bantuan" class="col-sm-2 text-right control-label col-form-label">Nilai Bantuan</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><b>IDR</b></span>
                                            </div>
                                            <input id="nilai_bantuan" type="text" name="nilai_bantuan" required class="form-control" value="{{ $bastoKabupatenKotas->nilai_bantuan }}" disabled>
                                        </div>
                                    </div>
                                    @if(!empty($bastoKabupatenKotas->rincian))
                                    <div class="form-group row">
                                        <label for="rincian" class="col-sm-2 text-right control-label col-form-label">Rincian</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="rincian" type="text" name="rincian" required class="form-control" value="{{ $bastoKabupatenKotas->rincian }}" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="{{ asset('UploadedFile/Basto/Kabupaten Kota/'.$bantuanKabupatenKotas->id.'/Rincian/'.$bastoKabupatenKotas->rincian) }}" class="btn btn-success btn-sm"><i class="mdi mdi-download"></i></a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="rincian" class="col-sm-2 text-right control-label col-form-label">Rincian</label>
                                        <label class="col-sm-1 text-right control-label col-form-label">:</label>
                                        <div class="input-group col-sm-8 col-8">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="rincian" type="text" name="rincian" required class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-sm-1 col-1 action-table" style="display: flex;align-items: center;">
                                            <a href="#" onclick="dataNull()" class="btn btn-success btn-sm"><i class="mdi mdi-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                    <div>
                                        <a href="../" class="btn btn-primary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function dataNull()
            {
                toastr.info("Data belum Anda diupload", "Data tidak tersedia!");
            }
        </script>
@endsection