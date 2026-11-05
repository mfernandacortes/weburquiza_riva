<?php /* admin/_header.php - encabezado común. Usar: $titulo = '...'; include '_header.php'; */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($titulo ?? 'Panel'); ?> - Panel de administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Panel de administración</a>
    <?php if (esta_logueado()) { ?>
      <a class="btn btn-outline-light btn-sm" href="logout.php">Cerrar sesión</a>
    <?php } ?>
  </div>
</nav>
<div class="container pb-5">
