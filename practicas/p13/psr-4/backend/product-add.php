<?php
    
    require './vendor/autoload.php';
    use \Create;
    $productos = new Create('marketzone');
    $productos->add(file_get_contents('php://input')); 
    echo $productos->getData();  
    
?>