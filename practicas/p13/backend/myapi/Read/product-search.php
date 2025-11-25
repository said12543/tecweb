<?php
namespace MyApi\Read;

    use MyApi\Products;
    require_once __DIR__ . '/../../vendor/autoload.php';

    $productos = new Products('marketzone', 'root', '');
    $productos->search( $_GET['search'] );
    echo $productos->getData();
?>