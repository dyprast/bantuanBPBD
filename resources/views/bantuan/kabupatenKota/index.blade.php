@extends('layouts.app')

@section('content')
		<div class="page-wrapper">
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Data Bantuan Kabupaten / Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Data</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                                    <li class="breadcrumb-item active" aria-current="page">BPBD Kabupaten Kota</li>
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
                                	<h5 class="card-title">Data Bantuan Kabupaten / Kota</h5>
                                	<a href="{{ url('dataBantuan/kabupatenKota/tambahBantuanKabupatenKota') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Tambah Bantuan"><i class="fas fa-plus"></i></a>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
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
                                                <th>Pembentukan BPBD</th>
                                                <th>BASTO</th>
                                                <th>Detail</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                        	@foreach($bantuanKabupatenKotas as $res)

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
                                                    <td>{{ $res->keterangan }}</td>
                                                    <td>{{ $res->jenis_bantuan }}</td>
                                                    <td>{{ $res->nilai }}</td>
                                                    <td>{{ $res->risiko }}</td>
                                                    @if(!empty($res->proposalKabupatenKota->isi_ringkasan))
                                                    <td><a href="#" id="open-file{{ $i }}" data-toggle="modal" data-target="#ModalBantuanKabKot{{$i}}">{{ $res->proposalKabupatenKota->isi_ringkasan }}</a></td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                                    <td>{{ $res->pembentukan }}</td>
                                                    <td style="text-align: center;">
                                                        <a href="{{ url('dataBantuan/kabupatenKota/basto/'.$res->id) }}" class="btn btn-success btn-sm"><i class="fas fa-file-archive"></i></a>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="{{ url('dataBantuan/kabupatenKota/detailData/'.$res->id) }}" class="btn btn-cyan btn-sm"><i class="mdi mdi-cloud-print-outline"></i></a>
                                                    </td>
                                                    <td class="action-table">
                                                        <a href="{{ url('dataBantuan/kabupatenKota/editBantuanKabupatenKota/'.$res->id) }}" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                                        <a href="#" data-uri="{{ url('dataBantuan/kabupatenKota/hapusBantuanKabupatenKota/'.$res->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCModal"><i class="far fa-trash-alt"></i></a>
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
            toastr.success("Bantuan BPBD {{ session('alertHapus') }}", "Berhasil Menghapus Data");
        </script>
        @elseif(session('alertEdit'))
        <script>
            toastr.success("Bantuan BPBD {{ session('alertEdit') }}", "Berhasil Memperbarui Data");
        </script>
        @elseif(session('alertTambah'))
        <script>
            toastr.success("Bantuan BPBD {{ session('alertTambah') }}", "Berhasil Menambah Data");
        </script>
        @endif
@endsection