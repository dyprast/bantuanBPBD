<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BantuanKabupatenKota extends Model
{
    public function provinsi()
    {
    	return $this->belongsTo('App\Provinsi', 'id_provinsi');
    }
    public function kabupatenKota()
    {
    	return $this->belongsTo('App\kabupatenKota', 'id_kabupatenKota');
    }
    public function proposalKabupatenKota()
    {
    	return $this->belongsTo('App\ProposalKabupatenKota', 'id_proposalKabupatenKota');
    }
}
