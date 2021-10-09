<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulario para {{ isset($persona) ? 'Editar' : 'Crear' }} Persona</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($persona)) <!--variable persona esta seteada-->
        <form action="{{ route('persona.update', $persona) }}" method="POST"> <!--EDITAR-->
        @method('PATCH')
    @else <!--CREAR NUEVO-->
        <form action="{{ route('persona.store') }}" method="POST"> <!--Enviar hacia un ruta-->
    @endif

        @csrf
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" value ="{{ $persona->nombre ?? ''}}">
        <br>
        <label for="apellido_paterno">Apellido Paterno</label><br>
        <input type="text" name="apellido_paterno" id="apellido_paterno" value ="{{ $persona->apellido_paterno ?? ''}}">
        <br>
        <label for="apellido_materno">Apellido Materno</label><br>
        <input type="text" name="apellido_materno" id="apellido_materno" value ="{{ $persona->apellido_materno ?? ''}}">
        <br>
        <label for="identificador">Identificador</label><br>
        <input type="text" name="identificador" id="identificador" value ="{{ $persona->identificador ?? ''}}"> 
        <br>
        <label for="correo">Correo</label><br>
        <input type="text" name="correo" id="correo" value ="{{ $persona->correo ?? ''}}">
        <br>
        <label for="telefono">Teléfono</label><br>
        <input type="text" name="telefono" id="telefono" value ="{{ $persona->telefono ?? ''}}">
        <br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>