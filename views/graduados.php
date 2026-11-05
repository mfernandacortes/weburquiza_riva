<?php
$base = '../';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
// header.php / navbar.php ya abren <body> y #page-wrapper; footer_maps.php los cierra.
?>

<style>
/* Diseño limitado a esta página */
#graduados .pg-volver {
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

#graduados .pg-volver:hover {
    background: #f3f6fa;
    color: #17365d;
    box-shadow: 0 3px 10px rgba(0,0,0,.08);
}

#graduados .pg-intro {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 36px;
    color: #6b7280;
}

/* Cuadro centrado */
#graduados .pg-grid {
    display: grid;
    grid-template-columns: minmax(0, 450px);
    justify-content: center;
    gap: 20px;
    align-items: stretch;
}

#graduados .pg-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 14px;
    overflow: hidden;
    text-align: left;
    transition: transform .2s ease, box-shadow .2s ease;
}

#graduados .pg-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(0,0,0,.10);
}

#graduados .pg-banda {
    height: 110px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #17365d, #4776a5);
}

#graduados .pg-banda .icon:before {
    font-size: 2.4rem;
    color: #fff;
}

#graduados .pg-cuerpo {
    padding: 16px 20px 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

#graduados .pg-etiqueta {
    font-size: .75em;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: #3b6ea5;
}

#graduados .pg-cuerpo h3 {
    margin: 4px 0 10px;
    font-size: 1.3em;
    line-height: 1.3;
    color: #111827;
}

#graduados .pg-cuerpo p {
    margin: 0 0 16px;
    line-height: 1.65;
}

#graduados a.pg-btn {
    display: block;
    margin-top: auto;
    text-align: center;
    background: #234a73;
    color: #fff;
    font-weight: 600;
    font-size: .9em;
    padding: 11px 14px;
    border-radius: 8px;
    border-bottom: 0;
    text-decoration: none;
    transition: background .15s;
}

#graduados a.pg-btn:hover {
    background: #1b3a5c;
    color: #fff;
}

@media screen and (max-width: 736px) {
    #graduados .pg-grid {
        grid-template-columns: minmax(0, 1fr);
    }
}
</style>

<!-- Main -->
<section class="wrapper style1" id="graduados">
    <div class="container">

        <a class="pg-volver" href="<?= $base ?>index.php">&larr; Volver al inicio</a>

        <header class="major">
            <h2>Graduados</h2>
        </header>

        <p class="pg-intro">
            Un espacio para quienes ya egresaron de nuestra escuela.
        </p>

        <div class="pg-grid">

            <article class="pg-card">
                <div class="pg-banda">
                    <span class="icon solid fa-graduation-cap" aria-hidden="true"></span>
                </div>

                <div class="pg-cuerpo">
                    <div class="pg-etiqueta">Egresados</div>

                    <h3>Solicitud de Título</h3>

                    <p>
                        Ingresá al link y completá el formulario:
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfr3aWsUXJex2MX3aW7m831C5zRHOBJ9_6pb1q_7hdBbVYEUQ/viewform">
                            Ingresar
                        </a>
                    </p>
                </div>
            </article>

            <!--article class="pg-card">
                <div class="pg-banda">
                    <span class="icon solid fa-file-alt" aria-hidden="true"></span>
                </div>
                <div class="pg-cuerpo">
                    <div class="pg-etiqueta">Información</div>
                    <h3>Documentación y títulos</h3>
                    <p>
                        Escribí acá cómo gestionar la documentación y los títulos.
                    </p>
                </div>
            </article-->

        </div>
    </div>
</section>
<!-- fin Main -->

<!-- footer -->
<?php include __DIR__ . '/../includes/footer_maps.php'; ?>
```