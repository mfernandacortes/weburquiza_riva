<?php
// Sirve para CREAR (form.php) y para EDITAR (form.php?id=5)
require_once 'config.php';
requerir_login();

$modelo = new Novedades();
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

$actual = null;

if ($id) {
    $actual = $modelo->obtener($id);

    if (!$actual) {
        flash('No se encontró la novedad.');
        header('Location: index.php');
        exit;
    }
}

// Valores que se muestran en el formulario
$datos = [
    'tipo'        => $actual['tipo'] ?? Novedades::TIPOS[0],
    'titulo'      => $actual['titulo'] ?? '',
    'ciclo_fecha' => $actual['ciclo_fecha'] ?? '',
    'detalle'     => $actual['detalle'] ?? '',
    'activo'      => (int)($actual['activo'] ?? 0),
];

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        $errores[] = 'La sesión expiró, volvé a intentar.';
    }

    $datos['tipo']        = $_POST['tipo'] ?? '';
    $datos['titulo']      = trim($_POST['titulo'] ?? '');
    $datos['ciclo_fecha'] = trim($_POST['ciclo_fecha'] ?? '');
    $datos['detalle']     = trim($_POST['detalle'] ?? '');
    $datos['activo']      = isset($_POST['activo']) ? 1 : 0;

    if (!in_array($datos['tipo'], Novedades::TIPOS, true)) {
        $errores[] = 'Elegí un tipo válido.';
    }

    if ($datos['titulo'] === '') {
        $errores[] = 'El título es obligatorio.';
    }

    if (mb_strlen($datos['titulo']) > 200) {
        $errores[] = 'El título es demasiado largo (máx. 200).';
    }

    if ($datos['ciclo_fecha'] === '') {
        $errores[] = 'El ciclo lectivo / fecha es obligatorio.';
    }

    if (mb_strlen($datos['ciclo_fecha']) > 100) {
        $errores[] = 'El ciclo / fecha es demasiado largo (máx. 100).';
    }

    if ($datos['detalle'] === '') {
        $errores[] = 'El detalle es obligatorio.';
    }

    $archivo_actual = $actual['archivo'] ?? null;
    $archivo_final  = $archivo_actual;
    $archivo_nuevo  = null;

    if (!$errores) {
        $err_archivo = '';
        $subido = subir_archivo('archivo', $err_archivo);

        if ($subido === false) {
            $errores[] = $err_archivo;
        } elseif ($subido !== null) {
            $archivo_nuevo = $subido;
            $archivo_final = $subido;
        } elseif (!empty($_POST['quitar_archivo'])) {
            $archivo_final = null;
        }
    }

    if (!$errores) {

        if ($id) {
            $modelo->actualizar(
                $id,
                $datos['tipo'],
                $datos['titulo'],
                $datos['ciclo_fecha'],
                $datos['detalle'],
                $archivo_final,
                $datos['activo']
            );

            flash('Novedad actualizada.');

        } else {
            $modelo->crear(
                $datos['tipo'],
                $datos['titulo'],
                $datos['ciclo_fecha'],
                $datos['detalle'],
                $archivo_final,
                $datos['activo']
            );

            flash('Novedad creada.');
        }

        // Si se reemplazó o quitó el archivo, borrar el anterior
        if ($archivo_actual && $archivo_actual !== $archivo_final) {
            borrar_archivo($archivo_actual);
        }

        header('Location: index.php');
        exit;
    }

    // Si hubo error después de subir un archivo nuevo,
    // no dejarlo huérfano
    if (!empty($archivo_nuevo)) {
        borrar_archivo($archivo_nuevo);
    }
}

$titulo = $id ? 'Editar novedad' : 'Nueva novedad';

include '_header.php';
?>

<h3 class="mb-3"><?php echo e($titulo); ?></h3>

<?php if ($errores) { ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $er) { ?>
                <li><?php echo e($er); ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<form method="post" enctype="multipart/form-data" class="card card-body shadow-sm">

    <input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" name="id" value="<?php echo (int)$id; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_BYTES; ?>">

    <?php if ($id) { ?>
        <p class="text-muted mb-3">
            ID de la novedad: <strong><?php echo (int)$id; ?></strong>
        </p>
    <?php } ?>

    <div class="mb-3">
        <label class="form-label" for="tipo">Tipo</label>

        <select class="form-select" id="tipo" name="tipo" required>
            <?php foreach (Novedades::TIPOS as $t) { ?>
                <option
                    value="<?php echo e($t); ?>"
                    <?php echo $t === $datos['tipo'] ? 'selected' : ''; ?>>
                    <?php echo e($t); ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="titulo">Título</label>

        <input
            class="form-control"
            type="text"
            id="titulo"
            name="titulo"
            maxlength="200"
            required
            value="<?php echo e($datos['titulo']); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label" for="ciclo_fecha">
            Ciclo lectivo / Fecha
        </label>

        <input
            class="form-control"
            type="text"
            id="ciclo_fecha"
            name="ciclo_fecha"
            maxlength="100"
            required
            placeholder="Ej: 2026 ó Agosto/Septiembre 2026 ó Hasta el 4/9/2026"
            value="<?php echo e($datos['ciclo_fecha']); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label" for="detalle">Detalle</label>

        <textarea
            class="form-control"
            id="detalle"
            name="detalle"
            rows="8"
            required><?php echo e($datos['detalle']); ?></textarea>
    </div>

    <!-- Campo Activo -->
    <div class="mb-3">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                id="activo"
                name="activo"
                value="1"
                <?php echo $datos['activo'] === 1 ? 'checked' : ''; ?>>

            <label class="form-check-label" for="activo">
                Activo
            </label>
        </div>

        <div class="form-text">
            Si está marcado, la novedad queda activa.
            Si no está marcado, queda inactiva.
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="archivo">
            Archivo (opcional: PDF o imagen, hasta 5 MB)
        </label>

        <input
            class="form-control"
            type="file"
            id="archivo"
            name="archivo"
            accept=".pdf,.jpg,.jpeg,.png,.webp,application/pdf,image/*">

        <?php if (!empty($actual['archivo'])) { ?>
            <div class="form-text mt-2">
                Archivo actual:
                <a
                    href="<?php echo e(UPLOAD_URL . $actual['archivo']); ?>"
                    target="_blank"
                    rel="noopener">ver</a>.

                Si elegís otro, lo reemplaza.
            </div>

            <div class="form-check mt-1">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="quitar_archivo"
                    name="quitar_archivo"
                    value="1">

                <label class="form-check-label" for="quitar_archivo">
                    Quitar el archivo actual
                </label>
            </div>
        <?php } ?>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary" type="submit">
            <?php echo $id ? 'Guardar cambios' : 'Crear novedad'; ?>
        </button>

        <a class="btn btn-outline-secondary" href="index.php">
            Cancelar
        </a>
    </div>

</form>

<?php include '_footer.php'; ?>