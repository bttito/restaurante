<?php
require_once __DIR__ . '/../config/database.php';
//Esta funcion limpia los datos ingresados por el usuario
function sanitizeInput($input){
    return htmlspecialchars(strip_tags(trim($input)));
}
//Formatear fechas
function formatDate($date){
   return $date->toDateTime()->format('y-m-d');
}
//Funcion para crear una tarea
function crearTarea($nombre , $correo , $telefono , $direccion){
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'correo' => sanitizeInput($correo),
        'telefono' => sanitizeInput($telefono),
        'direccion' => sanitizeInput($direccion)
    ]);
   return $resultado->getInsertedId();
}
//Funcion para oobtener todas las tareas
function obtenerTareas(){
  global $tasksCollection;
  return $tasksCollection->find();
}
//Funcion para obtener una tarea especifica
function obtenerTareaPorId($id){
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

//funcion para actulizar una tarea
function actualizarTarea($id ,$nombre, $correo , $telefono , $direccion){
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'correo' => sanitizeInput($correo),
            'telefono' => sanitizeInput($telefono),
            'direccion' => sanitizeInput($direccion)
        ]]
    );
    return $resultado->getModifiedCount();

}
//Funcion para eliminar una tarea
function eliminarTarea($id){
   global $tasksCollection;
   $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
   return $resultado->getDeletedCount();
}
?>









