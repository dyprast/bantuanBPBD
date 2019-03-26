<?php

namespace App\Http\Controllers\Wilayah\JenisBantuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JenisBantuan;

class JenisBantuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$data['jenisBantuans'] = JenisBantuan::orderby('id', 'DESC')->get();
    	return view('jenisBantuan.index')->with($data);
    }
    public function add()
    {
    	return view('jenisBantuan.add');
    }
    public function save(Request $r)
    {
    	$JK = new JenisBantuan;
    	$JK->jenis_bantuan = $r->input('jenis_bantuan');
    	$JK->save();

    	return redirect(url('jenisBantuan'))->with('alertTambah', $r->input('jenis_bantuan'));
    }
    public function edit($id)
    {
    	$data['jenisBantuans'] = JenisBantuan::find($id);
    	return view('jenisBantuan.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
    	$JK = JenisBantuan::find($id);
    	$JK->jenis_bantuan = $r->input('jenis_bantuan');
    	$JK->save();

    	return redirect(url('jenisBantuan'))->with('alertEdit', $r->input('jenis_bantuan'));
    }
    public function delete($id)
    {
        $alert = JenisBantuan::where('id', $id)->first();
    	JenisBantuan::find($id)->delete();
    	return redirect(url('jenisBantuan'))->with('alertHapus', $alert->jenis_bantuan);
    }
}
