<form action="{{ route("admin.password.update") }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-label" for="username">Email</label>
        <input name="email" type="email" id="username" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="contraseña">
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Confirmar Contraseña</label>
        <input type="password" id="password" class="form-control" name="password_confirmation" placeholder="Password">
    </div>
    <input type="hidden" name="token" value="{{ $token }}">
    <button type="submit" class="btn btn-default float-right">Resetear Contraseña</button>
</form>

@if (count($errors))
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
@endif