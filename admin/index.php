<?php
require_once 'config.php';
requerir_login();

$filtro = $_GET['tipo'] ?? '';
if ($filtro !== '' && !in_array($filtro, Novedades::TIPOS, true)) {
    $filtro = '';
}

$modelo = new Novedades();
$filas  = $modelo->listar($filtro ?: null);
$mensaje = flash();

$titulo = 'Novedades';
include '_header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Novedades</h3>
    <a class="btn btn-success" href="form.php">+ Nueva novedad</a>
</div>

<?php if ($mensaje) { ?>
    <div class="alert alert-success">
        <?php echo e($mensaje); ?>
    </div>
<?php } ?>

<form method="get" class="row g-2 mb-3">
    <div class="col-auto">
        <select name="tipo" class="form-select" onchange="this.form.submit()">
            <option value="">Todos los tipos</option>

            <?php foreach (Novedades::TIPOS as $t) { ?>
                <option
                    value="<?php echo e($t); ?>"
                    <?php echo $t === $filtro ? 'selected' : ''; ?>>
                    <?php echo e($t); ?>
                </option>
            <?php } ?>
        </select>
    </div>
</form>

<?php if (empty($filas)) { ?>

    <p class="text-muted">Todavía no hay novedades cargadas.</p>

<?php } else { ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white align-middle">

            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Título</th>
                    <th>Ciclo / Fecha</th>
                    <th>Activo</th>
                    <th>Archivo</th>
                    <th style="width:170px">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($filas as $f) { ?>
                    <tr>
                        <td>
                            <?php echo (int)$f['IdNovedad']; ?>
                        </td>

                        <td>
                            <?php echo e($f['tipo']); ?>
                        </td>

                        <td>
                            <?php echo e($f['titulo']); ?>
                        </td>

                        <td>
                            <?php echo e($f['ciclo_fecha']); ?>
                        </td>

                        <td>
                            <?php if ((int)($f['activo'] ?? 0) === 1) { ?>
                                <span class="badge bg-success">Sí</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">No</span>
                            <?php } ?>
                        </td>

                        <td>
                            <?php if ($f['archivo']) { ?>
                                <a
                                    href="<?php echo e(UPLOAD_URL . $f['archivo']); ?>"
                                    target="_blank"
                                    rel="noopener">
                                    Ver
                                </a>
                            <?php } else { ?>
                                —
                            <?php } ?>
                        </td>

                        <td>
                            <a
                                class="btn btn-primary btn-sm"
                                href="form.php?id=<?php echo (int)$f['IdNovedad']; ?>">
                                Editar
                            </a>

                            <form
                                method="post"
                                action="eliminar.php"
                                class="d-inline"
                                onsubmit="return confirm('¿Seguro que querés eliminar esta novedad? No se puede deshacer.');">

                                <input
                                    type="hidden"
                                    name="csrf"
                                    value="<?php echo e(csrf_token()); ?>">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo (int)$f['IdNovedad']; ?>">

                                <button class="btn btn-danger btn-sm" type="submit">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

<?php } ?>

<?php include '_footer.php'; ?>