<!-- DESIGN AND DEVELOPMENT BY ROMADHAN EDY P - SMKN 10 JAKARTA -->
<!-- GITHUB.COM/DYPRAST -->
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/bpbd.png') }}">
    <title>Bantuan BPBD</title>
    <link href="{{ asset('assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.5.95/css/materialdesignicons.min.css">

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/excanvas.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
    <script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/chart/chart-page-init.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/mask/mask.init.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart/matrix.interface.js') }}"></script>
    <script src="{{ asset('assets/libs/chart/jquery.peity.min.js') }}"></script>
    {{-- <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgH2MnlbTdOXARh7O6E0tnJvCXBxT7cIg&callback=initMap" type="text/javascript"></script> --> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script> --}}
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="{{ url('home') }}">
                        <b class="logo-icon p-l-10">
                            <img src="{{ asset('assets/images/bpbd.png') }}" alt="homepage" class="light-logo" style="width: 25px;" />
                        </b>
                        <span class="logo-text">
                            BANTUAN <b>BPBD</b>
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(!empty(Auth::user()->profile))
                                    <img src="{{ asset('UploadedFile/Profile/') }}/{{ Auth::user()->email }}/{{ Auth::user()->profile }}" alt="Profile" width="30" height="
                                    30" style="border-radius: 50%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-profile.png') }}" alt="Profile" width="30" height="
                                    30" style="border-radius: 50%; object-fit: cover;">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <a href="{{ url('manajemenPengguna') }}" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Manajemen Pengguna</h5> 
                                                        <span class="mail-desc">Data Pengguna Aplikasi</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-cyan btn-circle"><i class="ti-shift-right"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Keluar</h5> 
                                                        <span class="mail-desc">Keluar dari akun</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a id="data-bantuanMenu" class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-archive"></i><span class="hide-menu">Data Bantuan</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ url('dataBantuan/provinsi') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Bantuan BPBD Provinsi </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('dataBantuan/kabupatenKota') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Bantuan BPBD Kab / Kota </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('dataBantuan/dataKeseluruhan') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Data Keseluruhan </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a id="proposal-permintaanMenu" class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-text-outline"></i><span class="hide-menu">Proposal Permintaan</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ url('proposalPermintaan/provinsi') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Proposal BPBD Provinsi </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('proposalPermintaan/kabupatenKota') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Proposal BPBD Kab / Kota </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('proposalPermintaan/dataKeseluruhan') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Data Keseluruhan </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a id="data-fiturMenu" class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-webpack"></i><span class="hide-menu">Data Fitur </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ url('provinsi') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> BPBD Provinsi </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('kabupatenKota') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> BPBD Kabupaten / Kota </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('jenisBantuan') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Jenis Bantuan </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('pembentukanBPBD') }}" class="sidebar-link"><i class="mdi mdi-circle-slice-8"></i><span class="hide-menu"> Pembentukan BPBD </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href={{ url('manajemenPengguna') }} aria-expanded="false"><i class="mdi mdi-account-group"></i><span class="hide-menu">Manajemen Pengguna</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="main-content">
            @yield('content')
        </div>
        <div class="modal fade" id="deleteCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog confirm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="#" id="conf_delete" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script>
        $('#zero_config').DataTable();
        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
        });
        function printProposal()
        {
            w=window.open();
            w.location = "{{ url('proposalPermintaan/cetakDataKeseluruhan') }}";
        }
        function printBantuan()
        {
            w=window.open();
            w.location = "{{ url('dataBantuan/dataKeseluruhan/cetakData') }}";
        }
        $('#deleteCModal').on('show.bs.modal', function(e) {
            $(this).find('#conf_delete').attr('href', $(e.relatedTarget).data('uri'));
        });
    </script>
    <script>
        $(".select2").select2();
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
</body>
</html>
<!-- DESIGN AND DEVELOPMENT BY ROMADHAN EDY P - SMKN 10 JAKARTA -->
<!-- GITHUB.COM/DYPRAST -->