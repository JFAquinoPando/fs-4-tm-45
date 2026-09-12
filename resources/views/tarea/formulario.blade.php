<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route("guardar") }}" method="post">
        @csrf
        <div>
            <input name="descripcion" autocomplete="off" type="text" placeholder="Descripción de actividad"
            required>
        </div>
        <div>
            <label for="prioridad">prioridad</label>
            <input name="prioridad" id="prioridad" type="checkbox">
        </div>
        <div>
            <label for="realizado">realizado</label>
            <input name="realizado" id="realizado" type="checkbox">
        </div>
        <button>Guardar</button>
    </form>
</body>

</html>