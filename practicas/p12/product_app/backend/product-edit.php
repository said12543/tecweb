<?php
include_once __DIR__.'/database.php';
$producto = json_decode(file_get_contents('php://input'));

// Nombre requerido y 100 caracteres o menos
if (!isset($producto->nombre) || empty(trim($producto->nombre))) {
    $response = array('status' => 'error', 'message' => 'El nombre es requerido');
    echo json_encode($response);
    exit;
}
if (strlen($producto->nombre) > 100) {
    $response = array('status' => 'error', 'message' => 'El nombre debe tener 100 caracteres o menos');
    echo json_encode($response);
    exit;
}

// Marca requerida
if (!isset($producto->marca) || empty(trim($producto->marca))) {
    $response = array('status' => 'error', 'message' => 'La marca es requerida');
    echo json_encode($response);
    exit;
}

// Modelo requerido, alfanumérico y 25 caracteres o menos
if (!isset($producto->modelo) || empty(trim($producto->modelo))) {
    $response = array('status' => 'error', 'message' => 'El modelo es requerido');
    echo json_encode($response);
    exit;
}
if (!ctype_alnum($producto->modelo)) {
    $response = array('status' => 'error', 'message' => 'El modelo debe ser alfanumérico');
    echo json_encode($response);
    exit;
}
if (strlen($producto->modelo) > 25) {
    $response = array('status' => 'error', 'message' => 'El modelo debe tener 25 caracteres o menos');
    echo json_encode($response);
    exit;
}

// Precio requerido y mayor a 99.99
if (!isset($producto->precio)) {
    $response = array('status' => 'error', 'message' => 'El precio es requerido');
    echo json_encode($response);
    exit;
}
if ($producto->precio <= 99.99) {
    $response = array('status' => 'error', 'message' => 'El precio debe ser mayor a 99.99');
    echo json_encode($response);
    exit;
}

// Detalles opcionales y 250 caracteres o menos
if (isset($producto->detalles) && strlen($producto->detalles) > 250) {
    $response = array('status' => 'error', 'message' => 'Los detalles deben tener 250 caracteres o menos');
    echo json_encode($response);
    exit;
}

// Unidades requeridas y mayor o igual a 0
if (!isset($producto->unidades)) {
    $response = array('status' => 'error', 'message' => 'Las unidades son requeridas');
    echo json_encode($response);
    exit;
}
if ($producto->unidades < 0) {
    $response = array('status' => 'error', 'message' => 'Las unidades deben ser mayor o igual a 0');
    echo json_encode($response);
    exit;
}

// Actualizar
$sql = "UPDATE productos SET nombre = '{$producto->nombre}', marca = '{$producto->marca}', modelo = '{$producto->modelo}', precio = {$producto->precio}, detalles = '{$producto->detalles}', unidades = {$producto->unidades}, imagen = '{$producto->imagen}' WHERE id = {$producto->id}";

if ($conexion->query($sql)) {
    $response = array('status' => 'success', 'message' => 'Producto actualizado exitosamente');
} else {
    $response = array('status' => 'error', 'message' => 'Error al actualizar el producto en la base de datos');
}

echo json_encode($response);
?>