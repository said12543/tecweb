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
    $("#search").keyup(function() {
        buscarProducto();
    });
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
                                <button class="product-edit btn btn-warning" onclick="editarProducto()">
                                    Editar
                                </button>
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

function buscarProducto() {
    var search = $("#search").val();
    if(search === '') {
        listarProductos();
        $("#product-result").removeClass("card my-4 d-block");
        $("#container").html('');
        return;
    }
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
                                <button class="product-edit btn btn-warning" onclick="editarProducto()">
                                    Editar
                                </button>
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
            } else {
                $("#product-result").addClass("card my-4 d-block");
                $("#container").html('<li>No se encontraron productos</li>');
                $("#products").html('');
            }
        }
    });
}

function agregarProducto(e) {
    e.preventDefault();
    var productoJsonString = $("#description").val();
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $("#name").val();
    var editingId = $("#product-form").data("editing");
    if(editingId) {
        finalJSON['id'] = editingId;
    }
    productoJsonString = JSON.stringify(finalJSON, null, 2);
    var url = editingId ? './backend/product-edit.php' : './backend/product-add.php';
    $.ajax({
        url: url,
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
            if(respuesta.status === 'success') {
                $("#product-form").removeData("editing");
                $("#name").val('');
                $("#description").val(JSON.stringify(baseJSON, null, 2));
            }
            listarProductos();
        }
    });
}

function editarProducto() {
    var id = $(event.target).closest('tr').attr("productId");
    $.ajax({
        url: './backend/product-take.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            let producto = JSON.parse(response);
            $("#name").val(producto.nombre);
            delete producto.id;
            delete producto.nombre;
            delete producto.eliminado;
            $("#description").val(JSON.stringify(producto, null, 2));
            $("#product-form").data("editing", id);
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