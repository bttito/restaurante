<?php
require_once __DIR__ . '/funciones.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearTarea($_POST['nombre'], $_POST['correo'], $_POST['telefono'],$_POST['direccion']);
    if ($id) {
        header("Location: index.php?mensaje=Tarea creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la tarea.";
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/nuevo.css">
</head>
<body>
    <div class="container">
    <h1>Agregar Nuevo cliente</h1>
    <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label>
    <label>Correo: <input type="email" name="correo" required></label>
    <label>Telefono: <input type="text" name="telefono" required></label>
    <label>Direccion: <input type="text" name="direccion" required></label>

    <input type="submit" value="Crear nuevo cliente">
    </form>
    <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>
</html>