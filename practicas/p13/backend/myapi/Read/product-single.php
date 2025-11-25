<?php
namespace MyApi\Read;

    use MyApi\Products;
    require_once __DIR__ . '/../../vendor/autoload.php';

    $productos = new Products('marketzone', 'root', '');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>