<?php
require_once 'config.php';

if (esta_logueado()) { header('Location: index.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    if (hash_equals(ADMIN_USER, $usuario) && password_verify($clave, ADMIN_HASH)) {
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    }
    sleep(1); // frena intentos repetidos
    $error = 'Usuario o clave incorrectos.';
}

$titulo = 'Ingresar';
include '_header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5 col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-3">Ingresar</h4>
        <?php if ($error) { ?><div class="alert alert-danger"><?php echo e($error); ?></div><?php } ?>
        <form method="post" autocomplete="off">
          <div class="mb-3">
            <label class="form-label" for="usuario">Usuario</label>
            <input class="form-control" type="text" id="usuario" name="usuario" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label" for="clave">Clave</label>
            <input class="form-control" type="password" id="clave" name="clave" required>
          </div>
          <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '_footer.php'; ?>
