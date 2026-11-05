<?php
// Detalle de una novedad publicada: views/detallenovedad.php?id=1
$base = '../';
require_once __DIR__ . '/../models/novedades.php';

function e_detalle($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$novedad = null;

if ($id && $id > 0) {
    $modelo = new Novedades();
    $novedad = $modelo->obtener($id);

    // Las novedades desactivadas no se muestran en el sitio público.
    if ($novedad && (int)($novedad['activo'] ?? 0) !== 1) {
        $novedad = null;
    }
}

if (!$novedad) {
    http_response_code(404);
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<section class="wrapper style1">
    <div class="container">
        <p><a href="novedadescl.php">&larr; Volver a novedades</a></p>

        <?php if ($novedad): ?>
            <article>
                <header class="major">
                    <p><?= e_detalle($novedad['tipo'] ?? '') ?></p>
                    <h2><?= e_detalle($novedad['titulo'] ?? '') ?></h2>
                    <?php if (!empty($novedad['ciclo_fecha'])): ?>
                        <p><?= e_detalle($novedad['ciclo_fecha']) ?></p>
                    <?php endif; ?>
                </header>

                <div>
                    <?= nl2br(e_detalle($novedad['detalle'] ?? '')) ?>
                </div>

                <?php if (!empty($novedad['archivo'])): ?>
                    <?php
                    $nombreArchivo = basename($novedad['archivo']);
                    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                    $esImagen = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true);
                    ?>
                    <div style="margin-top: 1.5em;">
                        <?php if ($esImagen): ?>
                            <p>
                                <img src="<?= e_detalle('../uploads/' . rawurlencode($nombreArchivo)) ?>"
                                     alt="Archivo adjunto de <?= e_detalle($novedad['titulo'] ?? '') ?>"
                                     style="max-width:100%; height:auto;">
                            </p>
                        <?php endif; ?>
                        <p>
                            <a href="<?= e_detalle('../uploads/' . rawurlencode($nombreArchivo)) ?>" target="_blank" rel="noopener">
                                Ver o descargar archivo adjunto
                            </a>
                        </p>
                    </div>
                <?php endif; ?>
            </article>
        <?php else: ?>
            <header class="major">
                <h2>Novedad no encontrada</h2>
                <p>La novedad no existe o no está publicada.</p>
            </header>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer_maps.php'; ?>
