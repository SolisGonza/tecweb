<?php
  
    use Gonza\P13\Delete\Delete as Delete; 
    require_once __DIR__ . '/../vendor/autoload.php';
    $productos = new Delete('marketzone');
    $productos->delet($_GET['id']);  
    echo $productos->getData(); 
?> 
