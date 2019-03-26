<?php

namespace App\Http\Controllers\Proposal\ProposalKabupatenKota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\ProposalKabupatenKota;
use App\ProposalProvinsi;
use App\KabupatenKota;
use App\Tahun;
use App\JenisBantuan;
use App\ProvinsiLoop;
use PDF;

class ProposalKabupatenKotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIdProvinsi(Request $r)
    {
        $kabupatenKota = KabupatenKota::where("id_provinsi", $r->id_provinsi)->orderby('id')->select("kabupaten_kota","id")->get();
        return response()->json($kabupatenKota);
    }
    public function index()
    {
        $data['proposals'] = ProposalKabupatenKota::orderby('id', 'DESC')->get();
        return view('proposal.proposalKabupatenKota.index')->with($data);
    }
    public function add()
    {
        $data['jenisBantuans'] = JenisBantuan::all();
        $data['provinsis'] = Provinsi::orderby('id')->get();
        return view('proposal.proposalKabupatenKota.add')->with($data);
    }
    public function save(Request $r)
    {
        $proposal = new ProposalKabupatenKota;
        $proposal->id_provinsi = $r->input('id_provinsi');

        $check_kabKot = KabupatenKota::where('id', $r->input('id_kabupatenKota'))->first();

        $proposal->id_kabupatenKota = $r->input('id_kabupatenKota');
        $proposal->kabupaten_kota =  $check_kabKot->kabupaten_kota;
        $proposal->jenis_bantuan = $r->input('jenis_bantuan');
        $proposal->nomor = $r->input('nomor');

        $isi_ringkasan = $r->file('isi_ringkasan');
        if (!empty($isi_ringkasan)) {
            $proposal->isi_ringkasan = $isi_ringkasan->getClientOriginalName();
            $isi_ringkasan->move(public_path('UploadedFile/Proposal/'.$r->input('id_provinsi').'/'.$r->input('id_kabupatenKota').'/'.$r->input('jenis_bantuan').'/'),$isi_ringkasan->getClientOriginalName());
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
        $prov = ProvinsiLoop::where('id_provinsi', $r->input('id_provinsi'))->count();
        if ($prov == 0) {
            $check_provv = Provinsi::where('id', $r->input('id_provinsi'))->first();
            $provinsiLoop = new ProvinsiLoop;
            $provinsiLoop->id_provinsi = $r->input('id_provinsi');
            $provinsiLoop->provinsi = $check_provv->provinsi;
            $provinsiLoop->save();
        }
        $nama_provinsi = ProposalKabupatenKota::where('id_provinsi', $r->input('id_provinsi'))->first()->provinsi->provinsi;
        $nama_kabkot = $check_kabKot->kabupaten_kota;
        return redirect(url('proposalPermintaan/kabupatenKota'))->with('alertTambah', $nama_kabkot.', '.$nama_provinsi.' ('.$r->input('jenis_bantuan').')');
    }
    public function edit($id)
    {
        $data['jenisBantuans'] = JenisBantuan::all();
        $data['proposalsKabKot'] = ProposalKabupatenKota::find($id);
        $data['provinsis'] = Provinsi::orderby('id')->get();
        return view('proposal.proposalKabupatenKota.edit')->with($data);
    }
    public function prosesEdit(Request $r, $id)
    {
        $proposal = ProposalKabupatenKota::find($id);
        $dataTahun = ProposalKabupatenKota::where('id', $id)->first()->tahun;
        $before = ProposalKabupatenKota::where('id', $id)->first();        

        $proposal->id_provinsi = $before->id_provinsi;

        $check_kabKot = KabupatenKota::where('id', $before->id_kabupatenKota)->first();

        $proposal->id_kabupatenKota = $before->id_kabupatenKota;
        $proposal->kabupaten_kota =  $check_kabKot->kabupaten_kota;
        
        $proposal->jenis_bantuan = $before->jenis_bantuan;
        $proposal->nomor = $r->input('nomor');

        $checkFile = ProposalKabupatenKota::where('isi_ringkasan', $before->isi_ringkasan)->count();
        $isi_ringkasan = $r->file('isi_ringkasan');
        if (!empty($isi_ringkasan)) {
            if ($checkFile == 1) {
                if (file_exists(public_path('UploadedFile/Proposal/'.$before->id_provinsi.'/'.$before->id_kabupatenKota.'/'.$before->jenis_bantuan.'/'.$before->isi_ringkasan))) {
                    unlink(public_path('UploadedFile/Proposal/'.$before->id_provinsi.'/'.$before->id_kabupatenKota.'/'.$before->jenis_bantuan.'/'.$before->isi_ringkasan));
                }
            }
            $proposal->isi_ringkasan = $isi_ringkasan->getClientOriginalName();
            $isi_ringkasan->move(public_path('UploadedFile/Proposal/'.$r->input('id_provinsi').'/'.$r->input('id_kabupatenKota').'/'.$r->input('jenis_bantuan').'/'),$isi_ringkasan->getClientOriginalName());
        }
        $tahun = $r->input('tanggal');
        $explode_tahun = explode(' ', $tahun);
        $proposal->tahun = $explode_tahun[2];
        $proposal->tanggal = $r->input('tanggal');

        $proposal->save();

        $check = Tahun::where('tahun', $explode_tahun[2])->count();
        $check2 = ProposalKabupatenKota::where('tahun', $dataTahun)->count();
        $check4 = ProposalProvinsi::where('tahun', $dataTahun)->count();
        $check3 = Tahun::where('tahun', $dataTahun)->count();
        if ($check == 0) {
            $tahun = new Tahun;
            $tahun->tahun = $explode_tahun[2];
            $tahun->save();
        }
        if($check2 == 0 && $check3 != 0 && $check4 == 0){
            Tahun::where('tahun', $dataTahun)->delete();
        }
        $prov = ProvinsiLoop::where('id_provinsi', $r->input('id_provinsi'))->count();
        $prov2 = ProposalKabupatenKota::where('id_provinsi', $r->input('id_provinsi'))->count();
        $prov3 = ProvinsiLoop::where('id_provinsi', $r->input('id_provinsi'))->count();
        if ($prov == 0) {
            $check_provv = Provinsi::where('id', $r->input('id_provinsi'))->first();
            $provinsiLoop = new ProvinsiLoop;
            $provinsiLoop->id_provinsi = $r->input('id_provinsi');
            $provinsiLoop->provinsi = $check_provv->provinsi;
            $provinsiLoop->save();
        }
        if($prov2 == 0 && $prov3 != 0){
            ProvinsiLoop::where('id_provinsi', $r->input('id_provinsi'))->delete();
        }

        return redirect(url('proposalPermintaan/kabupatenKota'))->with('alertEdit', $before->kabupatenKota->kabupaten_kota.', '.$before->provinsi->provinsi.' ('.$before->jenis_bantuan.')');
    }
    public function delete($id)
    {
        $dataTahun = ProposalKabupatenKota::where('id', $id)->first()->tahun;
        $check2 = ProposalKabupatenKota::where('tahun', $dataTahun)->count();
        $check3 = ProposalProvinsi::where('tahun', $dataTahun)->count();
        if ($check2 == 1 && $check3 == 0) {
            Tahun::where('tahun', $dataTahun)->delete();
        }
        $id_provinsi = ProposalKabupatenKota::where('id', $id)->first()->id_provinsi;
        $check3 = ProvinsiLoop::where('id_provinsi', $id_provinsi)->count();
        if ($check2 == 1) {
            ProvinsiLoop::where('id_provinsi', $id_provinsi)->delete();
        }
        $dataProposal = ProposalKabupatenKota::where('id', $id)->first();
        $check4 = ProposalKabupatenKota::where('isi_ringkasan', $dataProposal->isi_ringkasan)->count();
        if ($check4 == 1) {
            if (file_exists(public_path('UploadedFile/Proposal/'.$dataProposal->id_provinsi.'/'.$dataProposal->id_kabupatenKota.'/'.$dataProposal->jenis_bantuan.'/'.$dataProposal->isi_ringkasan))) {
                unlink(public_path('UploadedFile/Proposal/'.$dataProposal->id_provinsi.'/'.$dataProposal->id_kabupatenKota.'/'.$dataProposal->jenis_bantuan.'/'.$dataProposal->isi_ringkasan));
            }
        }
        $alert = ProposalKabupatenKota::where('id', $id)->first();
        $proposal = ProposalKabupatenKota::find($id)->delete();
        return redirect(url('proposalPermintaan/kabupatenKota'))->with('alertHapus', $alert->kabupatenKota->kabupaten_kota.', '.$alert->provinsi->provinsi.' ('.$alert->jenis_bantuan.')');
    }
    public function cetakData()
    {
        $data['tahuns'] = Tahun::orderby('tahun')->get();
        $data['proposals'] = ProposalKabupatenKota::orderby('tahun')->get();
        return view('proposal.print')->with($data);
    }
    public function dataKeseluruhan()
    {
        $data['tahuns'] = Tahun::orderby('tahun')->get();
        $data['proposalsKabKot'] = ProposalKabupatenKota::orderby('tahun')->get();
        $data['proposalsProv'] = ProposalProvinsi::orderby('tahun')->get();
        return view('proposal.dataKeseluruhan.index')->with($data);
    }
    public function cetakDataKeseluruhan()
    {
        $data['tahuns'] = Tahun::orderby('tahun')->get();
        $data['proposalsKabKot'] = ProposalKabupatenKota::orderby('tahun')->get();
        $data['proposalsProv'] = ProposalProvinsi::orderby('tahun')->get();
        return view('proposal.dataKeseluruhan.cetak')->with($data);
    }

    public function cetakPDF()
    {
        $tahuns = Tahun::orderby('tahun')->get();
        $proposalsKabKot = ProposalKabupatenKota::orderby('tahun')->get();
        $proposalsProv = ProposalProvinsi::orderby('tahun')->get();
        set_time_limit(300);
        $pdf = PDF::loadView('proposal.dataKeseluruhan.cetak', compact('tahuns', 'proposalsKabKot', 'proposalsProv'))->setPaper('a4', 'landscape');;
        return $pdf->download('Proposal-BPBD.pdf');
    }
}
