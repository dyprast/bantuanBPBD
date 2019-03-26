@extends('layouts.app')

@section('content')
<style>
    .table-striped tbody tr:nth-of-type(odd){
        background-color: #fff;
    }
</style>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Bantuan Keseluruhan</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Keseluruhan</li>
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
                                    <h5 class="card-title">Data Bantuan Keseluruhan</h5>
                                    <button onclick="printBantuan()" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak Data"><i class="fas fa-print"></i></button>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>  
                                                <th>BPBD</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Keterangan</th>
                                                <th>Jenis Bantuan</th>
                                                <th>Nilai</th>
                                                <th>Risiko</th>
                                                <th>Proposal</th>
                                                <th>Pembentukan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($bantuanProvinsis as $resProvinsi)
                                                @if($resProvinsi->loop_data != 3 && $resProvinsi->id_provinsi != NULL)
                                                <div class="modal fade" id="ModalBantuanKabKot{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <embed id="iframe{{$i}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resProvinsi->id_provinsi }}/{{ $resProvinsi->jenis_bantuan }}/{{ $resProvinsi->proposalProvinsi->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <tr style="font-weight: bold;background-color: #f5f5f5;">
                                                    <td>{{ $i }}</td>
                                                    <td>BPBD Provinsi {{ $resProvinsi->proposalProvinsi->provinsi->provinsi }}</td>
                                                    <td>{{ $resProvinsi->tahun_perolehan }}</td>
                                                    <td>{{ $resProvinsi->keterangan }}</td>
                                                    <td>{{ $resProvinsi->jenis_bantuan }}</td>
                                                    <td>{{ $resProvinsi->nilai }}</td>
                                                    <td>{{ $resProvinsi->risiko }}</td>
                                                    @if(!empty($resProvinsi->proposalProvinsi->isi_ringkasan))
                                                    <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalBantuanKabKot{{$i}}">{{ $resProvinsi->proposalProvinsi->isi_ringkasan }}</a></td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                    <td>{{ $resProvinsi->pembentukan }}</td>
                                                </tr>
                                                <?php $i2 = 1; ?>
                                                @foreach($bantuanKabupatenKotas as $resKabupatenKota)
                                                    @if($resKabupatenKota->id_provinsi == $resProvinsi->id_provinsi && $resProvinsi->loop_data == 1 && $resKabupatenKota->loop_data == 0 && !empty($resKabupatenKota->proposalKabupatenKota->isi_ringkasan))
                                                    <div class="modal fade" id="ModalBantuanKabKot2-{{$i2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$i2}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resKabupatenKota->id_provinsi }}/{{ $resKabupatenKota->id_kabupatenKota }}/{{ $resKabupatenKota->jenis_bantuan }}/{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <tr>
                                                        <td>{{ $i }}.{{ $i2 }}</td>
                                                        <td>BPBD {{ $resKabupatenKota->proposalKabupatenKota->kabupaten_kota }}</td>
                                                        <td>{{ $resKabupatenKota->tahun_perolehan }}</td>
                                                        <td>{{ $resKabupatenKota->keterangan }}</td>
                                                        <td>{{ $resKabupatenKota->jenis_bantuan }}</td>
                                                        <td>{{ $resKabupatenKota->nilai }}</td>
                                                        <td>{{ $resKabupatenKota->risiko }}</td>
                                                        <td><a href="#" id="open-file{{ $i2 }}" data-toggle="modal" data-target="#ModalBantuanKabKot2-{{$i2}}">{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}</a></td>
                                                        <td>{{ $resKabupatenKota->pembentukan }}</td>
                                                    </tr>
                                                    <?php $i2++; ?>
                                                    @elseif($resKabupatenKota->id_provinsi == $resProvinsi->id_provinsi && $resProvinsi->loop_data == 1 && $resKabupatenKota->loop_data == 0)
                                                    <div class="modal fade" id="ModalBantuanKabKot2-{{$i2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$i2}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resKabupatenKota->id_provinsi }}/{{ $resKabupatenKota->id_kabupatenKota }}/{{ $resKabupatenKota->jenis_bantuan }}/{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <tr>
                                                        <td>{{ $i }}.{{ $i2 }}</td>
                                                        <td>BPBD {{ $resKabupatenKota->proposalKabupatenKota->kabupaten_kota }}</td>
                                                        <td>{{ $resKabupatenKota->tahun_perolehan }}</td>
                                                        <td>{{ $resKabupatenKota->keterangan }}</td>
                                                        <td>{{ $resKabupatenKota->jenis_bantuan }}</td>
                                                        <td>{{ $resKabupatenKota->nilai }}</td>
                                                        <td>{{ $resKabupatenKota->risiko }}</td>
                                                        <td>-</td>
                                                        <td>{{ $resKabupatenKota->pembentukan }}</td>
                                                    </tr>
                                                    <?php $i2++; ?>
                                                    @endif
                                                @endforeach
                                                <?php $i++; ?>
                                                @elseif($rowLoops >= 1)
                                                    <tr style="font-weight: bold;background-color: #f5f5f5;">
                                                        <td colspan="10"><b>BPBD Kabupaten / Kota</b></td>
                                                    </tr>
                                                    <?php $noLoop = 1; ?>
                                                    @foreach($bantuanKabupatenKotas as $resKabupatenKota)
                                                    @if($resKabupatenKota->loop_data == 1)
                                                    <div class="modal fade" id="ModalBantuanKabKot2-{{$noLoop}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$noLoop}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resKabupatenKota->id_provinsi }}/{{ $resKabupatenKota->id_kabupatenKota }}/{{ $resKabupatenKota->jenis_bantuan }}/{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <tr>
                                                        <td>{{ $noLoop }}</td>
                                                        <td><b>BPBD {{ $resKabupatenKota->proposalKabupatenKota->kabupaten_kota }}</b>, {{ $resKabupatenKota->proposalKabupatenKota->provinsi->provinsi }}</td>
                                                        <td>{{ $resKabupatenKota->tahun_perolehan }}</td>
                                                        <td>{{ $resKabupatenKota->keterangan }}</td>
                                                        <td>{{ $resKabupatenKota->jenis_bantuan }}</td>
                                                        <td>{{ $resKabupatenKota->nilai }}</td>
                                                        <td>{{ $resKabupatenKota->risiko }}</td>
                                                        @if(!empty($resKabupatenKota->proposalKabupatenKota->isi_ringkasan))
                                                        <td><a href="#" id="open-file{{ $noLoop }}" data-toggle="modal" data-target="#ModalBantuanKabKot2-{{$noLoop}}">{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}</a></td>
                                                        @else
                                                        <td>-</td>
                                                        @endif
                                                        <td>{{ $resKabupatenKota->pembentukan }}</td>
                                                    </tr>
                                                    <?php $noLoop++; ?>
                                                    @endif
                                                    @endforeach
                                                @endif
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
@endsection