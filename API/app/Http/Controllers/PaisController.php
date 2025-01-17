<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Continente;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaisController extends Controller
{

    public function index()
    {
        $continentes = Continente::all();
        $paises = Pais::orderBy('id_continente', 'asc')->paginate(5);
        return view('admin.paises.index', compact('paises', 'continentes'));
    }

    public function create()
    {
        $continentes = Continente::all();

        return view('admin.paises.create', compact('continentes'));
    }

     public function store(Request $request)
    {
        Pais::create($request->all());

        return redirect()->route('admin.paises.index');
    }


    public function edit(Pais $pais)
    {
        $continentes = Continente::all();
        return view('admin.paises.edit', compact('pais', 'continentes'));
    }

    public function update(Request $request, $id)
    {
        $pais = Pais::find($id);
        
        $pais->update($request->all());

        return redirect('/admin/paises');
    }

    public function destroy(Pais $pais)
    {
        $pais->delete();

        return redirect()->back();
    }
}
