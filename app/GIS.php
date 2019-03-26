<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GIS extends Model
{
    protected $table = "g_i_s";
    public function kabupatenKota()
    {
    	return $this->belongsTo('App\kabupatenKota', 'id_kabupatenKota');
    }
}
