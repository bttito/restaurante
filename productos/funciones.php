<?php
require_once __DIR__ . '/../config/database.php';
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}
function crearTarea($nombre, $precio, $descripcion  , $categoria) {
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'curso' => sanitizeInput($nombre),
        'curso' => sanitizeInput($precio),
        'descripcion' => sanitizeInput($descripcion),
        'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        'completada' => false
    ]);
    return $resultado->getInsertedId();
}
function obtenerTareas() {
    global $tasksCollection;
    return $tasksCollection->find();
}
function obtenerTareaPorId($id) {
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}
function actualizarTarea($id, $curso, $descripcion, $fechaEntrega, $completada) {
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'curso' => sanitizeInput($curso),
            'descripcion' => sanitizeInput($descripcion),
            'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            'completada' => $completada
        ]]
    );
    return $resultado->getModifiedCount();
}
function eliminarTarea($id) {
    global $tasksCollection;
    $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}
