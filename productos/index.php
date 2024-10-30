<?php
require_once __DIR__ . '/funciones.php';
//Manejo de eliminacion de tareas
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarTarea($_GET['id']);
    $mensaje = $count > 0 ? "Cliente eliminada con éxito." : "No se pudo eliminar la tarea.";
}
//Obtencion de todas las tareas
$tareas = obtenerTareas();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="container">
    <h1>Lista de productos</h1>

    <?php if (isset($mensaje)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <a href="nuevo.php" class="button">Agregar Nuevo Producto</a><br>
    <h2>Lista de productos</h2>
    <!-- ... -->
    <table>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Disponible</th>
        <th>Acciones</th>

    </tr>
    <?php foreach ($tareas as $tarea): ?>
    <tr>
        <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
        <td><?php echo htmlspecialchars($tarea['precio']); ?></td>
        <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
        <td><?php echo htmlspecialchars($tarea['categoria']); ?></td>
        <td><?php echo $tarea['completada'] ? 'Sí' : 'No'; ?></td>
        <td class="actions">
            <a href="editar.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
            <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>