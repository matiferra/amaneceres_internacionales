<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\PaisesResource;
use App\Models\Continente;
use App\Models\Pais;

class PaisController extends Controller
{

    public function index()
    {
        $paises = Pais::with('continente')->get();
        return response()->json(PaisesResource::collection($paises));
    }

    public function show($nombre){
        $pais = Pais::where('nombre', $nombre)->first();
        return response()->json(new PaisesResource($pais));
    }

    public function showXContinente($nombre){
        $continente = Continente::where('nombre', $nombre)->first();
        $paises = Pais::where('id_continente', $continente->id)->get();
        return response()->json(PaisesResource::collection($paises));
    }

}
