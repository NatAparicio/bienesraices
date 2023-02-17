<?php
  require 'includes/app.php';  
  incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
      <source srcset="build/img/destacada3.webp" type="image/webp">
      <source srcset="build/img/destacada3.jpg" type="image/jpeg">
      <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">      
    </picture>

    <h2>Llene el fomrmulario de contacto</h2>

    <form action="" class="formulario">
      <fieldset>
        <legend>Informacion Personal</legend>

        <label for="nombre">Nombre:</label>
        <input type="text" placeholder="Tu Nombre" id="nombre">

        <label for="email">E-mail:</label>
        <input type="email" placeholder="Tu Email" id="email">

        <label for="telefono">Teléfono:</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono">

        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>

      </fieldset>

      <fieldset>
        <legend>Informacion sobre la propiedad</legend>

        <label for="opciones">Vende o Compra:</label>
        <select name="" id="opciones">
          <option value="" disabled selected>-- Seleccione --</option>
          <option value="compra">Compra</option>
          <option value="vende">Vende</option>
        </select>

        <label for="presupuesto">Precio o Presupuesto</label>
        <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" min="1000">

      </fieldset>

      <fieldset>
        <legend>Contato</legend>

        <p>Como desea ser contactado</p>

        <div class="forma-contacto">
          <label for="contactar-telefono">Teléfono</label>
          <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

          <label for="contactar-email">E-mail</label>
          <input name="contacto" type="radio" value="email" id="contactar-email">
        </div>

        <p>Si eligió Teléfono, elija la fecha y la hora ara ser contactádo</p>

        <label for="fecha">Fecha:</label>
        <input type="date"  id="fecha">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00">

      </fieldset>

      <input type="submit" value="Enviar" class="boton-verde">

    </form>
  </main>

<?php
  incluirTemplate('footer');
?>