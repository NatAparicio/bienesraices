<?php
  require 'includes/app.php';  
  incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
  
    <div class="contenido-nosotros">
      <div class="imagen">
        <picture>
          <source srcset="build/img/nosotros.webp" type="image/webp">
          <source srcset="build/img/nosotros.jpg" type="image/jpeg">
          <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
        </picture>
      </div>

      <div class="texto-nosotros">
        <blockquote>
          25 Años de Experiencia
        </blockquote>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam quae deserunt ipsum nobis blanditiis. Aspernatur quibusdam ducimus quis, necessitatibus autem ipsum? Repellat aliquam quasi id harum veniam? Quidem, veniam repudiandae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut hic necessitatibus, voluptate repellendus nisi impedit atque eaque saepe vero eum sequi quis delectus unde debitis sapiente repudiandae et aperiam ea.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero, ipsum maiores tenetur tempore molestiae aut magni laborum expedita nemo culpa nesciunt voluptatum voluptate explicabo animi sapiente ducimus iure ea dolores!</p>
      </div>
    </div>
  </main> 
  
  <section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
      <div class="icono">
        <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
        <h3>Seguridad</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro error repellat, vitae deserunt asperiores dolorum alias distinctio quo ullam ipsa ipsam consequatur, autem illo, suscipit quidem fuga nam maxime ab.</p>
      </div>
      <div class="icono">
        <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
        <h3>Precio</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro error repellat, vitae deserunt asperiores dolorum alias distinctio quo ullam ipsa ipsam consequatur, autem illo, suscipit quidem fuga nam maxime ab.</p>
      </div>
      <div class="icono">
        <img src="build/img/icono3.svg" alt="Icono tiempod" loading="lazy">
        <h3>Tiempo</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro error repellat, vitae deserunt asperiores dolorum alias distinctio quo ullam ipsa ipsam consequatur, autem illo, suscipit quidem fuga nam maxime ab.</p>
      </div>
    </div>
  </section>

<?php
  incluirTemplate('footer');
?>