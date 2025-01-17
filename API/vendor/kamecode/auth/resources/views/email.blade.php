<form action="{{ route("${route}.password.email") }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-label" for="username">Email</label>
        <input name="email" type="email" id="username" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
    </div>
    <button type="submit" class="btn btn-default float-right">Enviar link</button>
</form>
</div>
<div class="blankpage-footer text-center">
<a href="{{ route("${route}.login") }}"><strong>Volver al login</strong></a>
</div>

@if (count($errors))
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
@endif