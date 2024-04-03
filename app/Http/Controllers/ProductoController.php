<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    

    public function vista()
    {

    	return view("postproductos.appproductos");

    }

}
