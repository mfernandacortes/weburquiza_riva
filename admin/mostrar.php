<?php
require_once 'config.php';

$modelo = new Novedades();

// Obtener solamente las novedades activas,
// ordenadas de la última a la primera.
$filas = $modelo->listarActivas();

$titulo = 'Novedades';
include '_header.php';

?>

<section class="container my-4">

    <h2 class="mb-4">Novedades</h2>

    <?php if (empty($filas)) { ?>

        <p class="text-muted">No hay novedades disponibles.</p>

    <?php } else { ?>

        <div class="row g-4">

            <?php foreach ($filas as $f) { ?>

                <div class="col-12">
                    <article class="card shadow-sm">
                        <div class="card-body">

                            <h4 class="card-title">
                                <?php echo e($f['titulo']); ?>
                            </h4>

                            <p class="text-muted mb-2">
                                <strong>Tipo:</strong>
                                <?php echo e($f['tipo']); ?>
                                <span class="mx-2">|</span>
                                <strong>Fecha:</strong>
                                <?php echo e($f['ciclo_fecha']); ?>
                            </p>

                            <div class="card-text">
                                <?php echo nl2br(e($f['detalle'])); ?>
                            </div>

                            <?php if (!empty($f['archivo'])) { ?>
                                <div class="mt-3">
                                    <a
                                        class="btn btn-outline-primary btn-sm"
                                        href="<?php echo e(UPLOAD_URL . $f['archivo']); ?>"
                                        target="_blank"
                                        rel="noopener">
                                        Ver archivo adjunto
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </article>
                </div>

            <?php } ?>

        </div>

    <?php } ?>

</section>

<?php include '_footer.php'; ?>