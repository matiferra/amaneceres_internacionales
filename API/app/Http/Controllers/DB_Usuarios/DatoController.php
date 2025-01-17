<?php

namespace App\Http\Controllers\DB_Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Resources\DatosResource;
use App\Models\Dato;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DatoController extends Controller
{
    
    public function show($id){
        $dato = Dato::where('id_usuario', $id)->first();
        return response()->json( new DatosResource($dato));
    }

     public function store(Request $request)
    {
        Dato::create($request->all());
    }

    public function update(Request $request)
    {
        $dato = Dato::where('id_usuario', $request->input('id_usuario'))->first();
        
        $dato->update($request->all());
    }

    public function destroy($id)
    {
        $dato = Dato::where('id_usuario', $id)->first();
        
        $dato->delete();
    }

}
