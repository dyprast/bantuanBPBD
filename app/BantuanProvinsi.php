<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BantuanProvinsi extends Model
{
    public function proposalProvinsi()
    {
    	return $this->belongsTo('App\ProposalProvinsi', 'id_proposalProvinsi');
    }

}
