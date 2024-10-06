function validarFormulario() {
    // Validar Nombre
    var nombre = document.getElementById("nombre").value;
    if (nombre.trim() === "" || nombre.length > 100) {
        alert("El nombre es requerido y debe tener 100 caracteres o menos.");
        return false;
    }

    // Validar Marca
    var marca = document.getElementById("marca").value;
    if (marca.trim() === "") {
        alert("La marca es requerida y debe seleccionarse de lista.");
        return false;
    }

    // Validar Modelo
    var modelo = document.getElementById("modelo").value;
    var alfanumerico = /^[a-zA-Z0-9]+$/;
    if (modelo.trim() === "" || !alfanumerico.test(modelo) || modelo.length > 25) {
        alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
        return false;
    }

    // Validar Precio
    var precio = parseFloat(document.getElementById("precio").value);
    if (isNaN(precio) || precio <= 99.99) {
        alert("El precio es requerido y debe ser mayor a 99.99.");
        return false;
    }

    // Validar Detalles
    var detalles = document.getElementById("detalles").value;
    if (detalles.length > 250) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        return false;
    }

    // Validar Unidades
    var unidades = parseInt(document.getElementById("unidades").value);
    if (isNaN(unidades) || unidades < 0) {
        alert("Las unidades son requeridas y deben ser mayor o igual a 0.");
        return false;
    }

    // Validar Imagen
    var imagen = document.getElementById("imagen").value;
    if (imagen.trim() === "") {
        document.getElementById("imagen").value = "img/image.png";
    }
    return true;
}