<?php
    
    use Gonza\P13\Create\Create as Create; 
    require_once __DIR__ . '/../vendor/autoload.php';
    $productos = new Create('marketzone');
    $productos->add(file_get_contents('php://input')); 
    echo $productos->getData();  
    
?>