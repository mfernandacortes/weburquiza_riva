<?php
/*
$pagina_completa = !isset($base);

if ($pagina_completa) {
    $base = '../';
    include __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../includes/navbar.php';
}
require_once __DIR__ . '/../models/novedades.php';

$modelo = new Novedades();
$insc_act = $modelo->listarInscripciones();
echo "aca listo insc ";
foreach ($insc_act as $insc_act)
    { 
        echo $insc_act['tipo']." ".$insc_act['titulo']." ".$insc_act['ciclo_fecha'].
        $insc_act['detalle']." ".$insc_act['archivo'];
    }
        */
  
$pagina_completa = !isset($base);

if ($pagina_completa) {
    $base = '../';
    include __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../includes/navbar.php';
}

require_once __DIR__ . '/../models/novedades.php';

$modelo = new Novedades();
$insc_act = $modelo->listarTipos('Mesas de examen');

function hInscripciones($texto) {
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}
?>

<style>
#pagina-inscripciones {
    padding: 40px 0;
}

#pagina-inscripciones .intro {
    text-align: center;
    margin-bottom: 35px;
}

#pagina-inscripciones .lista-inscripciones {
    display: grid;
    grid-template-columns: 1fr;
    gap: 25px;
}

#pagina-inscripciones .tarjeta-inscripcion {
    display: grid;
    grid-template-columns: minmax(200px, 300px) minmax(0, 1fr);
    gap: 25px;
    align-items: start;
    padding: 22px;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
}

#pagina-inscripciones .imagen-inscripcion {
    width: 100%;
}

#pagina-inscripciones .imagen-inscripcion img {
    display: block;
    width: 100%;
    max-height: 320px;
    object-fit: contain;
    border-radius: 8px;
}

#pagina-inscripciones .contenido-inscripcion {
    min-width: 0;
}

#pagina-inscripciones .contenido-inscripcion h3 {
    color: #17365d;
    margin: 0 0 12px;
    overflow-wrap: anywhere;
}

#pagina-inscripciones .fecha-inscripcion {
    color: #687586;
    font-size: .9em;
    margin-bottom: 15px;
}

#pagina-inscripciones .detalle-inscripcion {
    line-height: 1.7;
    overflow-wrap: anywhere;
}

#pagina-inscripciones .sin-inscripciones {
    padding: 25px;
    text-align: center;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 10px;
}

@media (max-width: 650px) {
    #pagina-inscripciones .tarjeta-inscripcion {
        grid-template-columns: 1fr;
        padding: 16px;
    }

    #pagina-inscripciones .imagen-inscripcion img {
        max-height: 280px;
    }
}
</style>

<section class="wrapper style1" id="pagina-inscripciones">
    <div class="container">

        <header class="intro">
            <h2>Mesas de Exámenes</h2>
            <p>Información sobre las distintas mesas de exámenes.</p>
        </header>

        <?php if (empty($insc_act)) { ?>

            <div class="sin-inscripciones">
                <p>Sin mesas publicadas por el momento.</p>
            </div>

        <?php } else { ?>

            <div class="lista-inscripciones">

                <?php foreach ($insc_act as $inscripcion) {
                    $archivo = trim((string)($inscripcion['archivo'] ?? ''));
                    $urlImagen = $base . 'uploads/' . rawurlencode($archivo);
                ?>

                    <article class="tarjeta-inscripcion">

                        <?php if ($archivo !== '') { ?>
                            <div class="imagen-inscripcion">
                                <img
                                    src="<?= hInscripciones($urlImagen) ?>"
                                    alt="<?= hInscripciones($inscripcion['titulo'] ?? 'Inscripción') ?>"
                                    loading="lazy">
                            </div>
                        <?php } ?>

                        <div class="contenido-inscripcion">

                            <h3>
                                <?= hInscripciones($inscripcion['titulo'] ?? 'Inscripciones') ?>
                            </h3>

                            <?php if (!empty($inscripcion['ciclo_fecha'])) { ?>
                                <p class="fecha-inscripcion">
                                    <?= hInscripciones($inscripcion['ciclo_fecha']) ?>
                                </p>
                            <?php } ?>

                            <div class="detalle-inscripcion">
                                <?= nl2br(hInscripciones($inscripcion['detalle'] ?? '')) ?>
                            </div>

                        </div>

                    </article>

                <?php } ?>

            </div>

        <?php } ?>

    </div>
</section>

<?php
if ($pagina_completa) {
    include __DIR__ . '/../includes/footer_maps.php';
}
?>
?>