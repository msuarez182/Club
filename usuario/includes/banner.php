<section class="container my-5">
  <div id="bannerCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden mx-auto" style="max-width: 1400px;" data-bs-ride="carousel">
    
    <!-- Contenido del carrusel -->
    <div class="carousel-inner" style="height: 300px;"> <!-- Altura fija (ajusta según necesidad) -->
      
      <!-- Banner 1 -->
      <div class="carousel-item active h-100">
        <a href="https://ejemplo.com/promocion1" target="_blank">
          <img src="https://picsum.photos/1400/300.webp?random=1" 
               class="d-block w-100 h-100 object-fit-cover" 
               alt="Promoción exclusiva"
               loading="lazy"
               width="1400"
               height="300">
        </a>
      </div>
      
      <!-- Banner 2 -->
      <div class="carousel-item h-100">
        <a href="https://ejemplo.com/oferta" target="_blank">
          <img src="https://picsum.photos/1400/300.webp?random=2" 
               class="d-block w-100 h-100 object-fit-cover" 
               alt="Oferta limitada"
               loading="lazy"
               width="1400"
               height="300">
        </a>
      </div>
      
      <!-- Banner 3 -->
      <div class="carousel-item h-100">
        <a href="https://ejemplo.com/nuevo" target="_blank">
          <img src="https://picsum.photos/1400/300.webp?random=3" 
               class="d-block w-100 h-100 object-fit-cover" 
               alt="Nuevo lanzamiento"
               loading="lazy"
               width="1400"
               height="300">
        </a>
      </div>
    </div>
    
    <!-- Controles de navegación -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bg-dark bg-opacity-25 rounded-end p-3"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon bg-dark bg-opacity-25 rounded-start p-3"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>
</section>