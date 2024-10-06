<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <script src="validate.js"></script>
</head>
<body>
    <h1>Modificar Celular</h1>
    
    <?php
    // Crear conexión a la base de datos
    @$link = new mysqli('localhost', 'root', '1001', 'marketzone');

    // Comprobar la conexión
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    // Obtener el ID del producto de la URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Inicializar la variable para almacenar los datos del producto
    $product = null;

    // Verificar que se recibió un ID válido
    if ($id > 0) {
        // Consulta para obtener los datos del producto
        if ($result = $link->query("SELECT * FROM productos WHERE id = $id AND eliminado = 0")) {
            $product = $result->fetch_array(MYSQLI_ASSOC);
            $result->free();
        }
    }

    // Cerrar la conexión
    $link->close();
    ?>

    <?php if ($product): ?>
        <form action="update_producto.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario();">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <label for="nombre">Nombre del Celular:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?= $product['nombre'] ?>"><br><br>

            <label for="marca">Marca:</label><br>
            <select id="marca" name="marca">
                <option value="">Seleccione una marca</option>
                <option value="Marca A" <?= $product['marca'] === 'Marca A' ? 'selected' : '' ?>>Iphone</option>
                <option value="Marca B" <?= $product['marca'] === 'Marca B' ? 'selected' : '' ?>>One Plus</option>
                <option value="Marca C" <?= $product['marca'] === 'Marca C' ? 'selected' : '' ?>>Pixel</option>
                <option value="Marca D" <?= $product['marca'] === 'Marca D' ? 'selected' : '' ?>>Redmi</option>
            </select><br><br>

            <label for="modelo">Modelo:</label><br>
            <input type="text" id="modelo" name="modelo" value="<?= $product['modelo'] ?>"><br><br>

            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= $product['precio'] ?>"><br><br>

            <label for="detalles">Detalles:</label><br>
            <textarea id="detalles" name="detalles"><?= $product['detalles'] ?></textarea><br><br>

            <label for="unidades">Unidades Disponibles:</label><br>
            <input type="number" id="unidades" name="unidades" min="0" value="<?= $product['unidades'] ?>"><br><br>

            <label for="imagen">Ubicación de la Imagen (Texto):</label><br>
            <input type="text" id="imagen" name="imagen" value="<?= $product['imagen'] ?>"><br><br>

            <input type="submit" value="Guardar Cambios">
        </form>
    <?php else: ?>
        <p>Producto no encontrado.</p>
    <?php endif; ?>
</body>
</html>
