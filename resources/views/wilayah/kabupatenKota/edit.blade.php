@extends('layouts.app')

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">BPBD Kabupaten Kota</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">BPBD</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kabupaten Kota</li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Kabupaten Kota</li>
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
                            <form class="form-horizontal" method="POST" action="{{ url('kabupatenKota/prosesEditKabupatenKota/'.$kabupatenKotas->id) }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Edit BPBD Kabupaten / Kota</h4>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select id="provinsi" class="select2 form-control" name="id_provinsi" required>
                                                <option value="">Nama Provinsi</option>
                                                <optgroup label="Provinsi di Indonesia">
                                                    @foreach($provinsis as $res)
                                                    @if($res->provinsi == $kabupatenKotas->provinsi->provinsi)
                                                    <option value="{{ $res->id }}" selected>{{ $res->provinsi }}</option>
                                                    @else
                                                    <option value="{{ $res->id }}">{{ $res->provinsi }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label id="kabupatenKotaLabel" class="col-sm-3 text-right control-label col-form-label">Kabupaten / Kota</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="kabupatenKota" class="form-control" name="kabupaten_kota" placeholder="Nama Kabupaten / Kota" value="{{ $kabupatenKotas->kabupaten_kota }}" required>
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
@endsection