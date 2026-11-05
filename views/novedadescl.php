
<?php
// Si se abre directamente, carga la página completa.
$pagina_completa = !isset($base);

if ($pagina_completa) {
    $base = '../';
    include __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../includes/navbar.php';
}

require_once __DIR__ . '/../models/novedades.php';

$mesas = [];
$error_bd = false;

//try {
    $modelo = new Novedades();
    $mesas = $modelo->listarTipos();
//} catch (Throwable $ex) {
//   $error_bd = true;
//}

// Escapar contenido HTML.
function hMesas($texto) {
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}

// Agrupar por ciclo lectivo.
$mesasPorCiclo = [];

foreach ($mesas as $mesa) {
    $ciclo = trim((string)($mesa['ciclo_fecha'] ?? ''));

    if ($ciclo === '') {
        $ciclo = 'Otros períodos';
    }

    $mesasPorCiclo[$ciclo][] = $mesa;
}
?>

<style>

/* =====================================
   MESAS DE EXÁMENES
   Diseño institucional
===================================== */

#pagina-mesas {
    padding-top: 40px;
    padding-bottom: 45px;
}

/* Encabezado */

#pagina-mesas .intro {
    margin-bottom: 38px;
}

#pagina-mesas .intro h2 {
    color: #17365d;
}

#pagina-mesas .intro p {
    color: #6b7280;
}

/* Grupos por ciclo lectivo */

#pagina-mesas .grupo-ciclo {
    margin-bottom: 38px;
}

#pagina-mesas .titulo-ciclo {
    color: #17365d;
    font-size: 1.35em;
    font-weight: 600;
    border-bottom: 2px solid #e1e6ec;
    padding-bottom: 12px;
    margin-bottom: 20px;
}

/* Tarjetas de cada turno */

#pagina-mesas .turno {
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 12px;
    padding: 22px;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,.04);
}

#pagina-mesas .turno h3 {
    color: #17365d;
    font-size: 1.25em;
    margin-bottom: 10px;
}

#pagina-mesas .detalle {
    color: #4b5563;
    line-height: 1.7;
    margin-bottom: 20px;
}

/* Título del archivo */

#pagina-mesas .archivo-titulo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    color: #34495e;
    font-weight: 600;
}

#pagina-mesas .archivo-titulo i {
    color: #dc3545;
    font-size: 23px;
}

/* Visor PDF */

#pagina-mesas .visor-pdf {
    display: block;
    width: 100%;
    height: 650px;
    border: 1px solid #e1e6ec;
    border-radius: 9px;
    background: #f5f7fa;
}

/* Imágenes */

#pagina-mesas .imagen-mesa {
    display: block;
    width: 100%;
    max-height: 650px;
    object-fit: contain;
    border: 1px solid #e1e6ec;
    border-radius: 9px;
    background: #f5f7fa;
}

/* Botones de archivos */

#pagina-mesas .botones-archivo {
    display: flex;
    gap: 10px;
    margin-top: 16px;
    flex-wrap: wrap;
}

#pagina-mesas .botones-archivo a {
    display: inline-block;
    padding: 11px 18px;
    background: #17365d;
    color: #fff;
    font-size: .9em;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: background .2s ease;
}

#pagina-mesas .botones-archivo a:hover {
    background: #4776a5;
    color: #fff;
}

/* Mensajes */

#pagina-mesas .sin-mesas {
    padding: 30px;
    text-align: center;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 12px;
    margin-bottom: 30px;
}

#pagina-mesas .sin-mesas i {
    color: #6b7280;
    margin-bottom: 12px;
}

#pagina-mesas .sin-mesas h3 {
    color: #17365d;
}

#pagina-mesas .error-mesas {
    padding: 25px;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 10px;
}

/* Responsive */

@media screen and (max-width: 700px) {

    #pagina-mesas {
        padding-top: 25px;
    }

    #pagina-mesas .turno {
        padding: 16px;
    }

    #pagina-mesas .visor-pdf {
        height: 480px;
    }

    #pagina-mesas .titulo-ciclo {
        font-size: 1.2em;
    }

}

@media screen and (max-width: 480px) {

    #pagina-mesas .visor-pdf {
        height: 400px;
    }

    #pagina-mesas .botones-archivo {
        flex-direction: column;
    }

    #pagina-mesas .botones-archivo a {
        text-align: center;
    }

}

</style>


<!-- =====================================
     SECCIÓN MESAS DE EXÁMENES
===================================== -->

<section class="wrapper style1" id="pagina-mesas">

    <div class="container">

        <!-- Encabezado institucional -->

        <header class="major intro">

            <h2>Mesas de Exámenes</h2>

            <p>
                Consultá los cronogramas y fechas de los distintos
                turnos de exámenes.
            </p>

        </header>


        <!-- Error de base de datos -->

        <?php if ($error_bd) : ?>

            <div class="error-mesas">

                <p>
                    No se pudieron cargar las mesas de exámenes
                    en este momento. Por favor, intentá nuevamente más tarde.
                </p>

            </div>


        <!-- Sin publicaciones -->

        <?php elseif (empty($mesas)) : ?>

            <div class="sin-mesas">

                <i class="fas fa-calendar-times fa-2x"></i>

                <h3>No hay mesas publicadas</h3>

                <p>
                    Por el momento no hay mesas de exámenes disponibles.
                </p>

            </div>


        <!-- Listado de mesas -->

        <?php else : ?>

            <?php foreach ($mesasPorCiclo as $ciclo => $turnos) : ?>

                <div class="grupo-ciclo">

                    <!-- Ciclo lectivo -->

                    <h2 class="titulo-ciclo">
                        Ciclo lectivo: <?= hMesas($ciclo) ?>
                    </h2>


                    <?php foreach ($turnos as $mesa) :

                        $titulo = $mesa['titulo'] ?? 'Turno de examen';
                        $detalle = $mesa['detalle'] ?? '';

                        $archivo = trim(
                            (string)($mesa['archivo'] ?? '')
                        );

                        $nombreArchivo = basename($archivo);

                        $extension = strtolower(
                            pathinfo($nombreArchivo, PATHINFO_EXTENSION)
                        );

                        $urlArchivo = $base . 'uploads/' .
                            rawurlencode($nombreArchivo);

                    ?>


                        <article class="turno">

                            <!-- Título del turno -->

                            <h3>
                                <?= hMesas($titulo) ?>
                            </h3>


                            <!-- Información adicional -->

                            <?php if (!empty($detalle)) : ?>

                                <div class="detalle">

                                    <?= nl2br(hMesas($detalle)) ?>

                                </div>

                            <?php endif; ?>


                            <!-- Archivo adjunto -->

                            <?php if ($archivo !== '') : ?>


                                <?php if ($extension === 'pdf') : ?>


                                    <div class="archivo-titulo">

                                        <i class="fas fa-file-pdf"></i>

                                        Cronograma de exámenes

                                    </div>


                                    <!-- Visor PDF -->

                                    <iframe

                                        class="visor-pdf"

                                        src="<?= hMesas($urlArchivo) ?>"

                                        title="<?= hMesas($titulo) ?>"

                                        loading="lazy">

                                    </iframe>


                                    <!-- Acciones del PDF -->

                                    <div class="botones-archivo">

                                        <a

                                            href="<?= hMesas($urlArchivo) ?>"

                                            target="_blank"

                                            rel="noopener noreferrer">

                                            <i class="fas fa-external-link-alt"></i>

                                            Abrir PDF

                                        </a>


                                        <a

                                            href="<?= hMesas($urlArchivo) ?>"

                                            download>

                                            <i class="fas fa-download"></i>

                                            Descargar PDF

                                        </a>

                                    </div>


                                <?php elseif (
                                    in_array(
                                        $extension,
                                        ['jpg', 'jpeg', 'png', 'webp'],
                                        true
                                    )
                                ) : ?>


                                    <div class="archivo-titulo">

                                        <i class="fas fa-image"></i>

                                        Cronograma de exámenes

                                    </div>


                                    <img

                                        class="imagen-mesa"

                                        src="<?= hMesas($urlArchivo) ?>"

                                        alt="<?= hMesas($titulo) ?>"

                                        loading="lazy">


                                <?php else : ?>


                                    <p>
                                        El formato del archivo no es compatible
                                        con el visor.
                                    </p>


                                <?php endif; ?>


                            <?php endif; ?>

                        </article>


                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</section>


<?php

// Pie de página cuando se abre directamente.

if ($pagina_completa) {

    include __DIR__ . '/../includes/footer_maps.php';

}

?>
