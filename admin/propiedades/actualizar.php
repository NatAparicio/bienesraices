<?php

  require '../../includes/funciones.php';  
  $auth = estaAutenticado();

  if(!$auth) {
    header('Location: /');
  }


  // Validar URL por ID válido
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if(!$id) {
    header('Location: /bienesraices/admin/index.php');
  }

  //Base de datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  // Obtener los datos de la propiedad
  $consulta = "SELECT * FROM propiedades WHERE id = $id";
  $resultado = mysqli_query($db, $consulta);
  $propiedad = mysqli_fetch_assoc($resultado);

  // Consultar para obtener los vendedores
  $consulta = "SELECT * FROM vendedor"; 
  $resultado = mysqli_query($db, $consulta);


  // Arreglo con mensajes de errores
  $errores = [];

  $titulo = $propiedad['titulo'];
  $precio = $propiedad['precio'];
  $descripcion = $propiedad['descripcion'];
  $habitaciones = $propiedad['habitaciones'];
  $wc = $propiedad['wc'];
  $estacionamiento = $propiedad['estacionamiento'];
  $vendedores_id = $propiedad['vendedores_id'];
  $imagenPropiedad = $propiedad['imagen'];


  // Ejecutar el código después de que el usuaqrio evia el formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";

    $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
    $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
    $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
    $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedores_id'] );
    $creado = date('Y/m/d');

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo) {
      $errores[] = "Debes añadir un titulo";
    }

    if(!$precio) {
      $errores[] = "Debes añadir un precio";
    }

    if( strlen ( $descripcion ) < 50 ) {
      $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if(!$habitaciones) {
      $errores[] = "El número de  habitaciones es obligatorio";
    }

    if(!$estacionamiento) {
      $errores[] = "El número de lugares de estacionamiento es obligatorio";
    }

    if(!$vendedores_id) {
      $errores[] = "Elige un vendedor";
    }

    //Validar tamaño de imagen (1 mb máximo)
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida) {
      $errores[] = 'La imagen es muy pesada (Max 1mb)';
    }
    
    //echo "<pre>";
    //var_dump($errores);
    //echo "</pre>";

    // Revisar que el array de errores esté vacio

    if(empty($errores)) {     


      // Crear carpeta
      $carpetaImagenes = '../../imagenes/';

      if(!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
      }

      $nombreImagen ='';

      /** SUBIDA DE ARCHIVOS  */
      if($imagen['name']) {
        // Eliminar imagen previa
        unlink($carpetaImagenes . $propiedad['imagen']);

       // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        // Subir la imagen

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);        
      } else {
        $nombreImagen = $propiedad['imagen'];
      }      

      
      // Insertar en la base de datos
      $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedores_id = ${vendedores_id} WHERE id= ${id} ";

      //echo $query;

      $resultado = mysqli_query($db, $query);

      if($resultado) {
        // Redireccionar al usuario.

        header('Location: /bienesraices/admin/index.php?resultado=2');
      }
    } 
  }


  
  incluirTemplate('header');
?>


<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error): ?>
  <div class="alerta error">
    <?php echo $error; ?>
  </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>Informacion General</legend>

      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" accept="image/jpeg, image/png" value="<?php echo $imagen; ?>" name="imagen">

      <img src="/bienesraices/imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen de la Propiedad" class="imagen-small">

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

    </fieldset>

    <fieldset>
      <legend>Informacion Propiedad</legend>

      <label for="habitaciones" >Habitaciones:</label>
      <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedores_id">
        <option value="">-- Seleccione --</option>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
        <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
        <?php endwhile; ?>
      </select>
      
    </fieldset>

    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
  </form>
</main>

<?php
  incluirTemplate('footer');
?>