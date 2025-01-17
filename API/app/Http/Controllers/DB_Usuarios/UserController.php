<?php

namespace App\Http\Controllers\DB_Usuarios;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::orderBy('id', 'asc')->paginate(5);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
       return view('admin.usuarios.create');
    }

     public function store(Request $request)
    {
        User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'api_token' => Str::random(60),
        ]);

        return redirect()->route('usuarios.index');
    }


    ///NOSE SI LO VOY A USAR
    public function show($id)
    {
        $usuario = User::find($id);
    
        return response()->json(new UsuarioResource($usuario));
    }


    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        
        $usuario->update($request->all());

        return redirect('/admin/usuarios');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->back();
    }
}
