<?php
namespace MyApi\Delete;

    use MyApi\Products;
    
    require_once __DIR__ . '/../../vendor/autoload.php';

    $productos = new Products('marketzone', 'root', '');
    $productos->delete( $_POST['id'] );
    echo $productos->getData();
?>