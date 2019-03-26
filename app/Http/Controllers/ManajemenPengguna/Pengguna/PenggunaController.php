<?php

namespace App\Http\Controllers\ManajemenPengguna\Pengguna;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Storage;

class PenggunaController extends Controller
{
    public function index()
    {
        $d['users'] = User::orderBy('id', 'DESC')->get();
        return view('manajemenPengguna.pengguna.index', $d);
    }
    public function add()
    {
        return view('manajemenPengguna.pengguna.add');
    }
    public function save(Request $r)
    {
        $r->validate([
            'email' => 'required|unique:users|max:191',
        ]);
        $d = new User;
        $d->name = $r->input('name');
        $d->email = $r->input('email');
        if ($r->input('password') == $r->input('conf_password')) {
            $d->password = Hash::make($r->input('password'));
        }
        else{
            return redirect()->back()->with('alertBack', 'Konfirmasi Password tidak sama!');
        }

        $profile = $r->file('profile');
        $rand = bin2hex(openssl_random_pseudo_bytes(20));
        if (!empty($profile)) {
            $d->profile = $rand;
            $profile->move(public_path('UploadedFile/Profile/'.$r->input('email').'/'),$rand);
        }
        $d->save();
        return redirect(url('manajemenPengguna'))->with('alertTambah', $r->input('name'));
    }
    public function edit($id)
    {
        $d['users'] = User::find($id);
        return view('manajemenPengguna.pengguna.edit', $d);
    }
    public function prosesEdit(Request $r, $id)
    {
        $d = User::find($id);
        
        if (!empty($r->input('password')) && !empty($r->input('conf_password'))) {
            if ($r->input('password') == $r->input('conf_password')) {
                $d->password = Hash::make($r->input('password'));
            }
            else{
                return redirect()->back()->with('alertBack', 'Konfirmasi Password tidak sama!');
            }
        }

        $profile = $r->file('profile');
        $rand = bin2hex(openssl_random_pseudo_bytes(20));
        if (!empty($profile)) {
            if (!empty($d->profile)) {
                if (file_exists(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile))) {
                    unlink(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile));
                }
            }
            $d->profile = $rand;
            $profile->move(public_path('UploadedFile/Profile/'.$r->input('email').'/'),$rand);
        }
        if (!empty($r->input('profile_default'))) {
            if (!empty($d->profile)) {
                if (file_exists(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile))) {
                    unlink(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile));
                    rmdir(public_path('UploadedFile/Profile/'.$d->email));
                }
            }
            $d->profile = "";
        }
        
        $d->name = $r->input('name');
        $d->email = $r->input('email');
        $d->save();
        return redirect(url('manajemenPengguna'))->with('alertEdit', $r->input('name'));
    }
    public function delete($id)
    {
        $d = User::find($id);
        $name = $d->name;
        if (file_exists(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile))) {
            unlink(public_path('UploadedFile/Profile/'.$d->email.'/'.$d->profile));
            rmdir(public_path('UploadedFile/Profile/'.$d->email));
        }
        $d->delete();
        return redirect(url('manajemenPengguna'))->with('alertHapus', $name);
    }
}
