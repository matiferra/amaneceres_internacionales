@extends('layouts.plantillaAdmin')

@section('title', 'ABM Usuario')</title>

@section('flechaVolver')
<div class="row  mx-auto mt-3">
    <div class="col-4">
        <a href="{{ route('admin.home') }}" class="btn btn-success mb-5"> Panel Paises </span></a>
    </div>
    <div class="col-4 text-center">
        <p class="text-center text-9x1 mb-4"><b><u>Alta, Baja y Modificaciones <br> de Usuarios</u></b></p>
    </div> 
    <div class="col-4 text-right">
        <a href="{{ route('admin.logout') }}" class="btn btn-danger "> Logout </span></a>
    </div>    
</div>
    
@endsection

@section('cuerpo')

    <table class="table table-bordered striped">
        <thead>
            <tr class='text-white' style="background-color: dodgerblue;">
                <td><b>Nombre</b></td>
                <td><b>Email</b></td>
                <td><b>Token</b></td>
                <td class="text-center"><b>Acciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                <td><b>{{ $usuario->name }}</b></td>
                <td><b>{{ $usuario->email }}</b></td>
                <td><b>{{ $usuario->api_token }}</b></td>
                    <td>
                        <div class="row text-center">
                            <div class="col-md-6">
                                <form action="{{ route('usuarios.edit', $usuario) }}" method="GET">
                                    @csrf
                                <button class="mt-1 btn btn-lg bg-success" style='width:60 px; height:40px' type="submit"><span class="fas fa-pencil-alt"></button>
                                </form> 
                                 
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="mt-1 btn btn-lg bg-danger " style='width:60 px; height:40px' type="submit"><span class="fas fa-trash-alt"></button>
                                </form> 
                            </div>
                            
                        </div>
                           
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $usuarios->links() }}
    <a href="{{ route('usuarios.create') }}" class="btn btn-success"><span class="fa fa-plus"> Agregar Usuario </span></a>

@endsection
