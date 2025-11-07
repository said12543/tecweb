<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'exists' => false
    );
    
    // SE VERIFICA HABER RECIBIDO EL NOMBRE
    if(isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        
        // SE REALIZA LA QUERY PARA VERIFICAR SI EL NOMBRE YA EXISTE
        if(empty($id)) {
            $sql = "SELECT * FROM prod WHERE nombre = '{$nombre}' AND eliminado = 0";
        } else {
            $sql = "SELECT * FROM prod WHERE nombre = '{$nombre}' AND id != {$id} AND eliminado = 0";
        }
        
        if ($result = $conexion->query($sql)) {
            // SE VERIFICA SI HAY RESULTADOS
            if($result->num_rows > 0) {
                $data['exists'] = true;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>