<form action="{{ route("${route}.register") }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-label" for="name">Nombre</label>
        <input name="name" type="text" id="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}" autofocus>
    </div>
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input name="email" type="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña">
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Repetir Contraseña</label>
        <input type="password" id="password" class="form-control" name="password_confirmation" placeholder="Repetir Contraseña">
    </div>
    <button type="submit" class="btn btn-default float-right">Login</button>
</form>
<div class="blankpage-footer text-center">
    <a href="{{ route("${route}.login") }}"><strong>Ya tengo cuenta</strong></a>
</div>

@if (count($errors))
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
@endif