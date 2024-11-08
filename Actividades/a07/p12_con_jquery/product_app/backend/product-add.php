<?php
    
    use product_app\backend\myapi\Products;
    require_once __DIR__ . '/myapi/Products.php';
    $productos = new Products('localhost', 'root', '1001', 'marketzone');
    $productos->add(file_get_contents('php://input')); 
    echo $productos->getData();  
    
?>