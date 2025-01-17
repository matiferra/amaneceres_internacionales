<!DOCTYPE html>
<html lang="es">
<head>
    
    <link rel="stylesheet" href="{{ asset('vendor/css/misEstilos.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Login Administrador</title>
</head>

<body class="fondoABM">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 mx-auto">
                   <div class="card my-3">
                        <h5 class="card-header text-center">Login Administrador</h5>
                        <div class="card-body">
                            <form action="{{ route("admin.login") }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="username">Email</label>
                                    <input name="email" type="email" id="username" class="form-control" placeholder="Email" value="admin@admin" autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" id="password" class="form-control" name="password" value="123" placeholder="Contraseña">
                                </div> 
                                <button type="submit" class="btn btn-primary float-right">Login</button>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
    
    @if (count($errors))
        @foreach ($errors->all() as $message)
            {{ $message }}
        @endforeach
    @endif
</body>
</html>

