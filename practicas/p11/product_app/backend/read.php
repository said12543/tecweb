<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['search']) ) {
        $search = $_POST['search'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->$query = ("SELECT * FROM productos WHERE nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%'")){
            // SE OBTIENEN LOS RESULTADOS
			while($row = $result->fetch_array(MYSQLI_ASSOC));{
// SE CODIFICAN A UTF-8 LOS DATOS
                $product = array();
                foreach($row as $key => $value) {
                    $product[$key] = utf8_encode($value);
                }
                $data[] = $product;
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