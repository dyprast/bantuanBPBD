@extends('layouts.app')

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Proposal Permintaan BPBD Kabupaten Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Proposal</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Kabupaten / Kota</li>
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
                            <form class="form-horizontal" method="POST" action="{{ url('proposalPermintaan/kabupatenKota/prosesEditProposalKabupatenKota/'.$proposalsKabKot->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Edit Proposal</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="id_provinsiProposal" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select id="id_provinsiProposal" class="select2 form-control" name="id_provinsi" required disabled>
                                                <option value="">Nama Provinsi</option>
                                                <optgroup label="Provinsi di Indonesia">
                                                    @foreach($provinsis as $res)
                                                    @if($proposalsKabKot->provinsi->provinsi == $res->provinsi)
                                                    <option value="{{ $res->id }}" data="{{ $res->provinsi }}" selected>{{ $res->provinsi }}</option>
                                                    @else
                                                    <option value="{{ $res->id }}" data="{{ $res->provinsi }}">{{ $res->provinsi }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            <input type="hidden" name="id_provinsi" value="{{ $proposalsKabKot->id_provinsi }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kabupatenKotaProposal" class="col-sm-3 text-right control-label col-form-label">Kabupaten / Kota</label>
                                        <div class="col-sm-9">
                                            <select id="kabupatenKotaProposal" class="select2 form-control" name="id_kabupatenKota" required disabled>
                                                <option value="{{ $proposalsKabKot->kabupatenKota->id }}" selected>{{ $proposalsKabKot->kabupatenKota->status_wilayah }} {{ $proposalsKabKot->kabupatenKota->kabupaten_kota }}</option>
                                            </select>
                                            <input type="hidden" name="id_kabupatenKota" value="{{ $proposalsKabKot->id_kabupatenKota }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis_bantuan" class="col-sm-3 text-right control-label col-form-label">Jenis Bantuan</label>
                                        <div class="col-sm-9">
                                            <select id="jenis_bantuan" class="select2 form-control" name="jenis_bantuan" required disabled>
                                                <option value="">Jenis Bantuan</option>
                                                <optgroup label="Jenis Bantuan BPBD">
                                                    @foreach($jenisBantuans as $res)
                                                    @if($proposalsKabKot->jenis_bantuan == $res->jenis_bantuan)
                                                    <option value="{{ $res->jenis_bantuan }}" selected>{{ $res->jenis_bantuan }}</option>
                                                    @else
                                                    <option value="{{ $res->jenis_bantuan }}">{{ $res->jenis_bantuan }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            <input type="hidden" name="jenis_bantuan" value="{{ $proposalsKabKot->jenis_bantuan }}">
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
                                            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor" value="{{ $proposalsKabKot->nomor }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Tanggal</label>
                                        <div class="input-group col-sm-9">
                                            <input type="text" required class="form-control" data-date-format='dd MM yyyy' id="tanggal" placeholder="dd mm yyyy" name="tanggal" value="{{ $proposalsKabKot->tanggal }}">
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
        $('#id_provinsiProposal').change(function(){
            var id_provinsi = $(this).val();
            var provinsi = $('#id_provinsiProposal :selected').text();
            if (id_provinsi) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('proposalPermintaan/getIdProvinsi') }}?id_provinsi="+id_provinsi,
                    success:function(res){
                        if (res) {
                            $('#kabupatenKotaProposal').empty();
                            $('#kabupatenKotaProposal').prop('disabled', false);
                            $('#kabupatenKotaProposal').append('<option value="">Nama Kabupaten Kota</option>');
                            $('#kabupatenKotaProposal').append('<optgroup label="Provinsi '+provinsi+'">');
                            $.each(res, function(key, value){
                                $('#kabupatenKotaProposal').append('<option value="'+value.id+'">'+value.kabupaten_kota+'</option>');
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection