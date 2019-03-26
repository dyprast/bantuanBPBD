<?php

namespace App\Http\Controllers\Bantuan\KabupatenKota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BantuanKabupatenKota;
use App\BantuanProvinsi;
use App\Provinsi;
use App\KabupatenKota;
use App\ProposalKabupatenKota;
use App\ProvinsiLoop;
use App\Pembentukan;
use App\BastoKabupatenKota;
use PDF;

class BantuanKabupatenKotaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$data['bantuanKabupatenKotas'] = BantuanKabupatenKota::orderby('id', 'DESC')->get();
    	return view('bantuan.kabupatenKota.index')->with($data);
    }
    public function getIdProvinsi(Request $r)
    {
    	$kabupatenKota = ProposalKabupatenKota::where("id_provinsi", $r->id)->select("kabupaten_kota", "id", "jenis_bantuan")->orderby('id', 'DESC')->get();
        return response()->json($kabupatenKota);
    }
    public function getIdProposalKabupatenKota(Request $r)
    {
        $proposalKabupatenKota = ProposalKabupatenKota::where("id", $r->id)->select("tanggal", "nomor","isi_ringkasan", "jenis_bantuan", "id_provinsi", "id_kabupatenKota")->get();
        return response()->json($proposalKabupatenKota);
    }
    public function add()
    {
        $data['pembentukans'] = Pembentukan::orderby('pembentukan')->get();
    	$data['provinsiLoops'] = ProvinsiLoop::orderby('id_provinsi')->get();
    	return view('bantuan.kabupatenKota.add')->with($data);
    }
    public function save(Request $r)
    {
    	$bantuanProvinsi = new BantuanKabupatenKota;
    	$bantuanProvinsi->id_proposalKabupatenKota = $r->input('id_proposalKabupatenKota');

        $check = ProposalKabupatenKota::where('id', $r->input('id_proposalKabupatenKota'))->first();  
        $bantuanProvinsi->id_provinsi = $r->input('id_provinsi');
        $bantuanProvinsi->id_kabupatenKota = $check->id_kabupatenKota;
    	$bantuanProvinsi->tahun_perolehan = $r->input('tahun_perolehan');
    	$bantuanProvinsi->jenis_bantuan = $r->input('jenis_bantuan');
    	$bantuanProvinsi->keterangan = $r->input('keterangan');
    	$bantuanProvinsi->rincian = $r->input('rincian');
    	$bantuanProvinsi->nilai = $r->input('nilai');
    	$bantuanProvinsi->risiko = $r->input('risiko');
    	$bantuanProvinsi->pembentukan = $r->input('pembentukan');

        $check = BantuanProvinsi::where('id_provinsi', $r->input('id_provinsi'))->orderby('id', 'DESC')->first();
        if (!empty($check)) {
            $bantuanProvinsi->loop_data = 0;
            $update = BantuanProvinsi::where('id', $check->id)->update(['loop_data' => 1]);
        }
        else{
            $bantuanProvinsi->loop_data = 1;
        }

    	$bantuanProvinsi->save();
        $alert = ProposalKabupatenKota::where('id', $r->input('id_proposalKabupatenKota'))->first();
    	return redirect(url('dataBantuan/kabupatenKota'))->with('alertTambah', $alert->kabupatenKota->kabupaten_kota.', '.$alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function edit($id)
    {
        $data['pembentukans'] = Pembentukan::orderby('pembentukan')->get();
    	$data['provinsiLoops'] = ProvinsiLoop::orderby('id_provinsi')->get();
    	$data['bantuanKabupatenKotas'] = BantuanKabupatenKota::find($id);
    	return view('bantuan.kabupatenKota.edit')->with($data);
    }
    public function prosesEdit(Request $r,$id)
    {
        $bantuanProvinsiCheck = BantuanKabupatenKota::find($id);
        $id_provinsi = $bantuanProvinsiCheck->id_provinsi;
        $bantuanProvinsiCheck->delete();

    	$bantuanProvinsi = new BantuanKabupatenKota;
        $bantuanProvinsi->id = $id;
        $bantuanProvinsi->id_proposalKabupatenKota = $r->input('id_proposalKabupatenKota');    

        $check = ProposalKabupatenKota::where('id', $r->input('id_proposalKabupatenKota'))->first();  

        $bantuanProvinsi->id_provinsi = $r->input('id_provinsi');
        $bantuanProvinsi->id_kabupatenKota = $check->id_kabupatenKota;
        $bantuanProvinsi->tahun_perolehan = $r->input('tahun_perolehan');
        $bantuanProvinsi->jenis_bantuan = $r->input('jenis_bantuan');
        $bantuanProvinsi->keterangan = $r->input('keterangan');
        $bantuanProvinsi->rincian = $r->input('rincian');
        $bantuanProvinsi->nilai = $r->input('nilai');
        $bantuanProvinsi->risiko = $r->input('risiko');
        $bantuanProvinsi->pembentukan = $r->input('pembentukan');

        $check = BantuanProvinsi::where('id_provinsi', $r->input('id_provinsi'))->orderby('id', 'DESC')->first();
        if (!empty($check)) {
            $bantuanProvinsi->loop_data = 0;
            $update = BantuanProvinsi::where('id', $check->id)->update(['loop_data' => 1]);
        }
        else{
            $bantuanProvinsi->loop_data = 1;
        }

        $bantuanProvinsi->save();
        $alert = BantuanKabupatenKota::where('id', $id)->first();
        return redirect(url('dataBantuan/kabupatenKota'))->with('alertEdit', $alert->kabupatenKota->kabupaten_kota.', '.$alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function delete($id)
    {
        $alert = BantuanKabupatenKota::where('id', $id)->first();
        BantuanKabupatenKota::find($id)->delete();
    	return redirect(url('dataBantuan/kabupatenKota'))->with('alertHapus', $alert->kabupatenKota->kabupaten_kota.', '.$alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }

    public function detailData($id)
    {
        $data['bantuanKabupatenKotas'] = BantuanKabupatenKota::find($id);
        $data['bastoKabupatenKotas'] = BastoKabupatenKota::where('id_bantuanKabupatenKota', $id)->first();
        return view('bantuan.kabupatenKota.detailData')->with($data);
    }

    public function bastoIndex($id_bantuanKabupatenKota)
    {
        $data['bastoKabupatenKotas'] = BastoKabupatenKota::where('id_bantuanKabupatenKota', $id_bantuanKabupatenKota)->first();
        $data['bantuanKabupatenKotas'] = BantuanKabupatenKota::where('id', $id_bantuanKabupatenKota)->first();
        return view('bantuan.kabupatenKota.basto.index')->with($data);
    }
    public function bastoSave(Request $r)
    {
        $BastoKabupatenKota = new BastoKabupatenKota;

        $BastoKabupatenKota->id_bantuanKabupatenKota = $r->input('id_bantuanKabupatenKota');

        $BastoKabupatenKota->nilai_bantuan = $r->input('nilai_bantuan');

        if(!empty($r->input('nomor_basto'))){
            $BastoKabupatenKota->nomor_basto = $r->input('nomor_basto');
        }
        if(!empty($r->input('no_permohonan_hibah'))){
            $BastoKabupatenKota->no_permohonan_hibah = $r->input('no_permohonan_hibah');
        }
        if(!empty($r->input('no_bersedia_menerima_hibah'))){
            $BastoKabupatenKota->no_bersedia_menerima_hibah = $r->input('no_bersedia_menerima_hibah');
        }
        if(!empty($r->input('no_inventarisasi_barang'))){
            $BastoKabupatenKota->no_inventarisasi_barang = $r->input('no_inventarisasi_barang');
        }

        $nomor_basto_file = $r->file('nomor_basto_file');
        if (!empty($nomor_basto_file)) {
            $BastoKabupatenKota->nomor_basto_file = $nomor_basto_file->getClientOriginalName();
            $nomor_basto_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Nomor Basto/'),$nomor_basto_file->getClientOriginalName());  
        }

        $no_permohonan_hibah_file = $r->file('no_permohonan_hibah_file');
        if (!empty($no_permohonan_hibah_file)) {
            $BastoKabupatenKota->no_permohonan_hibah_file = $no_permohonan_hibah_file->getClientOriginalName();
            $no_permohonan_hibah_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Nomor Permohonan Hibah/'),$no_permohonan_hibah_file->getClientOriginalName());
        }

        $no_bersedia_menerima_hibah_file = $r->file('no_bersedia_menerima_hibah_file');
        if(!empty($no_bersedia_menerima_hibah_file)){
            $BastoKabupatenKota->no_bersedia_menerima_hibah_file = $no_bersedia_menerima_hibah_file->getClientOriginalName();
            $no_bersedia_menerima_hibah_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Nomor Bersedia Menerima Hibah/'),$no_bersedia_menerima_hibah_file->getClientOriginalName());
        }

        $no_inventarisasi_barang_file = $r->file('no_inventarisasi_barang_file');
        if(!empty($no_inventarisasi_barang_file)){
            $BastoKabupatenKota->no_inventarisasi_barang_file = $no_inventarisasi_barang_file->getClientOriginalName();
            $no_inventarisasi_barang_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Nomor Inventarisasi Barang/'),$no_inventarisasi_barang_file->getClientOriginalName());
        }

        $bast_hibah = $r->file('bast_hibah');
        if(!empty($bast_hibah)){
            $BastoKabupatenKota->bast_hibah = $bast_hibah->getClientOriginalName();
            $bast_hibah->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/BAST Hibah/'),$bast_hibah->getClientOriginalName());
        }

        $nasah_hibah = $r->file('nasah_hibah');
        if (!empty($nasah_hibah)) {
            $BastoKabupatenKota->nasah_hibah = $nasah_hibah->getClientOriginalName();
            $nasah_hibah->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Nasah Hibah/'),$nasah_hibah->getClientOriginalName());
        }

        $rincian = $r->file('rincian');
        if (!empty($rincian)) {
            $BastoKabupatenKota->rincian = $rincian->getClientOriginalName();
            $rincian->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->input('id_bantuanKabupatenKota').'/Rincian/'),$rincian->getClientOriginalName());
        }

        $BastoKabupatenKota->save();
        return redirect()->back();

    }
    public function Bastoedit(Request $r,$id)
    {
        $BastoKabupatenKota = BastoKabupatenKota::find($id);

        $BastoKabupatenKota->nilai_bantuan = $r->input('nilai_bantuan');

        if(!empty($r->input('nomor_basto'))){
            $BastoKabupatenKota->nomor_basto = $r->input('nomor_basto');
        }
        if(!empty($r->input('no_permohonan_hibah'))){
            $BastoKabupatenKota->no_permohonan_hibah = $r->input('no_permohonan_hibah');
        }
        if(!empty($r->input('no_bersedia_menerima_hibah'))){
            $BastoKabupatenKota->no_bersedia_menerima_hibah = $r->input('no_bersedia_menerima_hibah');
        }
        if(!empty($r->input('no_inventarisasi_barang'))){
            $BastoKabupatenKota->no_inventarisasi_barang = $r->input('no_inventarisasi_barang');
        }

        $nomor_basto_file = $r->file('nomor_basto_file');
        if (!empty($nomor_basto_file)) {
            $BastoKabupatenKota->nomor_basto_file = $nomor_basto_file->getClientOriginalName();
            $nomor_basto_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Basto/'),$nomor_basto_file->getClientOriginalName());  
        }

        $no_permohonan_hibah_file = $r->file('no_permohonan_hibah_file');
        if (!empty($no_permohonan_hibah_file)) {
            $BastoKabupatenKota->no_permohonan_hibah_file = $no_permohonan_hibah_file->getClientOriginalName();
            $no_permohonan_hibah_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Permohonan Hibah/'),$no_permohonan_hibah_file->getClientOriginalName());
        }

        $no_bersedia_menerima_hibah_file = $r->file('no_bersedia_menerima_hibah_file');
        if(!empty($no_bersedia_menerima_hibah_file)){
            $BastoKabupatenKota->no_bersedia_menerima_hibah_file = $no_bersedia_menerima_hibah_file->getClientOriginalName();
            $no_bersedia_menerima_hibah_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Bersedia Menerima Hibah/'),$no_bersedia_menerima_hibah_file->getClientOriginalName());
        }

        $no_inventarisasi_barang_file = $r->file('no_inventarisasi_barang_file');
        if(!empty($no_inventarisasi_barang_file)){
            $BastoKabupatenKota->no_inventarisasi_barang_file = $no_inventarisasi_barang_file->getClientOriginalName();
            $no_inventarisasi_barang_file->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Inventarisasi Barang/'),$no_inventarisasi_barang_file->getClientOriginalName());
        }

        $bast_hibah = $r->file('bast_hibah');
        if(!empty($bast_hibah)){
            $BastoKabupatenKota->bast_hibah = $bast_hibah->getClientOriginalName();
            $bast_hibah->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/BAST Hibah/'),$bast_hibah->getClientOriginalName());
        }

        $nasah_hibah = $r->file('nasah_hibah');
        if (!empty($nasah_hibah)) {
            $BastoKabupatenKota->nasah_hibah = $nasah_hibah->getClientOriginalName();
            $nasah_hibah->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Nasah Hibah/'),$nasah_hibah->getClientOriginalName());
        }

        $rincian = $r->file('rincian');
        if (!empty($rincian)) {
            $BastoKabupatenKota->rincian = $rincian->getClientOriginalName();
            $rincian->move(public_path('UploadedFile/Basto/Kabupaten Kota/'.$BastoKabupatenKota->id_bantuanKabupatenKota.'/Rincian/'),$rincian->getClientOriginalName());
        }

        $BastoKabupatenKota->save();
        return redirect()->back();
    }
    public function BastoDeleteField(Request $r,$id)
    {
        $bastoKabupatenKota =  BastoKabupatenKota::find($id);
        $validasiField = $r->validasiField;
        if ($validasiField == "nomor_basto") {
            if (!empty($bastoKabupatenKota->nomor_basto_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Basto/'.$bastoKabupatenKota->nomor_basto_file))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Basto/'.$bastoKabupatenKota->nomor_basto_file));
            }
            $bastoKabupatenKota->nomor_basto = "";
            $bastoKabupatenKota->nomor_basto_file = "";
        }
        else if ($validasiField == "nomor_permohonan_hibah") {
            if (!empty($bastoKabupatenKota->no_permohonan_hibah_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Permohonan Hibah/'.$bastoKabupatenKota->no_permohonan_hibah_file))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Permohonan Hibah/'.$bastoKabupatenKota->no_permohonan_hibah_file));
            }
            $bastoKabupatenKota->no_permohonan_hibah = "";
            $bastoKabupatenKota->no_permohonan_hibah_file = "";
        }
        else if ($validasiField == "no_bersedia_menerima_hibah") {
            if (!empty($bastoKabupatenKota->no_bersedia_menerima_hibah_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Bersedia Menerima Hibah/'.$bastoKabupatenKota->no_bersedia_menerima_hibah_file))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Bersedia Menerima Hibah/'.$bastoKabupatenKota->no_bersedia_menerima_hibah_file));
            }
            $bastoKabupatenKota->no_bersedia_menerima_hibah = "";
            $bastoKabupatenKota->no_bersedia_menerima_hibah_file = "";
        }
        else if ($validasiField == "bast_hibah") {
            if (!empty($bastoKabupatenKota->bast_hibah) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/BAST Hibah/'.$bastoKabupatenKota->bast_hibah))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/BAST Hibah/'.$bastoKabupatenKota->bast_hibah));
            }
            $bastoKabupatenKota->bast_hibah = "";
        }
        else if ($validasiField == "nasah_hibah") {
            if (!empty($bastoKabupatenKota->nasah_hibah) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nasah Hibah/'.$bastoKabupatenKota->nasah_hibah))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nasah Hibah/'.$bastoKabupatenKota->nasah_hibah));
            }
            $bastoKabupatenKota->nasah_hibah = "";
        }
        else if ($validasiField == "no_inventarisasi_barang") {
            if (!empty($bastoKabupatenKota->no_inventarisasi_barang_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Inventarisasi Barang/'.$bastoKabupatenKota->no_inventarisasi_barang_file))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Nomor Inventarisasi Barang/'.$bastoKabupatenKota->no_inventarisasi_barang_file));
            }
            $bastoKabupatenKota->no_inventarisasi_barang = "";
            $bastoKabupatenKota->no_inventarisasi_barang_file = "";
        }
        else if ($validasiField == "rincian") {
                if (!empty($bastoKabupatenKota->rincian) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Rincian/'.$bastoKabupatenKota->rincian))) {
                unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$bastoKabupatenKota->id_bantuanKabupatenKota.'/Rincian/'.$bastoKabupatenKota->rincian));
            }
            $bastoKabupatenKota->rincian = "";
        }
        $bastoKabupatenKota->save();
        return redirect()->back();
    }

    public function bastoDelete(Request $r,$id)
    {
        $bastoKabKot = BastoKabupatenKota::find($id);
        if (!empty($bastoKabKot->nomor_basto_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Basto/'.$bastoKabKot->nomor_basto_file))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Basto/'.$bastoKabKot->nomor_basto_file));
        }
        if (!empty($bastoKabKot->no_permohonan_hibah_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Permohonan Hibah/'.$bastoKabKot->no_permohonan_hibah_file))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Permohonan Hibah/'.$bastoKabKot->no_permohonan_hibah_file));
        }
        if (!empty($bastoKabKot->no_bersedia_menerima_hibah_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Bersedia Menerima Hibah/'.$bastoKabKot->no_bersedia_menerima_hibah_file))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Bersedia Menerima Hibah/'.$bastoKabKot->no_bersedia_menerima_hibah_file));
        }
        if (!empty($bastoKabKot->no_inventarisasi_barang_file) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Inventarisasi Barang/'.$bastoKabKot->no_inventarisasi_barang_file))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nomor Inventarisasi Barang/'.$bastoKabKot->no_inventarisasi_barang_file));
        }
        if (!empty($bastoKabKot->bast_hibah) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/BAST Hibah/'.$bastoKabKot->bast_hibah))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/BAST Hibah/'.$bastoKabKot->bast_hibah));
        }
        if (!empty($bastoKabKot->nasah_hibah) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nasah Hibah/'.$bastoKabKot->nasah_hibah))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Nasah Hibah/'.$bastoKabKot->nasah_hibah));
        }
        if (!empty($bastoKabKot->rincian) && file_exists(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Rincian/'.$bastoKabKot->rincian))) {
            unlink(public_path('UploadedFile/Basto/Kabupaten Kota/'.$r->validasiFolder.'/Rincian/'.$bastoKabKot->rincian));
        }

        $bastoKabKot->delete();
        return redirect()->back();
    }

    public function dataKeseluruhan()
    {
        $data['bantuanProvinsis'] = BantuanProvinsi::orderby('id_provinsi', 'DESC')->get();
        $data['bantuanKabupatenKotas'] = BantuanKabupatenKota::orderby('id_provinsi', 'DESC')->get();
        $data['rowLoops'] = BantuanKabupatenKota::where('loop_data', 1)->count();
        return view('bantuan.dataKeseluruhan.index')->with($data);
    }

    public function dataKeseluruhanCetakData()
    {
        $data['bantuanProvinsis'] = BantuanProvinsi::orderby('id_provinsi', 'DESC')->get();
        $data['bantuanKabupatenKotas'] = BantuanKabupatenKota::orderby('id_provinsi', 'DESC')->get();
        $data['rowLoops'] = BantuanKabupatenKota::where('loop_data', 1)->count();
        return view('bantuan.dataKeseluruhan.cetak')->with($data);
    }

    public function pdfKeseluruhan()
    {
        $bantuanProvinsis = BantuanProvinsi::orderby('id_provinsi', 'DESC')->get();
        $bantuanKabupatenKotas = BantuanKabupatenKota::orderby('id_provinsi', 'DESC')->get();
        $rowLoops = BantuanKabupatenKota::where('loop_data', 1)->count();
        set_time_limit(300);
        $pdf = PDF::loadView('bantuan.dataKeseluruhan.cetak', compact('bantuanProvinsis', 'bantuanKabupatenKotas', 'rowLoops'))->setPaper('a4', 'landscape');;
        return $pdf->download('Bantuan-BPBD.pdf');
    }
}
