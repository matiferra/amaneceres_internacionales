<form action="{{ route("${route}.login") }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-label" for="username">Email</label>
        <input name="email" type="email" id="username" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña">
    </div>
    <div class="form-group text-left">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="remember" id="rememberme" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="rememberme"> Recordarme</label>
        </div>
    </div>
    <button type="submit" class="btn btn-default float-right">Login</button>
</form>
<div class="blankpage-footer text-center">
    <a href="{{ route("${route}.password.update") }}"><strong>Recuperar Contraseña</strong></a>
</div>

@if (count($errors))
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
@endif