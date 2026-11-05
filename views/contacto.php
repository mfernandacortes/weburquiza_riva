<?php
$base = '../';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<style>
/* Diseño limitado a la página de contacto */
#contacto .mod-volver {
    display: inline-block;
    margin-bottom: 18px;
    padding: 8px 16px;
    background: #fff;
    color: #234a73;
    font-size: .9em;
    font-weight: 600;
    border: 1px solid #e1e6ec;
    border-radius: 8px;
    text-decoration: none;
    transition: background .15s, box-shadow .15s;
}

#contacto .mod-volver:hover {
    background: #f3f6fa;
    color: #17365d;
    box-shadow: 0 3px 10px rgba(0,0,0,.08);
}

#contacto .mod-intro {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 36px;
    color: #6b7280;
    line-height: 1.65;
}

#contacto .mod-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    align-items: stretch;
}

#contacto .mod-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 14px;
    overflow: hidden;
    text-align: left;
    transition: transform .2s ease, box-shadow .2s ease;
}

#contacto .mod-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(0,0,0,.10);
}

#contacto .mod-banda {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #3d6af2, #3768fb);
    color: #fff;
}

#contacto .mod-banda .icon:before {
    font-size: 2.6rem;
    color: #fff;
}

#contacto .mod-cuerpo {
    padding: 16px 20px 22px;
}

#contacto .mod-etiqueta {
    font-size: .75em;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: #3b6ea5;
}

#contacto .mod-cuerpo h3 {
    margin: 4px 0 10px;
    font-size: 1.3em;
    line-height: 1.3;
    color: #111827;
}

#contacto .mod-cuerpo p {
    margin: 0 0 14px;
    line-height: 1.65;
}

#contacto .mod-enlace {
    display: inline-block;
    margin-top: 4px;
    color: #234a73;
    font-weight: 600;
    text-decoration: none;
    overflow-wrap: anywhere;
}

#contacto .mod-enlace:hover {
    color: #4776a5;
    text-decoration: underline;
}

@media screen and (max-width: 736px) {
    #contacto .mod-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Contenido principal -->
<section class="wrapper style1" id="contacto">
    <div class="container">

        <a class="mod-volver" href="<?= $base ?>index.php">
            &larr; Volver al inicio
        </a>

        <header class="major">
            <h2>Contacto</h2>
        </header>

        <p class="mod-intro">
            Encontrá nuestros canales de contacto y seguinos en
            nuestras redes sociales para mantenerte informado.
        </p>

        <div class="mod-grid">

        <!-- Dirección  -->
        <!-- Dirección -->
<article class="mod-card">
    <div class="mod-banda">
        <span class="icon solid fa-map-marker-alt"
              aria-hidden="true"></span>
    </div>

    <div class="mod-cuerpo">
        <div class="mod-etiqueta">Ubicación</div>
        <h3>Encontranos en:</h3>
        <p>
            Bv. Oroño 690<br>
            Rosario, Santa Fe
        </p>

        <a class="mod-enlace"
           href="https://www.google.com/maps/search/?api=1&query=Bv.+Oro%C3%B1o+690%2C+Rosario%2C+Santa+Fe"
           target="_blank"
           rel="noopener noreferrer">
            <i class="fas fa-map-marked-alt"
               aria-hidden="true"></i>
            Cómo llegar
        </a>
    </div>
</article>


            

            <!-- Correo electrónico -->
            <article class="mod-card">
                <div class="mod-banda">
                    <span class="icon solid fa-envelope"
                          aria-hidden="true"></span>
                </div>

                <div class="mod-cuerpo">
                    <div class="mod-etiqueta">Correo electrónico</div>
                    <h3>Escribinos</h3>
                    <p>
                        Podés comunicarte con nosotros por correo
                       electrónico para realizar consultas:
                        
                    </p>

                    <p>equipodirectivo49@gmail.com</p>
                    <p>secretaria49@gmail.com</p>
                
                </div>
            </article>

            <!-- Teléfonos -->
            <article class="mod-card">
                <div class="mod-banda">
                    <span class="icon solid fa-phone"
                          aria-hidden="true"></span>
                </div>

                <div class="mod-cuerpo">
                    <div class="mod-etiqueta">Atención telefónica</div>
                    <h3>Teléfonos</h3>
                  

                    <!-- Completar cuando estén disponibles los números -->
                    <span class="mod-enlace">
                        3414374392
                    </span>
                </div>
            </article>

            
            <!-- Instagram -->
            <article class="mod-card">
                <div class="mod-banda">
                    <span class="icon brands fa-instagram"
                          aria-hidden="true"></span>
                </div>

                <div class="mod-cuerpo">
                    <div class="mod-etiqueta">Redes sociales</div>
                    <h3>Seguinos en Instagram</h3>
                    <p>
                        Encontrá nuestras novedades, publicaciones
                        y actividades en nuestras redes sociales.
                    </p>

                    <!-- Reemplazar # por el enlace real -->
                    <a class="mod-enlace"
                       href="https://www.instagram.com/49urquiza/"
                       target="_blank"
                       rel="noopener noreferrer">
                        Visitar Instagram
                    </a>
                </div>
            </article>

        </div>
    </div>
</section>
<!-- Fin del contenido principal -->

<?php include __DIR__ . '/../includes/footer_maps.php'; ?>