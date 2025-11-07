$(document).ready(function(){
    let edit = false;

    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
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
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    // OBJETO PARA LOS ESTADOS DE VALIDACIONES
    let validationStatus = {
        nombre: false,
        precio: false,
        unidades: false,
        modelo: false,
        marca: false,
        detalles: true,
        imagen: true
    };

    // FUNCIÓN PARA MOSTRAR MENSAJES DE VALIDACIÓN
    function showValidation(fieldId, message, isValid) {
        // Mostrar en la barra de estado
        $('#product-result').show();
        
        if (isValid) {
            $('#container').html('<li style="list-style: none;">' + message + '</li>');
        } else {
            $('#container').html('<li style="list-style: none;">' + message + '</li>');
        }
    }

    // VALIDACIÓN 1: NOMBRE (requerido, máximo 100 caracteres)
    $('#nombre').on('blur keyup', function() {
        const nombre = $(this).val().trim();
        
        if (nombre === '') {
            showValidation('nombre', 'El nombre es requerido', false);
            validationStatus.nombre = false;
            return;
        }
        
        if (nombre.length > 100) {
            showValidation('nombre', 'El nombre debe tener 100 caracteres o menos', false);
            validationStatus.nombre = false;
            return;
        }
        
        showValidation('nombre', 'Nombre válido', true);
        validationStatus.nombre = true;
    });

    // VALIDACIÓN 2: MARCA (requerida, debe seleccionarse)
    $('#marca').on('change blur keyup', function() {
        const marca = $(this).val();
        
        if (marca === '' || marca === null) {
            showValidation('marca', 'Debe seleccionar una marca', false);
            validationStatus.marca = false;
            return;
        }
        
        showValidation('marca', 'Marca válida', true);
        validationStatus.marca = true;
    });

    // VALIDACIÓN 3: MODELO (requerido, alfanumérico, máximo 25 caracteres)
    $('#modelo').on('blur keyup', function() {
        const modelo = $(this).val().trim();
        const alfanumerico = /^[a-zA-Z0-9\s\-]+$/;
        if (modelo === '') {
            showValidation('modelo', 'El modelo es requerido', false);
            validationStatus.modelo = false;
            return;
        }
        if (!alfanumerico.test(modelo)) {
            showValidation('modelo', 'El modelo debe ser alfanumérico', false);
            validationStatus.modelo = false;
            return;
        }
        if (modelo.length > 25) {
            showValidation('modelo', 'El modelo debe tener 25 caracteres o menos', false);
            validationStatus.modelo = false;
            return;
        }        

        showValidation('modelo', 'Modelo válido', true);
        validationStatus.modelo = true;
    });

    // VALIDACIÓN 4: PRECIO (requerido, mayor a 99.99)
    $('#precio').on('blur keyup', function() {
        const precio = parseFloat($(this).val());
        
        if (isNaN(precio) || $(this).val().trim() === '') {
            showValidation('precio', 'El precio es requerido', false);
            validationStatus.precio = false;
            return;
        }
        if (precio <= 99.99) {
            showValidation('precio', 'El precio debe ser mayor a 99.99', false);
            validationStatus.precio = false;
            return;
        }
        
        showValidation('precio', 'Precio válido', true);
        validationStatus.precio = true;
    });

    // VALIDACIÓN 5: DETALLES (opcional, máximo 250 caracteres)
    $('#detalles').on('blur keyup', function() {
        const detalles = $(this).val();
        
        if (detalles.length > 250) {
            showValidation('detalles', 'Los detalles deben tener 250 caracteres o menos', false);
            validationStatus.detalles = false;
            return;
        }
        if (detalles.length > 0) {
            showValidation('detalles', 'Detalles válidos (' + detalles.length + '/250)', true);
        } else {
            $('#detalles-validation').text('');
            $('#detalles').removeClass('is-invalid is-valid');
        }
        validationStatus.detalles = true;
    });

    // VALIDACIÓN 6: UNIDADES (requeridas, mayor o igual a 0)
    $('#unidades').on('blur keyup', function() {
        const unidades = parseInt($(this).val());
        
        if (isNaN(unidades) || $(this).val().trim() === '') {
            showValidation('unidades', 'Las unidades son requeridas', false);
            validationStatus.unidades = false;
            return;
        }
        if (unidades < 0) {
            showValidation('unidades', 'Las unidades deben ser mayor o igual a 0', false);
            validationStatus.unidades = false;
            return;
        }
        
        showValidation('unidades', 'Unidades válidas', true);
        validationStatus.unidades = true;
    });


    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        if (!validationStatus.nombre || !validationStatus.precio || 
            !validationStatus.unidades || !validationStatus.modelo || 
            !validationStatus.marca || !validationStatus.detalles) {
            
            $('#product-result').show();
            $('#container').html('<li style="list-style: none; color: red;">✗ Por favor, completa correctamente todos los campos requeridos</li>');
            return;
        }

        let postData = {
            nombre: $('#nombre').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val() || 'NA',
            imagen: $('#imagen').val() || 'img/default.png',
            id: $('#productId').val()
        };
        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#product-form')[0].reset();
            $('#nombre').val('');
            $('#precio').val('');
            $('#unidades').val('1');
            $('#modelo').val('');
            $('#marca').val('');
            $('#detalles').val('');
            $('#imagen').val('img/default.png');
            $('#productId').val('');       
            
            validationStatus = {
                nombre: false,
                precio: false,
                unidades: false,
                modelo: false,
                marca: false,
                detalles: true,
                imagen: true
            };

            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);
            $('#nombre').val(product.nombre);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            $('#productId').val(product.id);
            
            edit = true;
        });
        e.preventDefault();
    });    
});