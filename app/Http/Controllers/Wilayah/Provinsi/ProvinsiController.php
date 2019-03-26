<?php

namespace App\Http\Controllers\Wilayah\Provinsi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use DB;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$data['provinsis'] = Provinsi::orderby('id')->get();
    	return view('wilayah.provinsi.index')->with($data);
    }
    public function add()
    {
    	return view('wilayah.provinsi.add');
    }
    public function save(Request $r)
    {
        $last = DB::Table('provinsis')->max('id');
        $provinsi = new Provinsi;
        if (!empty($last)) {
            $provinsi->id = $last + 1;
        }
    	$provinsi->provinsi = $r->input('provinsi');
    	$provinsi->save();

    	return redirect(url('provinsi'))->with('alertTambah', $r->input('provinsi'));
    }
    public function edit($id)
    {
    	$data['provinsis'] = Provinsi::find($id);
    	return view('wilayah.provinsi.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
    	$provinsi = Provinsi::find($id);
    	$provinsi->provinsi = $r->input('provinsi');
    	$provinsi->save();

    	return redirect(url('provinsi'))->with('alertEdit', $r->input('provinsi'));
    }
    public function delete($id)
    {
        $alert = Provinsi::where('id', $id)->first();
    	Provinsi::find($id)->delete();
    	return redirect(url('provinsi'))->with('alertHapus', $alert->provinsi);
    }
}
