@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')

                                <div class="modal fade" id="ModalBantuanKabKot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <embed id="iframe" src="" style="width: 100%;height: 100%;"></embed>
                                            </div>
                                        </div>
                                    </div>
                                </div>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Bantuan / Kabupaten Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Kabupaten Kota</li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Bantuan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-xl-7 col-lg-10 col-md-12 col-sm-12">     
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="{{ route('simpanBantuanKabupatenKota') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Tambah bantuan Kabupaten Kota</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="id_provinsiBantuan" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select id="id_provinsiBantuan" class="select2 form-control" name="id_provinsi" required>
                                                <option value="">Nama Provinsi</option>
                                                <optgroup label="Provinsi di Indonesia">
                                                    @foreach($provinsiLoops as $res)
                                                    <option value="{{ $res->id_provinsi }}">{{ $res->provinsi }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bpbd_kabKot" class="col-sm-3 text-right control-label col-form-label">BPBD Kabupaten / Kota - Jenis Bantuan</label>
                                        <div class="col-sm-9">
                                            <select id="bpbd_kabKot" class="select2 form-control" name="id_proposalKabupatenKota" required disabled>
                                                
                                            </select>
                                            <input type="hidden" name="jenis_bantuan" id="jenis_bantuan">
                                            <input type="hidden" name="id_kabupatenKota" id="id_kabupatenKota">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_nomor" class="col-sm-3 text-right control-label col-form-label">Tanggal / Nomor</label>
                                        <div class="col-sm-9">
                                            <input id="tanggal_nomor" type="text" name="tanggal_nomor" required class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="proposal" class="col-sm-3 text-right control-label col-form-label">Proposal</label>
                                        <div class="input-group col-sm-7 col-lg-8 col-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input id="proposal" type="text" name="proposal" required class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-2 col-lg-1 col-2" style="display: flex;align-items: center;">
                                            <a href="#" id="open-file" class="btn btn-primary btn-sm"><i class="mdi mdi-open-in-new"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan" class="col-sm-3 text-right control-label col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <input id="keterangan" type="text" name="keterangan" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nilai" class="col-sm-3 text-right control-label col-form-label">Nilai</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><b>IDR</b></span>
                                            </div>
                                            <input id="nilai" type="text" name="nilai" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="risiko" class="col-sm-3 text-right control-label col-form-label">Risiko</label>
                                        <div class="col-sm-9">
                                            <input id="risiko" type="text" name="risiko" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pembentukan" class="col-sm-3 text-right control-label col-form-label">Pembentukan BPBD</label>
                                        <div class="col-sm-9">
                                            <select id="pembentukan" class="select2 form-control" name="pembentukan" required>
                                                <option value="">Pembentukan BPBD</option>
                                                <optgroup label="Iya Atau Tidak">
                                                    @foreach($pembentukans as $res)
                                                    <option value="{{ $res->pembentukan }}">{{ $res->pembentukan }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Tahun Perolehan</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tahun" placeholder="Tahun Perolehan" name="tahun_perolehan">
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
    <script>
        $('#iframe').attr('src', "");
        $('#id_provinsiBantuan').change(function(){
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('dataBantuan/kabupatenKota/getIdProvinsi') }}?id="+id,
                    success:function(res){
                        if (res) {
                            $('#bpbd_kabKot').empty();
                            $('#tanggal_nomor').attr('value', "");
                            $('#proposal').attr('value', "");
                            $('#open-file').attr('href', "#");
                            $('#jenis_bantuan').attr('value', ""); 
                            $('#bpbd_kabKot').attr('disabled', false);
                            $('#bpbd_kabKot').append('<option value="">Nama Kabupaten / Kota - Jenis Bantuan</option>');
                            $('#bpbd_kabKot').append('<optgroup label="BPBD Kabupaten / Kota - Jenis Bantuan">');
                            $.each(res, function(key, value){
                                $('#bpbd_kabKot').append('<option value="'+value.id+'">BPBD '+value.kabupaten_kota+' - '+value.jenis_bantuan+'</option>')
                            });
                            $('#bpbd_kabKot').append('</optgroup>');
                        }
                    }
                });
            }
            else{
                $('#bpbd_kabKot').empty();
                $('#bpbd_kabKot').attr('disabled', 'disabled');
                $('#tanggal_nomor').attr('value', "");
                $('#proposal').attr('value', "");
                $('#iframe').attr('src', "");
                $('#open-file').attr('data-toggle', "");
                $('#open-file').attr('data-target', "");
                $('#jenis_bantuan').attr('value', ""); 
            }
        });
        $('#bpbd_kabKot').change(function(){
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('dataBantuan/kabupatenKota/getIdProposalKabupatenKota') }}?id="+id,
                    success:function(res){
                        if (res) {
                            $.each(res, function(key, value){
                                $('#tanggal_nomor').attr('value', value.tanggal+' / '+value.nomor);
                                $('#jenis_bantuan').attr('value', value.jenis_bantuan);
                                $('#id_provinsi').attr('value', value.id_provinsi);
                                $('#id_kabupatenKota').attr('value', value.id_kabupatenKota); 
                                $('#proposal').attr('value', value.isi_ringkasan);
                                $('#iframe').attr('src', "");
                                $('#open-file').attr('data-toggle', "");
                                $('#open-file').attr('data-target', "");
                                if (value.isi_ringkasan.length != 0) {
                                    $('#iframe').attr('src', "{{ asset('UploadedFile/Proposal/') }}/"+value.id_provinsi+"/"+value.id_kabupatenKota+"/"+value.jenis_bantuan+"/"+value.isi_ringkasan);
                                    $('#open-file').attr('data-toggle', "modal");
                                    $('#open-file').attr('data-target', "#ModalBantuanKabKot");
                                }
                            });
                        }
                    }
                });
            }
            else{
                $('#tanggal_nomor').attr('value', "");
                $('#proposal').attr('value', "");
                $('#iframe').attr('src', "");
                $('#open-file').attr('data-toggle', "");
                $('#open-file').attr('data-target', "");
                $('#jenis_bantuan').attr('value', "");
                $('#id_provinsi').attr('value', "");   
                $('#id_kabupatenKota').attr('value', "");       
            }
        });
        $('#tahun').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
    </script>
@endsection