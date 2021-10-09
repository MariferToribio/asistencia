<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Personas</title>
</head>
<body>
    <h1>Listado Personas</h1>
    <a href="{{ route('persona.create') }}">Agregar persona</a>

    <table border="1">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Código</th>
                <th>Correo</th>
                <th>Teléfono</th>
            </tr>
        </thead>

        <tbody>
                    <!--Objeto     Variable temporal-->
            @foreach($personas as $registro)
                <tr>
                    <td>
                        {{ $registro->user->name }} 
                    </td>
                    <td>
                        <a href="{{ route('persona.show', $registro->id) }}">    
                            {{ $registro->id }}
                        </a>
                    </td>
                    <td>{{ $registro->nombre }}</td>
                    <td>{{ $registro->apellido_paterno }}</td>
                    <td>{{ $registro->apellido_materno }}</td>
                    <td>{{ $registro->identificador }}</td>
                    <td>{{ $registro->correo }}</td>
                    <td>{{ $registro->telefono }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>