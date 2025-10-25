var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $("#description").val(JsonString);
    listarProductos();
    $("#search").on("keyup", buscarProducto);
}

function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let productos = JSON.parse(response);
            if(Object.keys(productos).length > 0) {
                let template = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $("#products").html(template);
            }
        }
    });
}

function buscarProducto(e) {
    e.preventDefault();
    var search = $("#search").val();
    $.ajax({
        url: './backend/product-search.php',
        type: 'GET',
        data: { search: search },
        success: function(response) {
            let productos = JSON.parse(response);
            if(Object.keys(productos).length > 0) {
                let template = '';
                let template_bar = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</il>`;
                });
                $("#product-result").addClass("card my-4 d-block");
                $("#container").html(template_bar);
                $("#products").html(template);
            }
        }
    });
}

function agregarProducto(e) {
    e.preventDefault();
    var productoJsonString = $("#description").val();
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $("#name").val();
    productoJsonString = JSON.stringify(finalJSON, null, 2);
    $.ajax({
        url: './backend/product-add.php',
        type: 'POST',
        contentType: 'application/json;charset=UTF-8',
        data: productoJsonString,
        success: function(response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
            $("#product-result").addClass("card my-4 d-block");
            $("#container").html(template_bar);
            listarProductos();
        }
    });
}

function eliminarProducto() {
    if(confirm("De verdad deseas eliminar el Producto")) {
        var id = $(event.target).closest('tr').attr("productId");
        $.ajax({
            url: './backend/product-delete.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#product-result").addClass("card my-4 d-block");
                $("#container").html(template_bar);
                listarProductos();
            }
        });
    }
}