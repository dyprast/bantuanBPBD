<?php

namespace App\Http\Controllers\GIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GISController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
