@extends('layouts.plantillaAdmin')

@section('title', 'Crear Pais')

@section('flechaVolver')
    <div>
        <a href="{{ URL::previous() }}" class="btn btn-warning mb-5"><span class="fa fa-arrow-left fa-3x"> Volver </span></a>
    </div>
@endsection

@section('cuerpo')
    <form method="POST" action="{{ route('paises.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del Pais</label><br>
            <input type="text" id="nombre" name="nombre" value=""  placeholder="Ingrese un nombre" required>
            <br>
        </div>

        <div class="form-group">
            <label for="capital">Capital</label><br>
            <input type="text" id="capital" name="capital" value=""  placeholder="Ingrese un Capital" required>
            <br>
        </div>

        <div class="form-group">
            <label for="GMT_UTC">GTM/UTC</label><br>
            <input type="number" id="GMT_UTC" step="any" name="GMT_UTC" value=""  placeholder="Ingrese zona horaria" required>
        </div>

        <div class="form-group">
            <label for="Latitud">Latitud</label><br>
            <input type="number" id="latitud" step="any" name="latitud" value=""  placeholder="Ingrese latitud" required>
        </div>

        <div class="form-group">
            <label for="Latitud">Longuitud</label><br>
            <input type="number" id="longuitud" step="any" name="longuitud" value=""  placeholder="Ingrese longuitud" required>
        </div>

        <div class="form-group">
            <label for="id_continente">Continente</label>
            <select name="id_continente">
        @foreach ($continentes as $continente)
                <option value="{{ $continente->id }}"> {{ $continente->nombre }}</option> 
        @endforeach
            </select> <br>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection

