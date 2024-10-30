<?php
require_once __DIR__ . '/funciones.php';
//Verificacion del ID de la tarea

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
//Obtencion de la tarea
$tarea = obtenerTareaPorId($_GET['id']);

if (!$tarea) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarTarea($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'],$_POST['direccion']);
    if ($count > 0) {
        header("Location: index.php?mensaje=Tarea actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la tarea.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <div class="container">
        <h1>Editar Cliente</h1>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
<form method="POST">
        <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($tarea['nombre']); ?>" required></label>
        <label>Correo: <input type="email" name="correo" value="<?php echo htmlspecialchars($tarea['correo']); ?>" required></label>
        <label>Telefono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($tarea['telefono']); ?>" required></label>
        <label>Direccion: <input type="text" name="direccion" value="<?php echo htmlspecialchars($tarea['direccion']); ?>" required></label>
        <input type="submit" value="Actualizar Cliente">
</form>

<a href="index.php" class="button">Volver a la lista de inventarios</a>

</div>
</body>
</html>
