<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    public function provinsi()
    {
    	return $this->belongsTo('App\Provinsi', 'id_provinsi');
    }
}
