@extends('layouts.app')

@section('content')
    <style>
        .maps{
            width: 100%;
            height: 520px;
        }
        @media (min-width: 1750px){
            .maps{
                height: 580px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover" style="cursor: pointer;">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">Dashboard</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="javascript:void(0)" onclick="dataBantuan()">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-archive"></i></h1>
                                <h6 class="text-white">Data Bantuan</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xlg-6">
                        <a href="javascript:void(0)" onclick="proposalPermintaan()">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-comment-text-outline"></i></h1>
                                <h6 class="text-white">Proposal Permintaan</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 col-xlg-4">
                        <a href="javascript:void(0)" onclick="fitur()">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-webpack"></i></h1>
                                <h6 class="text-white">Data Fitur</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-2 col-xlg-2">
                        <a href="{{ url('provinsi') }}">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-map-marker-radius"></i></h1>
                                <h6 class="text-white">BPBD Provinsi</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-2 col-xlg-2">
                        <a href="{{ url('kabupatenKota') }}">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-map-marker-circle"></i></h1>
                                <h6 class="text-white">BPBD Kabupaten / Kota</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2 col-xlg-2">
                        <a href="{{ url('jenisBantuan') }}">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-share-variant"></i></h1>
                                <h6 class="text-white">Jenis Bantuan</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2 col-xlg-2">
                        <a href="{{ url('pembentukanBPBD') }}">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-pocket"></i></h1>
                                <h6 class="text-white">Pembentukan BPBD</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="card m-t-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="peity_bar_good left text-center m-t-10"><span>12,6,9,23,14,10,13</span>
                                        <h6>Jumlah Pengguna</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 border-left text-center p-t-10">
                                <h3 class="mb-0 font-weight-bold">{{ $users->count() }}</h3>
                                    <span class="text-muted">Pengguna</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="card m-t-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="peity_bar_good left text-center m-t-10"><span>12,6,9,23,14,10,13</span>
                                        <h6>Data Jenis Bantuan</h6></div>
                                </div>
                                <div class="col-md-6 border-left text-center p-t-10">
                                    <h3 class="mb-0 font-weight-bold">{{ $jenisBantuans->count() }}</h3>
                                    <span class="text-muted">Jenis Bantuan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="card m-t-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="peity_bar_good left text-center m-t-10"><span>12,6,9,23,14,10,13</span>
                                        <h6>BPBD Provinsi</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 border-left text-center p-t-10">
                                    <h3 class="mb-0 ">{{ $provinsis->count() }}</h3>
                                    <span class="text-muted">BPBD Provinsi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="card m-t-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="peity_bar_good left text-center m-t-10"><span>12,6,9,23,14,10,13</span>
                                        <h6>BPBD Kabupaten / Kota</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 border-left text-center p-t-10">
                                    <h3 class="mb-0 font-weight-bold">{{ $kabupatenKotas->count() }}</h3>
                                    <span class="text-muted">BPBD Kabupaten / Kota</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none">
                    @php
                        $i1 = 1;
                    @endphp
                    @foreach($tahunBantuanProvinsis as $resTahun)
                    <div><span id="tahun{{$loop->iteration}}">{{ $resTahun->tahun_perolehan }}</span>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($bantuanKabupatenKotas as $resBantuan)
                        @if($resBantuan->tahun_perolehan == $resTahun->tahun_perolehan)
                        <div id="total{{$i1}}">    
                                <span id="jml">{{ $i }}</span>
                                @php
                                $i++;
                                @endphp
                        </div>
                            @endif
                        @endforeach
                    </div>
                        @php
                            $i1++;
                        @endphp
                    @endforeach
                </div>
                <div style="display: none">
                    @php
                        $i1 = 1;
                    @endphp
                    @foreach($tahunBantuanProvinsis as $resTahunP)
                    <div><span id="tahunBP{{$loop->iteration}}">{{ $resTahunP->tahun_perolehan }}</span>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($bantuanProvinsis as $resBantuanP)
                        @if($resBantuanP->tahun_perolehan == $resTahunP->tahun_perolehan)
                        <div id="totalBP{{$i1}}">    
                                <span id="jmlBP">{{ $i }}</span>
                                @php
                                $i++;
                                @endphp
                        </div>
                            @endif
                        @endforeach
                    </div>
                        @php
                            $i1++;
                        @endphp
                    @endforeach
                </div>
                <div style="display: none;">
                        @php
                            $i1 = 1;
                        @endphp
                        @foreach($tahunProposalProvinsis as $resTahunPr)
                        <div><span id="tahunPr{{$loop->iteration}}">{{ $resTahunPr->tahun }}</span>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($proposalKabupatenKotas as $resProposalPr)
                            @if($resProposalPr->tahun == $resTahunPr->tahun)
                            <div id="totalPr{{$i1}}">    
                                    <span id="jmlPr">{{ $i }}</span>
                                    @php
                                    $i++;
                                    @endphp
                            </div>
                                @endif
                            @endforeach
                        </div>
                            @php
                                $i1++;
                            @endphp
                        @endforeach
                    </div>
                    <div style="display:none">
                        @php
                            $i1 = 1;
                        @endphp
                        @foreach($tahunProposalProvinsis as $resTahunPrP)
                        <div><span id="tahunPrP{{$loop->iteration}}">{{ $resTahunPrP->tahun }}</span>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($proposalProvinsis as $resProposalPrP)
                            @if($resProposalPrP->tahun == $resTahunPrP->tahun)
                            <div id="totalPrP{{$i1}}">    
                                    <span id="jmlPrP">{{ $i }}</span>
                                    @php
                                    $i++;
                                    @endphp
                            </div>
                                @endif
                            @endforeach
                        </div>
                            @php
                                $i1++;
                            @endphp
                        @endforeach
                    </div>
                    {{-- <div>
                        @foreach($jenisBantuanKabupatenKotas as $jenisBantuanKK)
                        <span id="jenisBantuanKK{{ $loop->iteration }}">{{ $jenisBantuanKK->jenis_bantuan }}</span>
                            @php
                                $ibkkjb = 1;
                            @endphp
                            @foreach($bantuanKabupatenKotas as $bkkjb)
                                @if($bkkjb->jenis_bantuan == $jenisBantuanKK->jenis_bantuan)
                                <span id="totalbkkjb">{{ $ibkkjb }}</span>
                                @php
                                    $ibkkjb++;
                                @endphp
                                @endif
                            @endforeach
                        @endforeach
                    </div>   --}}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-7">
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#bantuan1" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Data Bantuan</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#proposal1" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Proposal Permintaan</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="bantuan1" role="tabpanel">
                                    <div class="p-20">
                                        <canvas id="line-chart" width="800" height="450"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="proposal1" role="tabpanel">
                                    <div class="p-20">
                                        <canvas id="line-chart2" width="800" height="450"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-5">
                        <div class="card">
                            <iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9995.064312217793!2d106.86800097044352!3d-6.191720362325791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4f457ccd0a9%3A0xf289c5d0c3a73ad3!2sHelipad+BNPB!5e0!3m2!1sen!2sid!4v1552524898837" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#bantuanProv" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Bantuan BPBD Provinsi</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bantuanKabkot" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Bantuan BPBD Kabupaten / Kota</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="bantuanProv" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>BPBD</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Jenis Bantuan</th>
                                                        <th>Proposal</th>
                                                        <th>Pembentukan BPBD</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($bantuanProvinsisLimit as $res)
                                                        @if(!empty($res->proposalProvinsi->id_provinsi))
                                                        
                                                        <div class="modal fade" id="ModalBantuanKabKot{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <embed id="iframe{{$i}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $res->id_provinsi }}/{{ $res->jenis_bantuan }}/{{ $res->proposalProvinsi->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>BPBD Provinsi {{ $res->proposalProvinsi->provinsi->provinsi }}</td>
                                                            <td>{{ $res->tahun_perolehan }}</td>
                                                            <td>{{ $res->jenis_bantuan }}</td>
                                                            @if(!empty($res->proposalProvinsi->isi_ringkasan))
                                                            <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalBantuanKabKot{{$i}}">{{ $res->proposalProvinsi->isi_ringkasan }}</a></td>
                                                            @else
                                                            <td>-</td>
                                                            @endif
                                                            <td>{{ $res->pembentukan }}</td>
                                                            <td nowrap>
                                                                <a href="{{ url('dataBantuan/provinsi/editBantuanProvinsi/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                                <a href="#" data-uri="{{ url('dataBantuan/provinsi/hapusBantuanProvinsi/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('dataBantuan/provinsi') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bantuanKabkot" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>BPBD</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Jenis Bantuan</th>
                                                        <th>Proposal</th>
                                                        <th>Pembentukan BPBD</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($bantuanKabupatenKotasLimit as $res)
        
                                                    <div class="modal fade" id="ModalBantuanKabKot{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <embed id="iframe{{$i}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $res->id_provinsi }}/{{ $res->id_kabupatenKota }}/{{ $res->jenis_bantuan }}/{{ $res->proposalKabupatenKota->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><b>BPBD {{ $res->proposalKabupatenKota->kabupaten_kota }}</b>, {{ $res->proposalKabupatenKota->provinsi->provinsi }}</td>
                                                            <td>{{ $res->tahun_perolehan }}</td>
                                                            <td>{{ $res->jenis_bantuan }}</td>
                                                            @if(!empty($res->proposalKabupatenKota->isi_ringkasan))
                                                            <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalBantuanKabKot{{$i}}">{{ $res->proposalKabupatenKota->isi_ringkasan }}</a></td>
                                                            @else
                                                            <td>-</td>
                                                            @endif
                                                            <td>{{ $res->pembentukan }}</td>
                                                            <td nowrap>
                                                                <a href="{{ url('dataBantuan/kabupatenKota/editBantuanKabupatenKota/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                                <a href="#" data-uri="{{ url('dataBantuan/kabupatenKota/hapusBantuanKabupatenKota/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('dataBantuan/kabupatenKota') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#proposalProv" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Proposal BPBD Provinsi</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#proposalKabkot" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Proposal BPBD Kabupaten / Kota</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="proposalProv" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>BPBD Asal</th>
                                                        <th>Jenis Bantuan</th>
                                                        <th>Isi Ringkasan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                        @foreach($proposalProvinsisLimit as $res)
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
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>BPBD Provinsi {{ $res->provinsi->provinsi }}</td>
                                                            <td>{{ $res->jenis_bantuan }}</td>
                                                            @if(!empty($res->isi_ringkasan))
                                                            <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalProposalProv{{$i}}">{{ $res->isi_ringkasan }}</a></td>
                                                            @else
                                                            <td>-</td>
                                                            @endif
                                                            <td nowrap>
                                                                <a href="{{ url('proposalPermintaan/provinsi/editProposalProvinsi/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                                <a href="#" data-uri="{{ url('proposalPermintaan/provinsi/hapusProposalProvinsi/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('proposalPermintaan/provinsi') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="proposalKabkot" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>BPBD Asal</th>
                                                        <th>Jenis Bantuan</th>
                                                        <th>Isi Ringkasan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i= 1; ?>
                                                        @foreach($proposalKabupatenKotasLimit as $res)
                                                        <div class="modal fade" id="ModalProposalKabKot{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <embed id="iframe{{$i}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $res->id_provinsi }}/{{ $res->id_kabupatenKota }}/{{ $res->jenis_bantuan }}/{{ $res->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><b>BPBD {{ $res->kabupatenKota->kabupaten_kota }}</b>, {{ $res->provinsi->provinsi }}</td>
                                                            <td>{{ $res->jenis_bantuan }}</td>
                                                            @if(!empty($res->isi_ringkasan))
                                                            <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalProposalKabKot{{$i}}">{{ $res->isi_ringkasan }}</a></td>
                                                            @else
                                                            <td>-</td>
                                                            @endif
                                                            <td nowrap>
                                                                <a href="{{ url('proposalPermintaan/kabupatenKota/editProposalKabupatenKota/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                                <a href="#" data-uri="{{ url('proposalPermintaan/kabupatenKota/hapusProposalKabupatenKota/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('proposalPermintaan/kabupatenKota') }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                © 2018, All Rights Reserved <a href="http://bnpb.go.id/">BNPB</a>.
            </footer>  
        </div>
    
    <script>
        var bantuan = $('#dataBantuan').text();
        var proposal = $('#proposalPermintaan').text();
        var provinsi = $('#provinsi').text();
        var kabkot = $('#kabkot').text();
        var jenisBantuan = $('#jenisBantuan').text();
        
        var total1 = $('#total1 #jml').last().text();      
        var total2 = $('#total2 #jml').last().text();
        var total3 = $('#total3 #jml').last().text();
        var total4 = $('#total4 #jml').last().text();
        var total5 = $('#total5 #jml').last().text(); 
        var total6 = $('#total6 #jml').last().text();
        var total7 = $('#total7 #jml').last().text();
        var total8 = $('#total8 #jml').last().text();
        
        var tahunBP1 = $('#tahunBP1').text();         
        var tahunBP2 = $('#tahunBP2').text();
        var tahunBP3 = $('#tahunBP3').text();
        var tahunBP4 = $('#tahunBP4').text();
        var tahunBP5 = $('#tahunBP5').text(); 
        var tahunBP6 = $('#tahunBP6').text();
        var tahunBP7 = $('#tahunBP7').text();
        var tahunBP8 = $('#tahunBP8').text();
        
        var totalBP1 = $('#totalBP1 #jmlBP').last().text();      
        var totalBP2 = $('#totalBP2 #jmlBP').last().text();
        var totalBP3 = $('#totalBP3 #jmlBP').last().text();
        var totalBP4 = $('#totalBP4 #jmlBP').last().text();
        var totalBP5 = $('#totalBP5 #jmlBP').last().text(); 
        var totalBP6 = $('#totalBP6 #jmlBP').last().text();
        var totalBP7 = $('#totalBP7 #jmlBP').last().text();
        var totalBP8 = $('#totalBP8 #jmlBP').last().text();

        new Chart(document.getElementById("line-chart"), {
            type: 'bar',
            data: {
                labels: [tahunBP8,tahunBP7,tahunBP6,tahunBP5,tahunBP4,tahunBP3,tahunBP2,tahunBP1],
                datasets: [
                { 
                    data: [totalBP8,totalBP7,totalBP6,totalBP5,totalBP4,totalBP3,totalBP2,totalBP1],
                    label: "Provinsi",
                    backgroundColor: "#3e95cd",
                    fill: true
                },
                {
                    data: [total8,total7,total6,total5,total4,total3,total2,total1],
                    label: "Kabupaten / Kota",
                    backgroundColor: "#28b779",
                    fill: true
                }
                ]
            },
            options: {
                title: {
                display: true,
                text: 'Data Bantuan Berdasarkan Wilayah BPBD'
                }
            }
        });
        var totalPr1 = $('#totalPr1 #jmlPr').last().text();      
        var totalPr2 = $('#totalPr2 #jmlPr').last().text();
        var totalPr3 = $('#totalPr3 #jmlPr').last().text();
        var totalPr4 = $('#totalPr4 #jmlPr').last().text();
        var totalPr5 = $('#totalPr5 #jmlPr').last().text(); 
        var totalPr6 = $('#totalPr6 #jmlPr').last().text();
        var totalPr7 = $('#totalPr7 #jmlPr').last().text();
        var totalPr8 = $('#totalPr8 #jmlPr').last().text();
        
        var tahunPrP1 = $('#tahunPrP1').text();        
        var tahunPrP2 = $('#tahunPrP2').text();
        var tahunPrP3 = $('#tahunPrP3').text();
        var tahunPrP4 = $('#tahunPrP4').text();
        var tahunPrP5 = $('#tahunPrP5').text(); 
        var tahunPrP6 = $('#tahunPrP6').text();
        var tahunPrP7 = $('#tahunPrP7').text();
        var tahunPrP8 = $('#tahunPrP8').text();
        
        var totalPrP1 = $('#totalPrP1 #jmlPrP').last().text();      
        var totalPrP2 = $('#totalPrP2 #jmlPrP').last().text();
        var totalPrP3 = $('#totalPrP3 #jmlPrP').last().text();
        var totalPrP4 = $('#totalPrP4 #jmlPrP').last().text();
        var totalPrP5 = $('#totalPrP5 #jmlPrP').last().text(); 
        var totalPrP6 = $('#totalPrP6 #jmlPrP').last().text();
        var totalPrP7 = $('#totalPrP7 #jmlPrP').last().text();
        var totalPrP8 = $('#totalPrP8 #jmlPrP').last().text();

        new Chart(document.getElementById("line-chart2"), {
            type: 'line',
            data: {
                labels: [tahunPrP8,tahunPrP7,tahunPrP6,tahunPrP5,tahunPrP4,tahunPrP3,tahunPrP2,tahunPrP1],
                datasets: [{ 
                    data: [totalPr8,totalPr7,totalPr6,totalPr5,totalPr4,totalPr3,totalPr2,totalPr1],
                    label: "Kabupaten / Kota",
                    borderColor: "#3e95cd",
                    fill: true
                }, { 
                    data: [totalPrP8,totalPrP7,totalPrP6,totalPrP5,totalPrP4,totalPrP3,totalPrP2,totalPrP1],
                    label: "Provinsi",
                    borderColor: "#28b779",
                    fill: true
                }
                ]
            },
            options: {
                title: {
                display: true,
                text: 'Proposal Permintaan Berdasarkan Wilayah BPBD'
                }
            }
        });
        function fitur()
        {
            $('#data-fiturMenu').click();
        }
        function dataBantuan()
        {
            $('#data-bantuanMenu').click();
        }
        function proposalPermintaan()
        {
            $('#proposal-permintaanMenu').click();
        }
    </script>
@endsection
