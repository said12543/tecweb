<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro de productos</title>
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
  </head>

  <body>
    <h1>Registro de Productos</h1>

    <p>A continuación se encuentran los campos requeridos para ingresar un nuevo producto a la base de datos</p>

    <form id="registroProd" action="http://localhost/tecweb/practicas/p10/set_producto_v2.php" method="post">

    <input type="hidden" name="id" id="producto_id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">

    <h2>Información del Producto</h2>

      <fieldset>
        <legend>Información del Producto</legend>

        <ul>
          <li><label for="nombre">Nombre del producto:</label><br>
          <input type="text" name="nombre" id="nombre" maxlength="100" required title="Máximo 100 caracteres" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>"></li>

          <li><label for="marca">Marca:</label><br>
          <select name="marca" id="marca" required>
            <option value="Samsung" <?= (isset($_GET['marca']) && $_GET['marca']=='Samsung')?'selected':'' ?>>Samsung</option>
            <option value="Apple" <?= (isset($_GET['marca']) && $_GET['marca']=='Apple')?'selected':'' ?>>Apple</option>
            <option value="Xiaomi" <?= (isset($_GET['marca']) && $_GET['marca']=='Xiaomi')?'selected':'' ?>>Xiaomi</option>
            <option value="Oppo" <?= (isset($_GET['marca']) && $_GET['marca']=='Oppo')?'selected':'' ?>>Oppo</option>
            <option value="Huawei" <?= (isset($_GET['marca']) && $_GET['marca']=='Huawei')?'selected':'' ?>>Huawei</option>
            <option value="Motorola" <?= (isset($_GET['marca']) && $_GET['marca']=='Motorola')?'selected':'' ?>>Motorola</option>
          </select>
          </li>

          <li><label for="modelo">Modelo:</label><br>
          <input type="text" name="modelo" id="modelo" pattern="[A-Za-z0-9\- ]{1,25}" required title="Maximo 25 caracteres. Letras, numeros o guiones" value="<?= isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : '' ?>"></li>

          <li><label for="precio">Precio:</label><br>
          <input type="number" name="precio" id="precio" min="100" step="0.01" required title="Precio mayor o igual a 100" value="<?= isset($_GET['precio']) ? $_GET['precio'] : '' ?>"></li>          

          <li><label for="detalles">Detalles</label><br>
          <textarea name="detalles" rows="3" cols="19" id="detalles" maxlength="250" placeholder="No más de 250 caracteres de longitud"><?= isset($_GET['detalles']) ? htmlspecialchars($_GET['detalles']) : '' ?></textarea></li>

          <li><label for="unidades">Unidades:</label><br>
          <input type="number" name="unidades" id="unidades" min="0" required title="Las unidades minimas deben ser mayores a 0" value="<?= isset($_GET['unidades']) ? $_GET['unidades'] : '' ?>"></li>          

          <li><label for="imagen">Nombre archivo imagen:</label><br>
          <input type="text" name="imagen" id="imagen" value="<?= isset($_GET['imagen']) ? htmlspecialchars($_GET['imagen']) : 'img_def.png' ?>"></li>          

        </ul>
      </fieldset>

      <p>
        <input type="submit" value="<?= isset($_GET['id']) ? 'Actualizar' : 'Registrar' ?>">
        <input type="reset">
      </p>

    </form>
  </body>
</html>