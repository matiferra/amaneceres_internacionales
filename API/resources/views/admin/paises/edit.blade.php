@extends('layouts.plantillaAdmin')

@section('title', 'Editar Pais')

@section('flechaVolver')
    <div>
        <a href="{{ URL::previous() }}" class="btn btn-warning mb-5"><span class="fa fa-arrow-left fa-3x"> Volver </span></a>
    </div>
@endsection

@section('cuerpo')
    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{ route('paises.update', $pais) }}" enctype="multipart/form-data"   >
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nombre">Nombre del Pais</label><br>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $pais->nombre) }}"  placeholder="Ingrese un nombre" required>
                    <br>
                </div>
        
                <div class="form-group">
                    <label for="capital">Capital</label><br>
                    <input type="text" id="capital" name="capital" value="{{ old('capital', $pais->capital) }}"  placeholder="Ingrese un Capital" required>
                    <br>
                </div>
        
                <div class="form-group">
                    <label for="GMT_UTC">GTM/UTC</label><br>
                    <input type="number" id="GMT_UTC" step="any" name="GMT_UTC" value="{{ old('GMT_UTC', $pais->GMT_UTC) }}"  placeholder="Ingrese zona horaria" required>
                </div>
        
                <div class="form-group">
                    <label for="Latitud">Latitud</label><br>
                    <input type="number" id="latitud" step="any" name="latitud" value="{{ old('latitud', $pais->latitud) }}" required >
                </div>
        
                <div class="form-group">
                    <label for="Latitud">Longuitud</label><br>
                    <input type="number" id="longuitud" step="any" name="longuitud" value="{{ old('longuitud', $pais->longuitud) }}" required >
                </div>

                <div class="form-group">
                    <label for="id_continente">Continente</label>
                    <select name="id_continente">
                @foreach ($continentes as $continente)
                <?php $selected = ($continente->id == $pais->id_continente) ? "selected": ""; ?>
                        <option value="{{ $continente->id }}" $selected> {{ $continente->nombre }}</option> 
                @endforeach
                    </select> <br>

             <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@endsection

