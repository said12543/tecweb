<?php
namespace MyApi\Update;

    use MyApi\Products;
    require_once __DIR__ . '/../../vendor/autoload.php';

    $productos = new Products('marketzone', 'root', '');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>