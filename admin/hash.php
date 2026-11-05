<?php
// admin/hash.php - AYUDA para cambiar la clave. BORRAR este archivo después de usarlo.
// Abrilo en el navegador, escribí la clave nueva y pegá el hash en config.php (ADMIN_HASH).
$hash = '';
if (!empty($_POST['clave'])) { $hash = password_hash($_POST['clave'], PASSWORD_DEFAULT); }
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Generar hash</title></head><body style="font-family:Arial;padding:20px">
<h3>Generar hash de clave</h3>
<form method="post"><input type="text" name="clave" placeholder="Clave nueva" required> <button>Generar</button></form>
<?php if ($hash) { echo '<p>Copiá esto en <code>config.php</code>:</p><textarea rows="3" cols="80" readonly>' . htmlspecialchars($hash) . '</textarea>'; } ?>
<p style="color:#b00"><strong>Borrá este archivo del servidor cuando termines.</strong></p>
</body></html>
