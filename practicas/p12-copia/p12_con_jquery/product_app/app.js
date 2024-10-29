// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function () {
    // Inicializa el formulario y lista los productos
    init();
    let edit = false;
    // Función para listar productos usando jQuery y AJAX
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            method: 'GET',
            dataType: 'json',
            success: function (productos) {
                let template = '';

                productos.forEach(function (producto) {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item"> ${producto.nombre} </a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    }

    // Inicializa el formulario y lista los productos
    function init() {
        var jsonString = JSON.stringify(baseJSON, null, 2);
        $('#description').val(jsonString); // Muestra el JSON en el textarea
        listarProductos(); // Lista productos al iniciar
    }

    // Función para buscar productos
    $('#busqueda-form').submit(function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del formulario

        let search = $('#search').val(); // Obtiene el valor del campo de búsqueda

        $.ajax({
            url: './backend/product-search.php',
            method: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function (productos) {
                let template = '';
                let template_bar = '';

                productos.forEach(function (producto) {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</li>`;
                });

                $('#container').html(template_bar); // Actualiza la barra de resultados
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    });
    
    // Función para buscar productos con KEYUP
    $('#search').keyup(function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del formulario

        let search = $('#search').val(); // Obtiene el valor del campo de búsqueda

        $.ajax({
            url: './backend/product-search.php',
            method: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function (productos) {
                let template = '';
                let template_bar = '';

                productos.forEach(function (producto) {
                    
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</li>`;
                });

                $('#container').html(template_bar); // Actualiza la barra de resultados
                $('#product-result').removeClass('d-none').addClass('d-block');
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    });


    // Función para agregar producto
    $('#product-form').submit( function (e) {
        e.preventDefault();    
        let finalJSON = {};
        finalJSON['nombre'] = $('#name').val();
        finalJSON['marca'] = $('#marca').val();
        finalJSON['modelo'] = $('#modelo').val();
        finalJSON['precio'] = $('#precio').val();
        finalJSON['detalles'] = $('#detalles').val();
        finalJSON['unidades'] = $('#unidades').val();
        finalJSON['imagen'] = $('#imagen').val();
        console.log(finalJSON);

        if (!validarJSON(finalJSON)) {
            return; // Sale de la función si la validación falla
        }

        // Enviamos el JSON al servidor
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        console.log(url);
        
        $.ajax({
            url: url,
            method: 'POST',
            data: JSON.stringify(finalJSON),
            contentType: 'application/json;charset=UTF-8',
            success: function (respuesta) {
                // Si la respuesta es una cadena, conviértela en un objeto JSON
                if (typeof respuesta === 'string') {
                    respuesta = JSON.parse(respuesta); // Convierte la cadena JSON en un objeto
                }
                console.log(respuesta); // Verifica la respuesta recibida
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;  
                  
                $('#container').html(template_bar); // Actualiza la barra de resultados
                // Haz visible la barra de estado (si está oculta)
                $('#product-result').removeClass('d-none').addClass('d-block');

                // Recarga la lista de productos
                listarProductos();
            }
        });
    });
    
    
    
    // Función para eliminar producto
    $(document).on('click', '.product-delete', function () {
        if (confirm('De verdad deseas eliminar el Producto?')) {
            let id = $(this).closest('tr').attr('productId');

            $.ajax({
                url: './backend/product-delete.php',
                method: 'GET',
                data: { id: id },
                success: function (respuesta) {
                    // Si la respuesta es una cadena, conviértela en un objeto JSON
                    if (typeof respuesta === 'string') {
                        respuesta = JSON.parse(respuesta); // Convierte la cadena JSON en un objeto
                    }
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    $('#container').html(template_bar); // Actualiza la barra de resultados
                    $('#product-result').removeClass('d-none').addClass('d-block');

                    // Recarga la lista de productos
                    listarProductos();
                }
            });
        }
    });

    // Obtener un producto por ID
    $(document).on('click', '.product-item', (e) => {
        const element = e.currentTarget.closest('tr'); // Encuentra el elemento <tr> más cercano
        const id = $(element).attr('productId'); // Obtiene el productId del atributo
        console.log(id);
        $.post('./backend/product-single.php', { id }, (response) => {
            const producto = JSON.parse(response);
            $('#name').val(producto.nombre); // Cambia 'name' por 'nombre'
            
            // Crea un objeto con solo los campos deseados
            const columnas = {
                precio: producto.precio,
                unidades: producto.unidades,
                modelo: producto.modelo,
                marca: producto.marca,
                imagen: producto.imagen,
                detalles: producto.detalles
            };
            

            $('#description').val(JSON.stringify(columnas, null, 2)); // Muestra el producto en formato JSON
            $('#productId').val(producto.id); // Cambia 'taskId' por 'productId'
            edit = true; // Activa la edición
        });

        e.preventDefault(); // Previene la acción por defecto del enlace
    });

    // Validar los campos al perder el foco
    $('#name, #marca, #modelo, #precio, #detalles, #unidades, #imagen').on('blur', function() {
        // Crear el objeto JSON final dentro de la función de validación
        let finalJSON = {};
        finalJSON['nombre'] = $('#name').val();
        finalJSON['marca'] = $('#marca').val();
        finalJSON['modelo'] = $('#modelo').val();
        finalJSON['precio'] = $('#precio').val();
        finalJSON['detalles'] = $('#detalles').val();
        finalJSON['unidades'] = $('#unidades').val();
        finalJSON['imagen'] = $('#imagen').val();

        // Llamar a la función de validación
        validarJSON(finalJSON);
    });

   // FUNCIÓN DE VALIDACIÓN DEL JSON
    function validarJSON(producto) {
        let errores = []; // Array para almacenar mensajes de error

        // Validar Nombre
        if (!producto.nombre || producto.nombre.trim() === "" || producto.nombre.length > 100) {
            errores.push("El nombre es requerido y debe tener 100 caracteres o menos.");
        }

        // Validar Marca
        if (!producto.marca || producto.marca.trim() === "") {
            errores.push("La marca es requerida y debe seleccionarse de lista.");
        }

        // Validar Modelo
        if (!producto.modelo || producto.modelo.trim() === "" || !/^[a-zA-Z0-9]+$/.test(producto.modelo) || producto.modelo.length > 25) {
            errores.push("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
        }

        // Validar Precio
        if (isNaN(producto.precio) || producto.precio <= 99.99) {
            errores.push("El precio es requerido y debe ser mayor a 99.99.");
        }

        // Validar Detalles
        if (producto.detalles && producto.detalles.length > 250) {
            errores.push("Los detalles deben tener 250 caracteres o menos.");
        }

        // Validar Unidades
        if (isNaN(producto.unidades) || producto.unidades <= 0) {
            errores.push("Las unidades son requeridas y deben ser mayor o igual a 0.");
        }

        // Validar Imagen
        if (!producto.imagen || producto.imagen.trim() === "") {
            producto.imagen = "img/image.png"; // Asignar imagen por defecto
        }

        // Si hay errores, mostrarlos en el contenedor y retornar false
        if (errores.length > 0) {
            let template_bar = errores.map(error => `<li style="list-style: none;">${error}</li>`).join('');
            $('#container').html(template_bar); // Actualiza el contenedor con los mensajes de error
            $('#product-result').removeClass('d-none').addClass('d-block');
            return false;
        }
        // Limpiar el contenedor de errores si no hay
        $('#container').html('');
        $('#product-result').removeClass('d-block').addClass('d-none');
        return true; // Todos los datos son válidos

    }

});
