<title>Bantuan BPBD</title>
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/bpbd.png') }}">
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
    @import url(https://fonts.googleapis.com/css?family=Nunito);
    .table-striped tbody tr:nth-of-type(odd){
        background-color: #fff;
    }
    .swal-button {
      background-color: #3e5569;
      border: 1px solid #CCC;
      padding: 8px 23px;
      text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }
    .swal-button:not([disabled]):hover{
        background-color: #063a89;
    }
    .swal-modal{
        width: auto;
    }
</style>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
<script src="{{ asset('dist/js/waves.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">        
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align: center;">
                                    <div style="margin-bottom: 10px;">
                                        <img src="{{ asset('assets/images/bpbd.png') }}" style="width: 80px;">
                                    </div>
                                    <h4 class="card-title" style="font-family: sans-serif;">Data Bantuan BPBD</h4>
                                </div>
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
                                                    @if($resKabupatenKota->proposalKabupatenKota->id_provinsi == $resProvinsi->proposalProvinsi->id_provinsi && $resProvinsi->loop_data == 0)
                                                    @elseif($resKabupatenKota->proposalKabupatenKota->id_provinsi == $resProvinsi->proposalProvinsi->id_provinsi && $resProvinsi->loop_data == 1 && $resKabupatenKota->loop_data == 0)
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
                                                        @if(!empty($resKabupatenKota->proposalKabupatenKota->isi_ringkasan))
                                                        <td><a href="#" id="open-file{{ $i2 }}" data-toggle="modal" data-target="#ModalBantuanKabKot2-{{$i2}}">{{ $resKabupatenKota->proposalKabupatenKota->isi_ringkasan }}</a></td>
                                                        @else
                                                        <td>-</td>
                                                        @endif
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
            <script src="{{ asset('js/sweetalert.min.js') }}"></script>
            <script>
                swal({
                    buttons: {
                      pdf: {
                        text: "PDF",
                        value: "pdf",
                      },
                      print: {
                        text: "Print",
                        value: "print",
                      },
                    },
                  })
                  .then((value) => {
                    switch (value) {
                      case "pdf":
                        window.location = "{{ url('dataBantuan/dataKeseluruhan/cetakData/PDF') }}";
                        break;
                      case "print":
                        window.print();
                        break;
                    }
                  });
            </script>