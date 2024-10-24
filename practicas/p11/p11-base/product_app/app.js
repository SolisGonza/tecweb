// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar por término"
function buscarProducto(e) {
    e.preventDefault(); // Evita el envío automático del formulario

    // OBTENER EL TÉRMINO DE BÚSQUEDA
    var searchTerm = document.getElementById('search').value.trim();

    if (searchTerm === "") {
        alert("Por favor, ingresa un término de búsqueda.");
        return;
    }

    // CREAR EL OBJETO XMLHttpRequest
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read2.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4) {
            if (client.status == 200) {
                console.log('[CLIENTE]\n' + client.responseText);
                
                try {
                    // PARSEAR EL RESULTADO JSON
                    let productos = JSON.parse(client.responseText);
                    
                    // VERIFICAR SI HAY PRODUCTOS
                    if (Array.isArray(productos) && productos.length > 0) {
                        let template = '';
                        productos.forEach(producto => {
                            let descripcion = `
                                <li>Precio: ${producto.precio}</li>
                                <li>Unidades: ${producto.unidades}</li>
                                <li>Modelo: ${producto.modelo}</li>
                                <li>Marca: ${producto.marca}</li>
                                <li>Detalles: ${producto.detalles}</li>
                            `;
                            
                            template += `
                                <tr>
                                    <td>${producto.id}</td>
                                    <td>${producto.nombre}</td>
                                    <td><ul>${descripcion}</ul></td>
                                </tr>
                            `;
                        });
                        document.getElementById("productos").innerHTML = template;
                    } else {
                        document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
                    }
                } catch (error) {
                    console.error("Error al parsear la respuesta JSON:", error);
                    document.getElementById("productos").innerHTML = '<tr><td colspan="3">Error al procesar la respuesta del servidor.</td></tr>';
                }
            } else {
                console.error('Error en la solicitud:', client.status);
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">Error en la solicitud al servidor.</td></tr>';
            }
        }
    };
    client.send("searchTerm=" + encodeURIComponent(searchTerm));
}

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search1').value;

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}


// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault(); // Evita el envío automático del formulario

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;

    try {
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        var finalJSON = JSON.parse(productoJsonString);
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        finalJSON['nombre'] = document.getElementById('name').value;

        // Validar los datos antes de enviarlos
        if (!validarJSON(finalJSON)) {
            return; // Si la validación falla, se detiene el envío
        }
        // SE OBTIENE EL STRING DEL JSON FINAL
        productoJsonString = JSON.stringify(finalJSON, null, 2);
        console.log(finalJSON); 
        var client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log(client.responseText);
                var response = JSON.parse(client.responseText);
                // MOSTRAR UN ALERT CON EL MENSAJE DEL SERVIDOR
                window.alert(response.message);
            } else if (client.readyState == 4) {
                console.error('Error al agregar el producto:', client.status, client.responseText);
                window.alert('Ocurrió un error al agregar el producto.'); 
            }
        };
        client.send(productoJsonString);
    } catch (error) {
        alert('El JSON proporcionado es inválido. Asegúrate de que esté en el formato correcto.');
        console.error('Error de parsing JSON:', error);
    }
}

// FUNCIÓN DE VALIDACIÓN DEL JSON
function validarJSON(producto) {
    // Validar Nombre
    if (!producto.nombre || producto.nombre.trim() === "" || producto.nombre.length > 100) {
        alert("El nombre es requerido y debe tener 100 caracteres o menos.");
        return false;
    }

    // Validar Marca
    if (!producto.marca || producto.marca.trim() === "") {
        alert("La marca es requerida y debe seleccionarse de lista.");
        return false;
    }

    // Validar Modelo
    if (!producto.modelo || producto.modelo.trim() === "" || !/^[a-zA-Z0-9]+$/.test(producto.modelo) || producto.modelo.length > 25) {
        alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
        return false;
    }

    // Validar Precio
    if (isNaN(producto.precio) || producto.precio <= 99.99) {
        alert("El precio es requerido y debe ser mayor a 99.99.");
        return false;
    }

    // Validar Detalles
    if (producto.detalles && producto.detalles.length > 250) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        return false;
    }

    // Validar Unidades
    if (isNaN(producto.unidades) || producto.unidades < 0) {
        alert("Las unidades son requeridas y deben ser mayor o igual a 0.");
        return false;
    }

    // Validar Imagen
    if (!producto.imagen || producto.imagen.trim() === "") {
        producto.imagen = "img/image.png"; // Asignar imagen por defecto
    }

    return true; // Todos los datos son válidos
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}
