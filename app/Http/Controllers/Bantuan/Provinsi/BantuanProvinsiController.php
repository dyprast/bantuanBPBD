<?php

namespace App\Http\Controllers\Bantuan\Provinsi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BantuanProvinsi;
use App\BantuanKabupatenKota;
use App\ProposalProvinsi;
use App\Provinsi;
use App\Tahun;
use App\Pembentukan;
use App\BastoProvinsi;

use Alert;
use Storage;

class BantuanProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIdProposalProvinsi(Request $r)
    {
        $proposalProvinsi = ProposalProvinsi::where("id", $r->id)->select("tanggal", "nomor","isi_ringkasan", "jenis_bantuan", "id_provinsi")->get();
        return response()->json($proposalProvinsi);
    }
    public function index()
    {
    	$data['bantuanProvinsis'] = BantuanProvinsi::orderby('id', 'DESC')->get();
    	return view('bantuan.provinsi.index')->with($data);
    }
    public function add()
    {
        $data['pembentukans'] = Pembentukan::orderby('pembentukan')->get();
        $data['provinsisProposal'] = ProposalProvinsi::orderby('id', 'DESC')->get();
    	return view('bantuan.provinsi.add')->with($data);
    }
    public function save(Request $r)
    {
    	$bantuanProvinsi = new BantuanProvinsi;
    	$bantuanProvinsi->id_proposalProvinsi = $r->input('id_proposalProvinsi');
        $bantuanProvinsi->id_provinsi = $r->input('id_provinsi');
    	$bantuanProvinsi->tahun_perolehan = $r->input('tahun_perolehan');
    	$bantuanProvinsi->jenis_bantuan = $r->input('jenis_bantuan');
    	$bantuanProvinsi->keterangan = $r->input('keterangan');
    	$bantuanProvinsi->rincian = $r->input('rincian');
    	$bantuanProvinsi->nilai = $r->input('nilai');
    	$bantuanProvinsi->risiko = $r->input('risiko');
    	$bantuanProvinsi->pembentukan = $r->input('pembentukan');

        $check = BantuanProvinsi::where('id_provinsi', $r->input('id_provinsi'))->orderby('id', 'DESC')->first();
        if (!empty($check)) {
            $loop_data = $check->loop_data;
            $update = BantuanProvinsi::find($check->id);
            $update->loop_data = 0;
            $update->save();
            $bantuanProvinsi->loop_data = $loop_data;
        }
        else{
            $bantuanProvinsi->loop_data = 1;
        }
            $data = BantuanKabupatenKota::where('id_provinsi', $r->input('id_provinsi'))->update(['loop_data' => 0]);

    	$bantuanProvinsi->save();
        $alert = ProposalProvinsi::where('id', $r->input('id_proposalProvinsi'))->first();
    	return redirect(url('dataBantuan/provinsi'))->with('alertTambahBantuanProvinsi', $alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function edit($id)
    {
        $data['pembentukans'] = Pembentukan::orderby('pembentukan')->get();
    	$data['provinsisProposal'] = ProposalProvinsi::orderby('id_provinsi')->get();
    	$data['bantuanProvinsis'] = BantuanProvinsi::find($id);
    	return view('bantuan.provinsi.edit')->with($data);
    }
    public function prosesEdit(Request $r,$id)
    {
        $bantuanProvinsiCheck = BantuanProvinsi::find($id);
        $id_provinsi = $bantuanProvinsiCheck->id_provinsi;
        if (BantuanProvinsi::where('id_provinsi', $id_provinsi)->count() == 1) {
            BantuanKabupatenKota::where('id_provinsi', $id_provinsi)->update(['loop_data' => 1]);
        }
        $bantuanProvinsiCheck->delete();
        $checkLastData = BantuanProvinsi::where('id_provinsi', $id_provinsi)->orderby('id', 'DESC')->first();
        if (!empty($checkLastData)) {
            $update2 = BantuanProvinsi::find($checkLastData->id);
            $update2->loop_data = 1;
            $update2->save();
        }

        $bantuanProvinsi = new BantuanProvinsi;
        $bantuanProvinsi->id = $id;
        $bantuanProvinsi->id_proposalProvinsi = $r->input('id_proposalProvinsi');
        $bantuanProvinsi->id_provinsi = $r->input('id_provinsi');
        $bantuanProvinsi->tahun_perolehan = $r->input('tahun_perolehan');
        $bantuanProvinsi->jenis_bantuan = $r->input('jenis_bantuan');
        $bantuanProvinsi->keterangan = $r->input('keterangan');
        $bantuanProvinsi->rincian = $r->input('rincian');
        $bantuanProvinsi->nilai = $r->input('nilai');
        $bantuanProvinsi->risiko = $r->input('risiko');
        $bantuanProvinsi->pembentukan = $r->input('pembentukan');

        $check = BantuanProvinsi::where('id_provinsi', $r->input('id_provinsi'))->orderby('id', 'DESC')->first();
        if (!empty($check)) {
            $loop_data = $check->loop_data;
            $update = BantuanProvinsi::find($check->id);
            $update->loop_data = 0;
            $update->save();
            $bantuanProvinsi->loop_data = $loop_data;
        }
        else{
            $bantuanProvinsi->loop_data = 1;
        }
            $data = BantuanKabupatenKota::where('id_provinsi', $r->input('id_provinsi'))->update(['loop_data' => 0]);

        $bantuanProvinsi->save();
        $alert = ProposalProvinsi::where('id', $r->input('id_proposalProvinsi'))->first();
        return redirect(url('dataBantuan/provinsi'))->with('alertEditBantuanProvinsi', $alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function delete($id)
    {
    	$bantuanProvinsiCheck = BantuanProvinsi::find($id);
        $id_provinsi = $bantuanProvinsiCheck->id_provinsi;
        $alert = BantuanProvinsi::where('id', $id)->first();
        if (BantuanProvinsi::where('id_provinsi', $id_provinsi)->count() == 1) {
            BantuanKabupatenKota::where('id_provinsi', $id_provinsi)->update(['loop_data' => 1]);
        }
        $bantuanProvinsiCheck->delete();
        $checkLastData = BantuanProvinsi::where('id_provinsi', $id_provinsi)->orderby('id', 'DESC')->first();
        if (!empty($checkLastData)) {
            $update2 = BantuanProvinsi::find($checkLastData->id);
            $update2->loop_data = 1;
            $update2->save();
        }
    	return redirect(url('dataBantuan/provinsi'))->with('alertHapusBantuanProvinsi', $alert->proposalProvinsi->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }

    public function detailData($id)
    {
        $data['pembentukans'] = Pembentukan::orderby('pembentukan')->get();
        $data['provinsisProposal'] = ProposalProvinsi::orderby('id_provinsi')->get();
        $data['bantuanProvinsis'] = BantuanProvinsi::find($id);
        $data['bastoProvinsis'] = BastoProvinsi::where('id_bantuanProvinsi', $id)->first();
        return view('bantuan.provinsi.detailData')->with($data);
    }

    public function bastoIndex($id_bantuanProvinsi)
    {
        $data['bastoProvinsis'] = BastoProvinsi::where('id_bantuanProvinsi', $id_bantuanProvinsi)->first();
        $data['bantuanProvinsis'] = BantuanProvinsi::where('id', $id_bantuanProvinsi)->first();
        return view('bantuan.provinsi.basto.index')->with($data);
    }
    public function bastoSave(Request $r)
    {
        $BastoProvinsi = new BastoProvinsi;

        $BastoProvinsi->id_bantuanProvinsi = $r->input('id_bantuanProvinsi');
        $provinsi = $r->input('id_provinsi');
        $jenis_bantuan = $r->input('jenis_bantuan');

        $BastoProvinsi->nilai_bantuan = $r->input('nilai_bantuan');

        if(!empty($r->input('nomor_basto'))){
            $BastoProvinsi->nomor_basto = $r->input('nomor_basto');
        }
        if(!empty($r->input('no_permohonan_hibah'))){
            $BastoProvinsi->no_permohonan_hibah = $r->input('no_permohonan_hibah');
        }
        if(!empty($r->input('no_bersedia_menerima_hibah'))){
            $BastoProvinsi->no_bersedia_menerima_hibah = $r->input('no_bersedia_menerima_hibah');
        }
        if(!empty($r->input('no_inventarisasi_barang'))){
            $BastoProvinsi->no_inventarisasi_barang = $r->input('no_inventarisasi_barang');
        }

        $nomor_basto_file = $r->file('nomor_basto_file');
        if (!empty($nomor_basto_file)) {
            $BastoProvinsi->nomor_basto_file = $nomor_basto_file->getClientOriginalName();
            $nomor_basto_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Basto/'),$nomor_basto_file->getClientOriginalName());  
        }

        $no_permohonan_hibah_file = $r->file('no_permohonan_hibah_file');
        if (!empty($no_permohonan_hibah_file)) {
            $BastoProvinsi->no_permohonan_hibah_file = $no_permohonan_hibah_file->getClientOriginalName();
            $no_permohonan_hibah_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Permohonan Hibah/'),$no_permohonan_hibah_file->getClientOriginalName());
        }

        $no_bersedia_menerima_hibah_file = $r->file('no_bersedia_menerima_hibah_file');
        if(!empty($no_bersedia_menerima_hibah_file)){
            $BastoProvinsi->no_bersedia_menerima_hibah_file = $no_bersedia_menerima_hibah_file->getClientOriginalName();
            $no_bersedia_menerima_hibah_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Bersedia Menerima Hibah/'),$no_bersedia_menerima_hibah_file->getClientOriginalName());
        }

        $no_inventarisasi_barang_file = $r->file('no_inventarisasi_barang_file');
        if(!empty($no_inventarisasi_barang_file)){
            $BastoProvinsi->no_inventarisasi_barang_file = $no_inventarisasi_barang_file->getClientOriginalName();
            $no_inventarisasi_barang_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Inventarisasi Barang/'),$no_inventarisasi_barang_file->getClientOriginalName());
        }

        $bast_hibah = $r->file('bast_hibah');
        if(!empty($bast_hibah)){
            $BastoProvinsi->bast_hibah = $bast_hibah->getClientOriginalName();
            $bast_hibah->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/BAST Hibah/'),$bast_hibah->getClientOriginalName());
        }

        $nasah_hibah = $r->file('nasah_hibah');
        if (!empty($nasah_hibah)) {
            $BastoProvinsi->nasah_hibah = $nasah_hibah->getClientOriginalName();
            $nasah_hibah->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nasah Hibah/'),$nasah_hibah->getClientOriginalName());
        }

        $rincian = $r->file('rincian');
        if (!empty($rincian)) {
            $BastoProvinsi->rincian = $rincian->getClientOriginalName();
            $rincian->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Rincian/'),$rincian->getClientOriginalName());
        }

        $BastoProvinsi->save();
        return redirect()->back();

    }
    public function Bastoedit(Request $r,$id)
    {
        $BastoProvinsi = BastoProvinsi::find($id);

        $BastoProvinsi->id_bantuanProvinsi = $r->input('id_bantuanProvinsi');
        $provinsi = $r->input('id_provinsi');
        $jenis_bantuan = $r->input('jenis_bantuan');

        $BastoProvinsi->nilai_bantuan = $r->input('nilai_bantuan');

        if(!empty($r->input('nomor_basto'))){
            $BastoProvinsi->nomor_basto = $r->input('nomor_basto');
        }
        if(!empty($r->input('no_permohonan_hibah'))){
            $BastoProvinsi->no_permohonan_hibah = $r->input('no_permohonan_hibah');
        }
        if(!empty($r->input('no_bersedia_menerima_hibah'))){
            $BastoProvinsi->no_bersedia_menerima_hibah = $r->input('no_bersedia_menerima_hibah');
        }
        if(!empty($r->input('no_inventarisasi_barang'))){
            $BastoProvinsi->no_inventarisasi_barang = $r->input('no_inventarisasi_barang');
        }

        $nomor_basto_file = $r->file('nomor_basto_file');
        if (!empty($nomor_basto_file)) {
            $BastoProvinsi->nomor_basto_file = $nomor_basto_file->getClientOriginalName();
            $nomor_basto_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Basto/'),$nomor_basto_file->getClientOriginalName());  
        }

        $no_permohonan_hibah_file = $r->file('no_permohonan_hibah_file');
        if (!empty($no_permohonan_hibah_file)) {
            $BastoProvinsi->no_permohonan_hibah_file = $no_permohonan_hibah_file->getClientOriginalName();
            $no_permohonan_hibah_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Permohonan Hibah/'),$no_permohonan_hibah_file->getClientOriginalName());
        }

        $no_bersedia_menerima_hibah_file = $r->file('no_bersedia_menerima_hibah_file');
        if(!empty($no_bersedia_menerima_hibah_file)){
            $BastoProvinsi->no_bersedia_menerima_hibah_file = $no_bersedia_menerima_hibah_file->getClientOriginalName();
            $no_bersedia_menerima_hibah_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Bersedia Menerima Hibah/'),$no_bersedia_menerima_hibah_file->getClientOriginalName());
        }

        $no_inventarisasi_barang_file = $r->file('no_inventarisasi_barang_file');
        if(!empty($no_inventarisasi_barang_file)){
            $BastoProvinsi->no_inventarisasi_barang_file = $no_inventarisasi_barang_file->getClientOriginalName();
            $no_inventarisasi_barang_file->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nomor Inventarisasi Barang/'),$no_inventarisasi_barang_file->getClientOriginalName());
        }

        $bast_hibah = $r->file('bast_hibah');
        if(!empty($bast_hibah)){
            $BastoProvinsi->bast_hibah = $bast_hibah->getClientOriginalName();
            $bast_hibah->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/BAST Hibah/'),$bast_hibah->getClientOriginalName());
        }

        $nasah_hibah = $r->file('nasah_hibah');
        if (!empty($nasah_hibah)) {
            $BastoProvinsi->nasah_hibah = $nasah_hibah->getClientOriginalName();
            $nasah_hibah->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Nasah Hibah/'),$nasah_hibah->getClientOriginalName());
        }

        $rincian = $r->file('rincian');
        if (!empty($rincian)) {
            $BastoProvinsi->rincian = $rincian->getClientOriginalName();
            $rincian->move(public_path('UploadedFile/Basto/Provinsi/'.$r->input('id_bantuanProvinsi').'/Rincian/'),$rincian->getClientOriginalName());
        }

        $BastoProvinsi->save();
        return redirect()->back();
    }
    public function BastoDeleteField(Request $r,$id)
    {
        $bastoProvinsi =  BastoProvinsi::find($id);
        $validasiField = $r->validasiField;
        if ($validasiField == "nomor_basto") {
            if (!empty($bastoProvinsi->nomor_basto_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Basto/'.$bastoProvinsi->nomor_basto_file))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Basto/'.$bastoProvinsi->nomor_basto_file));
            }
            $bastoProvinsi->nomor_basto = "";
            $bastoProvinsi->nomor_basto_file = "";
        }
        else if ($validasiField == "nomor_permohonan_hibah") {
            if (!empty($bastoProvinsi->no_permohonan_hibah_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Permohonan Hibah/'.$bastoProvinsi->no_permohonan_hibah_file))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Permohonan Hibah/'.$bastoProvinsi->no_permohonan_hibah_file));
            }
            $bastoProvinsi->no_permohonan_hibah = "";
            $bastoProvinsi->no_permohonan_hibah_file = "";
        }
        else if ($validasiField == "no_bersedia_menerima_hibah") {
            if (!empty($bastoProvinsi->no_bersedia_menerima_hibah_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Bersedia Menerima Hibah/'.$bastoProvinsi->no_bersedia_menerima_hibah_file))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Bersedia Menerima Hibah/'.$bastoProvinsi->no_bersedia_menerima_hibah_file));
            }
            $bastoProvinsi->no_bersedia_menerima_hibah = "";
            $bastoProvinsi->no_bersedia_menerima_hibah_file = "";
        }
        else if ($validasiField == "bast_hibah") {
            if (!empty($bastoProvinsi->bast_hibah) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/BAST Hibah/'.$bastoProvinsi->bast_hibah))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/BAST Hibah/'.$bastoProvinsi->bast_hibah));
            }
            $bastoProvinsi->bast_hibah = "";
        }
        else if ($validasiField == "nasah_hibah") {
            if (!empty($bastoProvinsi->nasah_hibah) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nasah Hibah/'.$bastoProvinsi->nasah_hibah))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nasah Hibah/'.$bastoProvinsi->nasah_hibah));
            }
            $bastoProvinsi->nasah_hibah = "";
        }
        else if ($validasiField == "no_inventarisasi_barang") {
            if (!empty($bastoProvinsi->no_inventarisasi_barang_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Inventarisasi Barang/'.$bastoProvinsi->no_inventarisasi_barang_file))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Nomor Inventarisasi Barang/'.$bastoProvinsi->no_inventarisasi_barang_file));
            }
            $bastoProvinsi->no_inventarisasi_barang = "";
            $bastoProvinsi->no_inventarisasi_barang_file = "";
        }
        else if ($validasiField == "rincian") {
                if (!empty($bastoProvinsi->rincian) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Rincian/'.$bastoProvinsi->rincian))) {
                unlink(public_path('UploadedFile/Basto/Provinsi/'.$bastoProvinsi->id_bantuanProvinsi.'/Rincian/'.$bastoProvinsi->rincian));
            }
            $bastoProvinsi->rincian = "";
        }
        $bastoProvinsi->save();
        return redirect()->back();
    }

    public function bastoDelete(Request $r,$id)
    {
        $bastoProv = BastoProvinsi::find($id);
        if (!empty($bastoProv->nomor_basto_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Basto/'.$bastoProv->nomor_basto_file))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Basto/'.$bastoProv->nomor_basto_file));
        }
        if (!empty($bastoProv->no_permohonan_hibah_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Permohonan Hibah/'.$bastoProv->no_permohonan_hibah_file))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Permohonan Hibah/'.$bastoProv->no_permohonan_hibah_file));
        }
        if (!empty($bastoProv->no_bersedia_menerima_hibah_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Bersedia Menerima Hibah/'.$bastoProv->no_bersedia_menerima_hibah_file))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Bersedia Menerima Hibah/'.$bastoProv->no_bersedia_menerima_hibah_file));
        }
        if (!empty($bastoProv->no_inventarisasi_barang_file) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Inventarisasi Barang/'.$bastoProv->no_inventarisasi_barang_file))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nomor Inventarisasi Barang/'.$bastoProv->no_inventarisasi_barang_file));
        }
        if (!empty($bastoProv->bast_hibah) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/BAST Hibah/'.$bastoProv->bast_hibah))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/BAST Hibah/'.$bastoProv->bast_hibah));
        }
        if (!empty($bastoProv->nasah_hibah) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nasah Hibah/'.$bastoProv->nasah_hibah))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Nasah Hibah/'.$bastoProv->nasah_hibah));
        }
        if (!empty($bastoProv->rincian) && file_exists(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Rincian/'.$bastoProv->rincian))) {
            unlink(public_path('UploadedFile/Basto/Provinsi/'.$r->validasiFolder.'/Rincian/'.$bastoProv->rincian));
        }

        $bastoProv->delete();
        return redirect()->back();
    }
}
