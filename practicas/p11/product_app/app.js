// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);
            
            // SE VERIFICA SI EL ARREGLO JSON TIENE DATOS
            if(productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                
                productos.forEach(producto => {
                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("search="+search);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    // SE OBTIENE EL STRING DEL JSON FINAL

    var val = validarProducto(finalJSON);

    if(!val.valido){
        window.alert('Error al cargar producto: \n\n' + val.errores.join('\n'));
        return
    }

    productoJsonString = JSON.stringify(finalJSON,null,2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            var respuesta = JSON.parse(client.responseText);
            window.alert(respuesta.message);
        }
    };
    client.send(productoJsonString);
}

function validarProducto(producto) {
    let errores = [];

    // Validar nombre (máximo 100 caracteres)
    if (!producto.nombre || producto.nombre.trim() === '') {
        errores.push('El nombre del producto es requerido');
    } else if (producto.nombre.length > 100) {
        errores.push('El nombre no puede exceder 100 caracteres');
    }

    // Validar marca (debe estar en la lista)
    const marcasPermitidas = ['Samsung', 'Apple', 'Xiaomi', 'Oppo', 'Huawei', 'Motorola'];
    if (!producto.marca || producto.marca.trim() === '') {
        errores.push('La marca es requerida');
    } else if (!marcasPermitidas.includes(producto.marca)) {
        errores.push('La marca seleccionada no es válida');
    }

    // Validar modelo (máximo 25 caracteres alfanuméricos o guiones)
    if (!producto.modelo || producto.modelo.trim() === '') {
        errores.push('El modelo es requerido');
    } else if (producto.modelo.length > 25) {
        errores.push('El modelo no puede exceder 25 caracteres');
    } else if (!/^[A-Za-z0-9\- ]+$/.test(producto.modelo)) {
        errores.push('El modelo solo puede contener letras, números, guiones y espacios');
    }

    // Validar precio (mayor o igual a 100)
    if (producto.precio === undefined || producto.precio === null || producto.precio === '') {
        errores.push('El precio es requerido');
    } else {
        const precio = parseFloat(producto.precio);
        if (isNaN(precio) || precio < 100) {
            errores.push('El precio debe ser mayor o igual a 100');
        }
    }

    // Validar detalles (máximo 250 caracteres)
    if (producto.detalles && producto.detalles.length > 250) {
        errores.push('Los detalles no pueden exceder 250 caracteres');
    }

    // Validar unidades (mayor o igual a 0)
    if (producto.unidades === undefined || producto.unidades === null || producto.unidades === '') {
        errores.push('Las unidades son requeridas');
    } else {
        const unidades = parseInt(producto.unidades);
        if (isNaN(unidades) || unidades < 0) {
            errores.push('Las unidades deben ser mayor o igual a 0');
        }
    }

    // Validar imagen (si no se proporciona usar valor por defecto)
    if (!producto.imagen || producto.imagen.trim() === '') {
        producto.imagen = 'img/default.png';
    }

    return {
        valido: errores.length === 0,
        errores: errores
    };
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