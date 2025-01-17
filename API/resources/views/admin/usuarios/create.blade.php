@extends('layouts.plantillaAdmin')

@section('title', 'Crear Usuario')

@section('flechaVolver')
    <div>
        <a href="{{ URL::previous() }}" class="btn btn-warning mb-5"><span class="fa fa-arrow-left fa-3x"> Volver </span></a>
    </div>
@endsection

@section('cuerpo')
    <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label><br>
            <input type="text" id="nombre" name="nombre" value=""  placeholder="Ingrese un nombre" required>
            <br>
        </div>

        <div class="form-group">
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value=""  placeholder="Ingrese un email" required>
            <br>
        </div>

        <div class="form-group">
            <label for="password">Password</label><br>
            <input type="text" id="password" name="password" value=""  placeholder="Ingrese un password" required>
            <br>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection

