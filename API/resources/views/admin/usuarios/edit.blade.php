@extends('layouts.plantillaAdmin')

@section('title', 'Editar Usuario')

@section('flechaVolver')
    <div>
        <a href="{{ URL::previous() }}" class="btn btn-warning mb-5"><span class="fa fa-arrow-left fa-3x"> Volver </span></a>
    </div>
@endsection

@section('cuerpo')
    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{ route('usuarios.update', $usuario) }}" enctype="multipart/form-data"   >
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->name) }}"  placeholder="Ingrese un nombre" required>
                    <br>
                </div>
        

                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email" value="{{ old('nombre', $usuario->email) }}"  placeholder="Ingrese un email" required>
                    <br>
                </div>
        
                <div class="form-group">
                    <label for="token">Token</label><br>
                    <input type="text" id="token" name="token" value="{{ old('api_token', $usuario->api_token) }}"  placeholder="Ingrese un token" required>
                    <br>
                </div>

             <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@endsection

