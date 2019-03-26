<?php

namespace App\Http\Controllers\Wilayah\KabupatenKota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\KabupatenKota;
use DB;

class KabupatenKotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$data['kabupatenKotas'] = KabupatenKota::orderby('id_provinsi')->orderby('id', 'DESC')->get();
    	return view('wilayah.kabupatenKota.index')->with($data);
    }
    public function add()
    {
    	$data['provinsis'] = Provinsi::orderby('id')->get();
    	return view('wilayah.kabupatenKota.add')->with($data);
    }
    public function save(Request $r)
    {
        $last = DB::Table('kabupaten_kotas')->where('id_provinsi', $r->input('id_provinsi'))->max('id');
        $kabupatenKota = new KabupatenKota;
        if (!empty($last)) {
            $kabupatenKota->id = sprintf("%'04d", $last+1);
        }
        else{
            $kabupatenKota->id = $r->input('id_provinsi')."".sprintf("%'02d", 1);
        }
    	$kabupatenKota->id_provinsi = $r->input('id_provinsi');
        $kabupatenKota->kabupaten_kota = $r->input('kabupaten_kota');
    	$kabupatenKota->save();

        $alert = Provinsi::where('id', $r->input('id_provinsi'))->first();
    	return redirect(url('kabupatenKota'))->with('alertTambah', $r->input('kabupaten_kota').', '.$alert->provinsi);
    }
    public function edit($id)
    {
    	$data['kabupatenKotas'] = KabupatenKota::find($id);
        $data['provinsis'] = Provinsi::orderby('id')->get();
    	return view('wilayah.kabupatenKota.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
    	$kabupatenKota = KabupatenKota::find($id);
    	$kabupatenKota->id_provinsi = $r->input('id_provinsi');
    	$kabupatenKota->kabupaten_kota = $r->input('kabupaten_kota');
    	$kabupatenKota->save();

        $alert = Provinsi::where('id', $r->input('id_provinsi'))->first();
        return redirect(url('kabupatenKota'))->with('alertEdit', $r->input('kabupaten_kota').', '.$alert->provinsi);
    }
    public function delete($id)
    {   
        $alert = KabupatenKota::where('id', $id)->first();
    	KabupatenKota::find($id)->delete();
        return redirect(url('kabupatenKota'))->with('alertHapus', $alert->kabupaten_kota.', '.$alert->provinsi->provinsi);
    }
}
