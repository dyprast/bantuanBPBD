<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GIS;
use App\BantuanKabupatenKota;
use App\BantuanProvinsi;
use App\ProposalProvinsi;
use App\ProposalKabupatenKota;
use App\Provinsi;
use App\KabupatenKota;
use App\JenisBantuan;
use App\Tahun;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gis = GIS::all();
        $bantuanData = BantuanKabupatenKota::all()->count() + BantuanProvinsi::all()->count() - 1;
        $data['bantuans'] = $bantuanData;
        $proposalData = ProposalKabupatenKota::all()->count() + ProposalProvinsi::all()->count();
        $data['proposals'] = $proposalData;
        $data['provinsis'] = Provinsi::all();
        $data['kabupatenKotas'] = KabupatenKota::all();
        $data['jenisBantuans'] = JenisBantuan::all();
        $data['users'] = User::all();

        $data['tahunBantuanProvinsis'] = DB::Table('bantuan_provinsis')->select('tahun_perolehan')->groupBy('tahun_perolehan')->limit('8')->orderby('tahun_perolehan', 'DESC')->get();
        $data['jenisBantuanProvinsis'] = DB::Table('bantuan_provinsis')->select('jenis_bantuan')->groupBy('jenis_bantuan')->get();
        $data['bantuanProvinsis'] = BantuanProvinsi::all();
        
        $data['tahunBantuanKabupatenKotas'] = DB::Table('bantuan_kabupaten_kotas')->select('tahun_perolehan')->groupBy('tahun_perolehan')->limit('8')->orderby('tahun_perolehan', 'DESC')->get();
        $data['jenisBantuanKabupatenKotas'] = DB::Table('bantuan_kabupaten_kotas')->select('jenis_bantuan')->groupBy('jenis_bantuan')->get();
        $data['bantuanKabupatenKotas'] = BantuanKabupatenKota::all();

        $data['tahunProposalProvinsis'] = DB::Table('proposal_provinsis')->select('tahun')->groupBy('tahun')->limit('8')->orderby('tahun', 'DESC')->get();
        $data['jenisBantuanProposalProvinsis'] = DB::Table('proposal_provinsis')->select('jenis_bantuan')->groupBy('jenis_bantuan')->get();
        $data['proposalProvinsis'] = ProposalProvinsi::all();
        
        $data['tahunProposalKabupatenKotas'] = DB::Table('proposal_kabupaten_kotas')->select('tahun')->groupBy('tahun')->limit('8')->orderby('tahun', 'DESC')->get();
        $data['jenisBantuanProposalKabupatenKotas'] = DB::Table('proposal_kabupaten_kotas')->select('jenis_bantuan')->groupBy('jenis_bantuan')->get();
        $data['proposalKabupatenKotas'] = ProposalKabupatenKota::all();

        $data['bantuanProvinsisLimit'] = BantuanProvinsi::orderBy('id', 'DESC')->limit(5)->get();
        $data['bantuanKabupatenKotasLimit'] = BantuanKabupatenKota::orderBy('id', 'DESC')->limit(5)->get();
        $data['proposalProvinsisLimit'] = ProposalProvinsi::orderBy('id', 'DESC')->limit(5)->get();
        $data['proposalKabupatenKotasLimit'] = ProposalKabupatenKota::orderBy('id', 'DESC')->limit(5)->get();
        return view('home', compact('gis'))->with($data);
    }
}
