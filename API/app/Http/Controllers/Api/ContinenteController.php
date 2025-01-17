<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ContinentesResource;
use App\Models\Continente;

class ContinenteController extends Controller
{
    public function index(){
        return response()->json(ContinentesResource::collection(Continente::all()));
    }

    public function show($id){
        $continente = Continente::findOrFail($id);
        return response()->json(new ContinentesResource($continente));
    }
}
