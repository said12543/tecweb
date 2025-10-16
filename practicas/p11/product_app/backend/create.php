<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        // VERIFICAR SI EL PRODUCTO YA EXISTE (MISMO NOMBRE Y NO ELIMINADO)
        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
        $result = $conexion->query($sql);
        
        if($result->num_rows > 0) {
            // EL PRODUCTO YA EXISTE
            echo json_encode(array(
                'estatus' => 'error',
                'mensaje' => 'El producto ya existe'
            ));
        } else {
            // INSERTAR EL PRODUCTO
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', 
                            {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, 
                            '{$jsonOBJ->imagen}')";
            
            if($conexion->query($sql)) {
                echo json_encode(array(
                    'estatus' => 'success',
                    'mensaje' => 'Producto agregado'
                ));
            } else {
                echo json_encode(array(
                    'estatus' => 'error',
                    'mensaje' => 'Error al insertar'
                ));
            }
        }
        
        $conexion->close();
    }
?>