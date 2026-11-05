<?php
// Página exclusiva de Inscripciones.
// Si se abre directamente, carga el encabezado y el menú.
// Si se incluye desde index.php, reutiliza los ya cargados.

$pagina_completa = !isset($base);

if ($pagina_completa) {
    $base = '../';
    include __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../includes/navbar.php';
}

$uploads_url = $base . 'uploads/';

if (!function_exists('h')) {
    function h($s) {
        return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    }
}

$novedades = [];
$error_bd = false;

if (!function_exists('esImagenInscripcion')) {
    function esImagenInscripcion($archivo) {
        $ext = strtolower(pathinfo((string)$archivo, PATHINFO_EXTENSION));
        return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true);
    }
}

try {
    require_once __DIR__ . '/../models/novedades.php';

    $modelo = new Novedades();

    // FILTRO FIJO: solamente novedades activas de tipo Inscripciones.
    $novedades = $modelo->listarInscripciones();

} catch (Throwable $ex) {
    $error_bd = true;
}
?>

<style>
#pagina-inscripciones {
    padding-bottom: 35px;
}

#pagina-inscripciones .inscripciones-intro {
    margin-bottom: 30px;
}

#pagina-inscripciones .inscripciones-lista {
    display: grid;
    grid-template-columns: 1fr;
    gap: 22px;
}

#pagina-inscripciones .inscripcion-item {
    display: grid;
    grid-template-columns: minmax(180px, 280px) minmax(0, 1fr);
    gap: 24px;
    align-items: start;
    padding: 22px;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 14px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, .04);
}

#pagina-inscripciones .inscripcion-imagen {
    overflow: hidden;
    border-radius: 10px;
    background: #edf1f5;
    min-height: 150px;
}

#pagina-inscripciones .inscripcion-imagen img {
    display: block;
    width: 100%;
    height: auto;
    max-height: 350px;
    object-fit: contain;
}

#pagina-inscripciones .inscripcion-contenido {
    min-width: 0;
    text-align: left;
}

#pagina-inscripciones .inscripcion-etiqueta {
    color: #3b6ea5;
    font-size: .78em;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    margin-bottom: 8px;
}

#pagina-inscripciones .inscripcion-contenido h3 {
    margin: 0 0 12px;
    color: #17365d;
    overflow-wrap: anywhere;
}

#pagina-inscripciones .inscripcion-fecha {
    color: #6b7280;
    font-size: .88em;
    margin-bottom: 14px;
}

#pagina-inscripciones .inscripcion-detalle {
    line-height: 1.7;
    overflow-wrap: anywhere;
}

#pagina-inscripciones .inscripcion-boton {
    display: inline-block;
    margin-top: 12px;
    padding: 11px 18px;
    background: #234a73;
    color: #fff !important;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

#pagina-inscripciones .inscripcion-boton:hover {
    background: #17365d;
}

#pagina-inscripciones .inscripciones-mensaje {
    padding: 25px;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 10px;
}

@media (max-width: 650px) {
    #pagina-inscripciones .inscripcion-item {
        grid-template-columns: 1fr;
        padding: 16px;
    }

    #pagina-inscripciones .inscripcion-imagen {
        min-height: 0;
    }
}
</style>

<section class="wrapper style1" id="pagina-inscripciones">
    <div class="container">

        <header class="major inscripciones-intro">
            <h2>Inscripciones</h2>
            <p>Información y novedades sobre inscripciones de nuestra institución.</p>
        </header>

        <?php if ($error_bd) { ?>

            <div class="inscripciones-mensaje">
                <p>No se pudieron cargar las inscripciones en este momento.</p>
            </div>

        <?php } elseif (empty($novedades)) { ?>

            <div class="inscripciones-mensaje">
                <p>No hay inscripciones publicadas por el momento.</p>
            </div>

        <?php } else { ?>

            <div class="inscripciones-lista">

                <?php foreach ($novedades as $n) {
                    $archivo = trim((string)($n['archivo'] ?? ''));
                    $urlArchivo = $uploads_url . rawurlencode($archivo);
                    $urlDetalle = $base . 'views/detallenovedad.php?id='
                        . (int)$n['IdNovedad'];
                ?>

                    <article class="inscripcion-item">

                        <?php if ($archivo !== '' && esImagenInscripcion($archivo)) { ?>
                            <div class="inscripcion-imagen">
                                <img
                                    src="<?= h($urlArchivo) ?>"
                                    alt="<?= h($n['titulo'] ?? 'Inscripciones') ?>"
                                    loading="lazy">
                            </div>
                        <?php } ?>

                        <div class="inscripcion-contenido">

                            <div class="inscripcion-etiqueta">
                                Inscripciones
                            </div>

                            <h3><?= h($n['titulo'] ?? 'Inscripciones') ?></h3>

                            <?php if (!empty($n['ciclo_fecha'])) { ?>
                                <p class="inscripcion-fecha">
                                    <?= h($n['ciclo_fecha']) ?>
                                </p>
                            <?php } ?>

                            <div class="inscripcion-detalle">
                                <?= nl2br(h($n['detalle'] ?? '')) ?>
                            </div>

                            <a
                                class="inscripcion-boton"
                                href="<?= h($urlDetalle) ?>">
                                Ver información completa
                            </a>

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


