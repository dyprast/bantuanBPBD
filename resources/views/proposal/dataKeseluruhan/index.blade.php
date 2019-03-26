@extends('layouts.app')

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Bantuan Kabupaten Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Kabupaten Kota</li>
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
                                    <h5 class="card-title">Data Bantuan Kabupaten Kota</h5>
                                    <button onclick="printProposal()" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak Data"><i class="fas fa-print"></i></button>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal / Nomor</th>
                                                <th>Asal</th>
                                                <th>Jenis Bantuan</th>
                                                <th>Isi Ringkasan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; $i2=1; ?>
                                            @foreach($tahuns as $resTahun)
                                                <tr style="font-weight: bold;font-size: 16px;text-align: center;background-color: #f5f5f5;">
                                                    <td colspan="4">{{ $resTahun->tahun }}</td>
                                                </tr>
                                                @foreach($proposalsProv as $res)
                                                    @if($res->tahun == $resTahun->tahun)
                                                    <div class="modal fade" id="ModalProposalProv{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$i}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $res->id_provinsi }}/{{ $res->jenis_bantuan }}/{{ $res->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <tr>
                                                    <td>{{ $res->tanggal }} / {{ $res->nomor }}</td>
                                                    <td>BPBD Provinsi {{ $res->provinsi->provinsi }}</td>
                                                    <td>{{ $res->jenis_bantuan }}</td>
                                                    @if(!empty($res->isi_ringkasan))
                                                    <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalProposalProv{{$i}}">{{ $res->isi_ringkasan }}</a></td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                </tr>
                                                    <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                @foreach($proposalsKabKot as $resKabKot)
                                                    @if($resKabKot->tahun == $resTahun->tahun)
                                                    <div class="modal fade" id="ModalProposalKabKot{{$i2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$i2}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resKabKot->id_provinsi }}/{{ $resKabKot->id_kabupatenKota }}/{{ $resKabKot->jenis_bantuan }}/{{ $resKabKot->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <tr>
                                                    <td>{{ $resKabKot->tanggal }} / {{ $resKabKot->nomor }}</td>
                                                    <td>BPBD {{ $resKabKot->kabupatenKota->status_wilayah }} {{ $resKabKot->kabupatenKota->kabupaten_kota }}</td>
                                                    <td>{{ $resKabKot->jenis_bantuan }}</td>
                                                    @if(!empty($resKabKot->isi_ringkasan))
                                                    <td><a href="#" id="open-file{{ $i2 }}" data-toggle="modal" data-target="#ModalProposalKabKot{{$i2}}">{{ $resKabKot->isi_ringkasan }}</a></td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                </tr>
                                                <?php $i2++; ?>
                                                    @endif
                                                @endforeach
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