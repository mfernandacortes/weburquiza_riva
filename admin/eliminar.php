<?php
require_once 'config.php';
requerir_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_ok()) {
    flash('Solicitud no válida.');
    header('Location: index.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$modelo = new Novedades();
$novedad = $modelo->obtener($id);

if ($novedad) {
    borrar_archivo($novedad['archivo']);   // borra también el archivo adjunto
    $modelo->eliminar($id);
    flash('La novedad fue eliminada.');
} else {
    flash('No se encontró la novedad.');
}
header('Location: index.php');
exit;
