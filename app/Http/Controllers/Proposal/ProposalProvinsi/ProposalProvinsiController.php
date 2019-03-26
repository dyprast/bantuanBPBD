<?php

namespace App\Http\Controllers\Proposal\ProposalProvinsi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Provinsi;
use App\ProposalProvinsi;
use App\ProposalKabupatenKota;
use App\KabupatenKota;
use App\Tahun;
use App\JenisBantuan;

class ProposalProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function getIdProvinsi(Request $r)
    {
        $kabupatenKota = KabupatenKota::where("id_provinsi", $r->id_provinsi)->where("status_wilayah", $r->wilayah)->pluck("kabupaten_kota", "id");
        return response()->json($kabupatenKota);
    }
    public function index()
    {
        $data['tahuns'] = Tahun::orderby('tahun')->get();
    	$data['proposals'] = ProposalProvinsi::orderby('id', 'DESC')->get();
    	return view('proposal.proposalProvinsi.index')->with($data);
    }
    public function add()
    {
        $data['jenisBantuans'] = JenisBantuan::all();
    	$data['provinsis'] = Provinsi::orderby('id')->get();
    	return view('proposal.proposalProvinsi.add')->with($data);
    }
    public function save(Request $r)
    {
    	$proposal = new ProposalProvinsi;
        $proposal->id_provinsi = $r->input('id_provinsi');
        $proposal->jenis_bantuan = $r->input('jenis_bantuan');
    	$proposal->nomor = $r->input('nomor');

    	$isi_ringkasan = $r->file('isi_ringkasan');
        if (!empty($isi_ringkasan)) {
            $proposal->isi_ringkasan = $isi_ringkasan->getClientOriginalName();
            $isi_ringkasan->move(public_path('UploadedFile/Proposal/'.$r->input('id_provinsi').'/'.$r->input('jenis_bantuan').'/'),$isi_ringkasan->getClientOriginalName());
        }

        $tahun = $r->input('tanggal');
        $explode_tahun = explode(' ', $tahun);
        $proposal->tahun = $explode_tahun[2];
        $proposal->tanggal = $r->input('tanggal');

    	$proposal->save();

        $check = Tahun::where('tahun', $explode_tahun[2])->count();
        if ($check == 0) {
            $tahun = new Tahun;
            $tahun->tahun = $explode_tahun[2];
            $tahun->save();
        }
        $alert = Provinsi::where('id', $r->input('id_provinsi'))->first();
    	return redirect(url('proposalPermintaan/provinsi'))->with('alertTambah', $alert->provinsi.' ('.$r->input('jenis_bantuan').')');
    }
    public function edit($id)
    {
        $data['jenisBantuans'] = JenisBantuan::all();
    	$data['proposalsProv'] = ProposalProvinsi::find($id);
        $data['provinsis'] = Provinsi::orderby('id')->get();
    	return view('proposal.proposalProvinsi.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
    	$proposal = ProposalProvinsi::find($id);
        $dataTahun = ProposalProvinsi::where('id', $id)->first()->tahun;

        $before = ProposalProvinsi::where('id', $id)->first();
        $proposal->id_provinsi = $before->id_provinsi;
        $proposal->jenis_bantuan = $before->jenis_bantuan;
        $proposal->nomor = $r->input('nomor');

        $checkFile = ProposalProvinsi::where('isi_ringkasan', $before->isi_ringkasan)->count();
        $isi_ringkasan = $r->file('isi_ringkasan');
        if (!empty($isi_ringkasan)) {
            if($checkFile == 1){
                if (file_exists(public_path('UploadedFile/Proposal/'.$before->id_provinsi.'/'.$before->jenis_bantuan.'/'.$before->isi_ringkasan))) {
                    unlink(public_path('UploadedFile/Proposal/'.$before->id_provinsi.'/'.$before->jenis_bantuan.'/'.$before->isi_ringkasan));
                }
            }
            $proposal->isi_ringkasan = $isi_ringkasan->getClientOriginalName();
            $isi_ringkasan->move(public_path('UploadedFile/Proposal/'.$before->id_provinsi.'/'.$before->jenis_bantuan.'/'),$isi_ringkasan->getClientOriginalName());
        }
        $tahun = $r->input('tanggal');
        $explode_tahun = explode(' ', $tahun);
        $proposal->tahun = $explode_tahun[2];
        $proposal->tanggal = $r->input('tanggal');

        $proposal->save();

        $check = Tahun::where('tahun', $explode_tahun[2])->count();
        $check2 = ProposalProvinsi::where('tahun', $dataTahun)->count();
        $check3 = Tahun::where('tahun', $dataTahun)->count();
        $check4 = ProposalKabupatenKota::where('tahun', $dataTahun)->count();
        if ($check == 0) {
            $tahun = new Tahun;
            $tahun->tahun = $explode_tahun[2];
            $tahun->save();
        }
        if($check2 == 0 && $check3 != 0 && $check4 == 0){
            Tahun::where('tahun', $dataTahun)->delete();
        }

        return redirect(url('proposalPermintaan/provinsi'))->with('alertEdit', $before->provinsi->provinsi.' ('.$before->jenis_bantuan.')');
    }
    public function delete($id)
    {
        $dataTahun = ProposalProvinsi::where('id', $id)->first()->tahun;
        $check2 = ProposalProvinsi::where('tahun', $dataTahun)->count();
        $check3 = ProposalKabupatenKota::where('tahun', $dataTahun)->count();
        $dataProposal = ProposalProvinsi::where('id', $id)->first();
        $check4 = ProposalProvinsi::where('isi_ringkasan', $dataProposal->isi_ringkasan)->count();
        if ($check2 == 1 && $check3 == 0) {
            Tahun::where('tahun', $dataTahun)->delete();
        }
        if($check4 == 1){
            if (file_exists(public_path('UploadedFile/Proposal/'.$dataProposal->id_provinsi.'/'.$dataProposal->jenis_bantuan.'/'.$dataProposal->isi_ringkasan))) {
                unlink(public_path('UploadedFile/Proposal/'.$dataProposal->id_provinsi.'/'.$dataProposal->jenis_bantuan.'/'.$dataProposal->isi_ringkasan));
            }
        }
        $alert = ProposalProvinsi::where('id', $id)->first();
        $proposal = ProposalProvinsi::find($id)->delete();
    	return redirect(url('proposalPermintaan/provinsi'))->with('alertHapus', $alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function cetakData()
    {
        $data['tahuns'] = Tahun::orderby('tahun')->get();
        $data['proposals'] = ProposalProvinsi::orderby('tahun')->get();
        return view('proposal.print')->with($data);
    }
}
