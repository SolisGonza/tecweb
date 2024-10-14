
<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();

// SE VERIFICA SI SE RECIBIÓ UN TÉRMINO DE BÚSQUEDA
if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    
    // SE CONSTRUYE LA QUERY CON LIKE PARA BÚSQUEDA PARCIAL EN NOMBRE, MARCA O DETALLES
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$searchTerm%' OR marca LIKE '%$searchTerm%' OR detalles LIKE '%$searchTerm%'";
    
    // SE EJECUTA LA QUERY Y SE VERIFICAN RESULTADOS
    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $producto = array();
            foreach ($row as $key => $value) {
                $producto[$key] = utf8_encode($value);
            }
            $data[] = $producto; // SE AGREGA EL PRODUCTO AL ARREGLO
        }
        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
