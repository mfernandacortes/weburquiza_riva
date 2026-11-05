
<?php
$pagina_completa = !isset($base);

if ($pagina_completa) {
    $base = '../';
    include __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../includes/navbar.php';
}

require_once __DIR__ . '/../models/novedades.php';

$modelo = new Novedades();
$mesas = $modelo->listarTipos('Mesas de examen');

function hMesas($texto) {
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}

// Agrupar por ciclo lectivo
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
#pagina-mesas {
    padding: 45px 0;
}

#pagina-mesas .intro {
    text-align: center;
    margin-bottom: 40px;
}

#pagina-mesas .grupo-ciclo {
    margin-bottom: 35px;
}

#pagina-mesas .titulo-ciclo {
    color: #17365d;
    border-bottom: 2px solid #e1e6ec;
    padding-bottom: 12px;
    margin-bottom: 22px;
}

#pagina-mesas .turno {
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 22px;
    box-shadow: 0 4px 12px rgba(0,0,0,.04);
}

#pagina-mesas .turno h3 {
    color: #17365d;
    margin-bottom: 12px;
}

#pagina-mesas .detalle {
    line-height: 1.7;
    margin-bottom: 20px;
}

#pagina-mesas .archivo-titulo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
    color: #34495e;
    font-weight: bold;
}

#pagina-mesas .archivo-titulo i {
    color: #dc3545;
    font-size: 25px;
}

#pagina-mesas .visor-pdf {
    width: 100%;
    height: 600px;
    border: 1px solid #dce2e8;
    border-radius: 8px;
}

#pagina-mesas .imagen-mesa {
    display: block;
    width: 100%;
    max-height: 600px;
    object-fit: contain;
    border-radius: 8px;
    background: #f5f7fa;
}

#pagina-mesas .botones-archivo {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    flex-wrap: wrap;
}

#pagina-mesas .botones-archivo a {
    display: inline-block;
    padding: 10px 16px;
    background: #17365d;
    color: white;
    text-decoration: none;
    border-radius: 6px;
}

#pagina-mesas .botones-archivo a:hover {
    background: #254d7c;
}

#pagina-mesas .sin-mesas {
    padding: 30px;
    text-align: center;
    background: white;
    border: 1px solid #e1e6ec;
    border-radius: 10px;
}

@media(max-width: 650px) {
    #pagina-mesas .turno {
        padding: 16px;
    }

    #pagina-mesas .visor-pdf {
        height: 450px;
    }
}
</style>

<section class="wrapper style1" id="pagina-mesas">

    <div class="container">

        <header class="intro">
            <h2>Mesas de Exámenes</h2>
            <p>
                Consultá los cronogramas y fechas de los distintos
                turnos de exámenes.
            </p>
        </header>

        <?php if (empty($mesas)) : ?>

            <div class="sin-mesas">
                <i class="fas fa-calendar-times fa-2x"></i>
                <h3>No hay mesas publicadas</h3>
                <p>
                    Por el momento no hay mesas de exámenes disponibles.
                </p>
            </div>

        <?php else : ?>

            <?php foreach ($mesasPorCiclo as $ciclo => $turnos) : ?>

                <div class="grupo-ciclo">

                    <h2 class="titulo-ciclo">
                        Ciclo lectivo: <?= hMesas($ciclo) ?>
                    </h2>

                    <?php foreach ($turnos as $mesa) :

                        $titulo = $mesa['titulo'] ?? 'Turno de examen';
                        $detalle = $mesa['detalle'] ?? '';
                        $archivo = trim((string)($mesa['archivo'] ?? ''));

                        $extension = strtolower(
                            pathinfo($archivo, PATHINFO_EXTENSION)
                        );

                        $nombreArchivo = basename($archivo);

                        $urlArchivo = $base . 'uploads/' .
                            rawurlencode($nombreArchivo);

                    ?>

                        <article class="turno">

                            <h3><?= hMesas($titulo) ?></h3>

                            <?php if (!empty($detalle)) : ?>
                                <div class="detalle">
                                    <?= nl2br(hMesas($detalle)) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($archivo !== '') : ?>

                                <?php if ($extension === 'pdf') : ?>

                                    <div class="archivo-titulo">
                                        <i class="fas fa-file-pdf"></i>
                                        Cronograma de exámenes
                                    </div>

                                    <iframe
                                        class="visor-pdf"
                                        src="<?= hMesas($urlArchivo) ?>"
                                        title="<?= hMesas($titulo) ?>">
                                    </iframe>

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
                                            Descargar
                                        </a>

                                    </div>

                                <?php elseif (
                                    in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])
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
if ($pagina_completa) {
    include __DIR__ . '/../includes/footer_maps.php';
}
?>
