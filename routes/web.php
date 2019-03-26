<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('home'));
});

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('provinsi')->group(function(){
	Route::get('/', 'Wilayah\Provinsi\ProvinsiController@index');
	Route::get('/tambahProvinsi', 'Wilayah\Provinsi\ProvinsiController@add');
	Route::post('/prosesTambahProvinsi', 'Wilayah\Provinsi\ProvinsiController@save')->name('simpanProvinsi');
	Route::get('/editProvinsi/{id}', 'Wilayah\Provinsi\ProvinsiController@edit');
	Route::post('/prosesEditProvinsi/{id}', 'Wilayah\Provinsi\ProvinsiController@prosesEdit');
	Route::get('/hapusProvinsi/{id}', 'Wilayah\Provinsi\ProvinsiController@delete');
});

Route::prefix('kabupatenKota')->group(function(){
	Route::get('/', 'Wilayah\KabupatenKota\KabupatenKotaController@index');
	Route::get('/tambahKabupatenKota', 'Wilayah\KabupatenKota\KabupatenKotaController@add');
	Route::post('/prosesTambahKabupatenKota', 'Wilayah\KabupatenKota\KabupatenKotaController@save')->name('simpanKabupatenKota');
	Route::get('/editKabupatenKota/{id}', 'Wilayah\KabupatenKota\KabupatenKotaController@edit');
	Route::post('/prosesEditKabupatenKota/{id}', 'Wilayah\KabupatenKota\KabupatenKotaController@prosesEdit');
	Route::get('/hapusKabupatenKota/{id}', 'Wilayah\KabupatenKota\KabupatenKotaController@delete');
});

Route::prefix('jenisBantuan')->group(function(){
	Route::get('/', 'Wilayah\JenisBantuan\JenisBantuanController@index');
	Route::get('/tambahJenisBantuan', 'Wilayah\JenisBantuan\JenisBantuanController@add');
	Route::post('/prosesTambahJenisBantuan', 'Wilayah\JenisBantuan\JenisBantuanController@save')->name('simpanJenisBantuan');
	Route::get('/editJenisBantuan/{id}', 'Wilayah\JenisBantuan\JenisBantuanController@edit');
	Route::post('/prosesEditJenisBantuan/{id}', 'Wilayah\JenisBantuan\JenisBantuanController@prosesEdit');
	Route::get('/hapusJenisBantuan/{id}', 'Wilayah\JenisBantuan\JenisBantuanController@delete');
});

Route::prefix('pembentukanBPBD')->group(function(){
	Route::get('/', 'Pembentukan\PembentukanController@index');
	Route::get('/tambahPembentukanBPBD', 'Pembentukan\PembentukanController@add');
	Route::post('/prosesTambahPembentukanBPBD', 'Pembentukan\PembentukanController@save')->name('simpanPembentukanBPBD');
	Route::get('/editPembentukanBPBD/{id}', 'Pembentukan\PembentukanController@edit');
	Route::post('/prosesEditPembentukanBPBD/{id}', 'Pembentukan\PembentukanController@prosesEdit');
	Route::get('/hapusPembentukanBPBD/{id}', 'Pembentukan\PembentukanController@delete');
});

Route::prefix('manajemenPengguna')->group(function(){
	Route::get('/', 'ManajemenPengguna\Pengguna\PenggunaController@index');
	Route::get('/tambahPengguna', 'ManajemenPengguna\Pengguna\PenggunaController@add');
	Route::post('/prosesTambahPengguna', 'ManajemenPengguna\Pengguna\PenggunaController@save')->name('simpanPengguna');
	Route::get('/editPengguna/{id}', 'ManajemenPengguna\Pengguna\PenggunaController@edit');
	Route::post('/prosesEditPengguna/{id}', 'ManajemenPengguna\Pengguna\PenggunaController@prosesEdit');
	Route::get('/hapusPengguna/{id}', 'ManajemenPengguna\Pengguna\PenggunaController@delete');
});

Route::prefix('proposalPermintaan')->group(function(){

	Route::get('/getIdProvinsi', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@getIdProvinsi');
	Route::get('/dataKeseluruhan', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@dataKeseluruhan');
	Route::get('/cetakDataKeseluruhan', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@cetakDataKeseluruhan');
	Route::get('/cetakDataKeseluruhan/PDF', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@cetakPDF');
	Route::prefix('provinsi')->group(function(){
		Route::get('/', 'Proposal\ProposalProvinsi\ProposalProvinsiController@index');
		Route::get('/tambahProposalProvinsi', 'Proposal\ProposalProvinsi\ProposalProvinsiController@add');
		Route::post('/prosesTambahProposalProvinsi', 'Proposal\ProposalProvinsi\ProposalProvinsiController@save')->name('simpanProposalProvinsi');
		Route::get('/editProposalProvinsi/{id}', 'Proposal\ProposalProvinsi\ProposalProvinsiController@edit');
		Route::post('/prosesEditProposalProvinsi/{id}', 'Proposal\ProposalProvinsi\ProposalProvinsiController@prosesEdit');
		Route::get('/hapusProposalProvinsi/{id}', 'Proposal\ProposalProvinsi\ProposalProvinsiController@delete');
	});

	Route::prefix('kabupatenKota')->group(function(){
		Route::get('/', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@index');
		Route::get('/tambahProposalKabupatenKota', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@add');
		Route::post('/prosesTambahProposalKabupatenKota', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@save')->name('simpanProposalKabupatenKota');
		Route::get('/editProposalKabupatenKota/{id}', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@edit');
		Route::post('/prosesEditProposalKabupatenKota/{id}', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@prosesEdit');
		Route::get('/hapusProposalKabupatenKota/{id}', 'Proposal\ProposalKabupatenKota\ProposalKabupatenKotaController@delete');
	});

});

Route::prefix('dataBantuan')->group(function(){
	
	Route::prefix('/provinsi')->group(function(){
		Route::get('/', 'Bantuan\Provinsi\BantuanProvinsiController@index');
		Route::get('/getIdProposalProvinsi', 'Bantuan\Provinsi\BantuanProvinsiController@getIdProposalProvinsi');
		Route::get('/tambahBantuanProvinsi', 'Bantuan\Provinsi\BantuanProvinsiController@add');
		Route::post('/prosesTambahBantuanProvinsi', 'Bantuan\Provinsi\BantuanProvinsiController@save')->name('simpanBantuanProvinsi');
		Route::get('/editBantuanProvinsi/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@edit');
		Route::post('/prosesEditBantuanProvinsi/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@prosesEdit');
		Route::get('/hapusBantuanProvinsi/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@delete');
		Route::get('/detailData/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@detailData');

		Route::prefix('/basto')->group(function(){
			Route::get('/{id_bantuanProvinsi}', 'Bantuan\Provinsi\BantuanProvinsiController@bastoIndex');
			Route::post('/simpanBasto', 'Bantuan\Provinsi\BantuanProvinsiController@Bastosave')->name('simpanBantuanProvinsiBasto');
			Route::post('/editBasto/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@Bastoedit');
			Route::get('/deleteField/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@BastoDeleteField');
			Route::get('/hapusBasto/{id}', 'Bantuan\Provinsi\BantuanProvinsiController@bastoDelete');
		});
	});

	Route::prefix('/kabupatenKota')->group(function(){
		Route::get('/', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@index');
		Route::get('/getIdProvinsi', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@getIdProvinsi');
		Route::get('/getIdProposalKabupatenKota', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@getIdProposalKabupatenKota');
		Route::get('/tambahBantuanKabupatenKota', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@add');
		Route::post('/prosesTambahBantuanKabupatenKota', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@save')->name('simpanBantuanKabupatenKota');
		Route::get('/editBantuanKabupatenKota/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@edit');
		Route::post('/prosesEditBantuanKabupatenKota/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@prosesEdit');
		Route::get('/hapusBantuanKabupatenKota/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@delete');
		Route::get('/detailData/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@detailData');
		Route::prefix('/basto')->group(function(){
			Route::get('/{id_bantuanKabupatenKota}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@bastoIndex');
			Route::post('/simpanBasto', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@Bastosave')->name('simpanBantuanKabupatenKotaBasto');
			Route::post('/editBasto/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@Bastoedit');
			Route::get('/deleteField/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@BastoDeleteField');
			Route::get('/hapusBasto/{id}', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@bastoDelete');
		});
	});

	Route::prefix('/dataKeseluruhan')->group(function(){
		Route::get('/', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@dataKeseluruhan');
		Route::get('/cetakData', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@dataKeseluruhanCetakData');
		Route::get('/cetakData/PDF', 'Bantuan\KabupatenKota\BantuanKabupatenKotaController@pdfKeseluruhan');
	});

});








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
