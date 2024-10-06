<?php

$conn = new mysqli('localhost', 'root', '1001', 'marketzone');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen']; // Ahora es un campo de texto
$eliminado = 0;

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($detalles) || empty($unidades) || empty($imagen)) {
    echo "Todos los campos son obligatorios. Por favor, completa el formulario.";
    exit();
}

// Validar si el producto ya existe en la BD (nombre, marca y modelo)
$sql = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "El producto ya existe en la base de datos.";
    exit();
}

// Si el producto no existe, proceder a insertarlo
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

// Ejecutar la inserción
if ($stmt->execute()) {
    // Mostrar un resumen de los datos insertados
    echo "<h2>Producto registrado exitosamente</h2>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Marca:</strong> $marca</p>";
    echo "<p><strong>Modelo:</strong> $modelo</p>";
    echo "<p><strong>Precio:</strong> $precio</p>";
    echo "<p><strong>Detalles:</strong> $detalles</p>";
    echo "<p><strong>Unidades:</strong> $unidades</p>";
    echo "<p><strong>Ubicación de la imagen:</strong> $imagen</p>";
} else {
    echo "Error al insertar el producto: " . $stmt->error;
}

// Cerrar la conexión
$conn->close();
?>
