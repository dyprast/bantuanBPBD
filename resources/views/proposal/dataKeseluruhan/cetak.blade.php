<title>Bantuan BPBD</title>
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/bpbd.png') }}">
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
    @import url(https://fonts.googleapis.com/css?family=Nunito);
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
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
<script src="{{ asset('dist/js/waves.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
            <div class="container-fluid" id="output">
                <div class="row">
                    <div class="col-12">        
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align: center;">
                                    <div style="margin-bottom: 10px;">
                                        <img src="{{ asset('assets/images/bpbd.png') }}" style="width: 80px;">
                                    </div>
                                    <h4 class="card-title" style="font-family: sans-serif;">Data Permintaan Proposal BPBD</h4>
                                </div>
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
                                                                    <embed id="iframe2-{{$i2}}" src="{{ asset('UploadedFile/Proposal') }}/{{ $resKabKot->id_provinsi }}/{{ $resKabKot->id_kabupatenKota }}/{{ $resKabKot->jenis_bantuan }}/{{ $resKabKot->isi_ringkasan }}" style="width: 100%;height: 100%;"></embed>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <tr>
                                                    <td>{{ $resKabKot->tanggal }} / {{ $resKabKot->nomor }}</td>
                                                    <td>BPBD {{ $resKabKot->kabupatenKota->status_wilayah }} {{ $resKabKot->kabupatenKota->kabupaten_kota }}</td>
                                                    <td>{{ $resKabKot->jenis_bantuan }}</td>
                                                    @if(!empty($resKabKot->isi_ringkasan))
                                                    <td><a href="#" id="open-file2-{{ $i2 }}" data-toggle="modal" data-target="#ModalProposalKabKot{{$i2}}">{{ $resKabKot->isi_ringkasan }}</a></td>
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
                        window.location = "{{ url('proposalPermintaan/cetakDataKeseluruhan/PDF') }}";
                        break;
                      case "print":
                        window.print();
                        break;
                    }
                  });
            </script>