<?php
/*
// product-search-name.php
include_once __DIR__.'/database.php';

$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'] ?? '';

if (empty($nombre)) {
    echo json_encode(['error' => 'Nombre no proporcionado']);
    exit;
}

$result = mysqli_query($conexion, "SELECT COUNT(*) FROM productos WHERE nombre = '$nombre'");
$exists = $result ? mysqli_fetch_array($result)[0] > 0 : false;

echo json_encode(['exists' => $exists]);
*/
namespace product_app\backend;
use product_app\backend\myapi\Products;
require_once __DIR__ . '/myapi/Products.php';
$productos = new Products('localhost', 'root', '1001', 'marketzone');
$productos->singleByName($_GET['nombre']);  
echo $productos->getData();  


?>
