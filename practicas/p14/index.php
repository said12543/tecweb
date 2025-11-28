<?php
require 'vendor/autoload.php';

$app = new Slim\App();

$app->get('/', function ($request, $response, $args){
    $response->write("Hola mundo Slim");
});

$app->get("/hola[/{nombre}]", function($request, $response, $args){ 
    $response->write("Hola, ". $args["nombre"]);
    return $response;
});

$app->post("/pruebapost", function($request, $response, $args){
    $reqPost = $request->getParsedBody();
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];

    $response->write( "Valores ". $val1 ." ".$val2);
    return $response;
});

$app->get("/testjson",function($request, $response, $args){
    $data[0]["nombre"]="Said";
    $data[0]["apellidos"]="Cesar Arce";
    $data[1]["nombre"]="Carlos";
    $data[1]["nombre"]="Duran Velez";
    $response->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response;
});

$app->run();
?>