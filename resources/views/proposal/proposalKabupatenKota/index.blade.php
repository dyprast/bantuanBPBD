@extends('layouts.app')

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Proposal Permintaan BPBD Kabupaten / Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Proposal</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Kabupaten / Kota</li>
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
                                    <h5 class="card-title">Data Proposal Permintaan BPBD Kabupaten / Kota</h5>
                                    <div>
                                        <a href="{{ url('proposalPermintaan/kabupatenKota/tambahProposalKabupatenKota') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Tambah Proposal"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal / Nomor</th>
                                                <th>Asal</th>
                                                <th>Jenis Bantuan</th>
                                                <th>Isi Ringkasan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i= 1; ?>
                                                @foreach($proposals as $res)
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
                                                    <td>{{ $res->tanggal }} / {{ $res->nomor }}</td>
                                                    <td><b>BPBD {{ $res->kabupatenKota->kabupaten_kota }}</b>, {{ $res->provinsi->provinsi }}</td>
                                                    <td>{{ $res->jenis_bantuan }}</td>
                                                    @if(!empty($res->isi_ringkasan))
                                                    <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalProposalKabKot{{$i}}">{{ $res->isi_ringkasan }}</a></td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                    <td class="action-table">
                                                        <a href="{{ url('proposalPermintaan/kabupatenKota/editProposalKabupatenKota/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                        <a href="#" data-uri="{{ url('proposalPermintaan/kabupatenKota/hapusProposalKabupatenKota/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
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
            toastr.success("Proposal BPBD {{ session('alertHapus') }}", "Berhasil Menghapus Data");
        </script>
        @elseif(session('alertEdit'))
        <script>
            toastr.success("Proposal BPBD {{ session('alertEdit') }}", "Berhasil Memperbarui Data");
        </script>
        @elseif(session('alertTambah'))
        <script>
            toastr.success("Proposal BPBD {{ session('alertTambah') }}", "Berhasil Menambah Data");
        </script>
        @endif
@endsection