<?php

namespace App\Http\Controllers;

use App\Models\Continente;

class ContinenteController extends Controller
{
    public function index(){
        return Continente::all();
    }
}
