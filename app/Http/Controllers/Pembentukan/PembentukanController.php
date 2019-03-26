<?php

namespace App\Http\Controllers\Pembentukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pembentukan;

class PembentukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$data['pembentukans'] = Pembentukan::orderby('id', 'DESC')->get();
    	return view('pembentukan.index')->with($data);
    }
    public function add()
    {
    	return view('pembentukan.add');
    }
    public function save(Request $r)
    {
    	$pembentukan = new Pembentukan;
    	$pembentukan->pembentukan = $r->input('pembentukan');
    	$pembentukan->save();

    	return redirect(url('pembentukanBPBD'))->with('alertTambah', $r->input('pembentukan'));
    }
    public function edit($id)
    {
    	$data['pembentukans'] = Pembentukan::find($id);
    	return view('pembentukan.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
    	$pembentukan = Pembentukan::find($id);
    	$pembentukan->pembentukan = $r->input('pembentukan');
    	$pembentukan->save();

    	return redirect(url('pembentukanBPBD'))->with('alertEdit', $r->input('pembentukan'));
    }
    public function delete($id)
    {
        $alert = Pembentukan::where('id', $id)->first();
    	Pembentukan::find($id)->delete();
    	return redirect(url('pembentukanBPBD'))->with('alertHapus', $alert->pembentukan);
    }
} 
