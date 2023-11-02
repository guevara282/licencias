function validar() {
    var nombre, apellido, correo, usuario, clave, telefono, expresion;
    nombre = document.getElementById("nombre").value;
    apellido = document.getElementById("apellido").value;
    correo = document.getElementById("correo").value;
    usuario = document.getElementById("usuario").value;
    clave = document.getElementById("clave").value;
    telefono = document.getElementById("telefono").value;

    if (nombre === "" || apellido === "" || correo === "" || usuario === "" || clave === "" || telefono === "") {
        alert("Todos los campos son obligatorios");
        return false;
    }
    else if (nombre.length > '20') {
        alert("El nombre es muy largo");
        return false;
    }
    else if (apellido.length > '20') {
        alert("El apellido es muy largo");
        return false;
    }
    else if (correo.length > '20') {
        alert("El correo es muy largo");
        return false;
    }
    else if (usuario.length > '12') {
        alert("El número de documento es muy largo");
        return false;
    }
    else if(isNaN(usuario)){
        alert("El usuario ingresado no es un número");
        return false;
    }
    else if (clave.length > '20') {
        alert("La clave es muy larga");
        return false;
    }
    else if (telefono.length > '10') {
        alert("El teléfono es muy largo");
        return false;
    }
    else if (isNaN(telefono)){
        alert("El teléfono ingresado no es un número");
        return false;
    }
    return true;
}