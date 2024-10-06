
<?php
// Verificar si el formulario fue enviado y si el ID está presente
if (isset($_POST['id'])) {
    // Crear conexión a la base de datos
    @$link = new mysqli('localhost', 'root', '1001', 'marketzone');

    // Chequea conexión
    if ($link === false) {
        die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }


    // Obtener los datos del formulario
    $id = (int)$_POST['id'];  
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = $_POST['imagen'];
    
    // Ejecutar la actualización del registro
    $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', detalles='$detalles', unidades='$unidades', imagen='$imagen' WHERE id=$id";
    
    if (mysqli_query($link, $sql)) {
        echo "Registro actualizado con éxito.";
    } else {
        echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
    }
    
    
    // Cierra la conexión
    mysqli_close($link);
} else {
    echo "No se recibió el ID del producto.";
}
?>

