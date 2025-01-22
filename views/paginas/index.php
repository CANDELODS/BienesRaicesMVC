<main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <?php include 'iconos.php'; ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos En Ventas</h2>

        <?php
            include 'listado.php';
        ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section>


    <section class="imagen-contacto">
        <h2>Encuentra La Casa De Tu Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto a la brevedad</p>
        <a href="/contacto" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        
        <seccion class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">

                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="img/webp">
                        <source srcset="build/img/blog1.jpg" type="img/jpeg">
                        <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">

                    </picture>
                </div> <!--.imagen-->

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Terraza En El Techo De Tu Casa</h4>
                        <p class="informacion-meta">Escrito el: <span>01/08/2023</span> Por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores
                            materiales y ahorrando dinero.
                        </p>
                        </a>
                </div>
            </article>

            <article class="entrada-blog">

                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="img/webp">
                        <source srcset="build/img/blog2.jpg" type="img/jpeg">
                        <img src="build/img/blog2.jpg" alt="Texto Entrada Blog" loading="lazy">

                    </picture>
                </div> <!--.imagen-->

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Guía Para La Decoración De Tu Hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>01/08/2023</span> Por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores
                            para darle vida a tu espacio.
                        </p>
                        </a>
                </div>
            </article>
        </seccion>

        <seccion class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me 
                    ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Juan Sebastian Candelo</p>
            </div>
        </seccion>

    </div> <!--.contendor .seccion-->