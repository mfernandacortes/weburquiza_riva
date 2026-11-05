<?php
$base = '../';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
// Nota: header.php / navbar.php ya abren <body> y #page-wrapper,
// y footer_maps.php los cierra, por eso no se repiten acá.
?>

<style>
/* Diseño limitado a la página de modalidades */
#modalidades .mod-volver {
    display: inline-block;
    margin-bottom: 18px;
    padding: 8px 16px;
    background: #fff;
    color: #234a73;
    font-size: .9em;
    font-weight: 600;
    border: 1px solid #e1e6ec;
    border-radius: 8px;
    text-decoration: none;
    transition: background .15s, box-shadow .15s;
}
#modalidades .mod-volver:hover {
    background: #f3f6fa;
    color: #17365d;
    box-shadow: 0 3px 10px rgba(0,0,0,.08);
}
#modalidades .mod-intro {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 36px;
    color: #6b7280;
}
#modalidades .mod-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    align-items: stretch;
}
#modalidades .mod-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #e1e6ec;
    border-radius: 14px;
    overflow: hidden;
    text-align: left;
    transition: transform .2s ease, box-shadow .2s ease;
}
#modalidades .mod-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(0,0,0,.10);
}
#modalidades .mod-banda {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #17365d, #4776a5);
    color: #fff;
}
#modalidades .mod-banda .icon:before {
    font-size: 2.6rem;
    color: #fff;
}
#modalidades .mod-cuerpo {
    padding: 16px 20px 22px;
}
#modalidades .mod-etiqueta {
    font-size: .75em;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: #3b6ea5;
}
#modalidades .mod-cuerpo h3 {
    margin: 4px 0 10px;
    font-size: 1.3em;
    line-height: 1.3;
    color: #111827;
}
#modalidades .mod-cuerpo p {
    margin: 0;
    line-height: 1.65;
}
@media screen and (max-width: 736px) {
    #modalidades .mod-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Main -->
<section class="wrapper style1" id="modalidades">
	<div class="container">

		<a class="mod-volver" href="<?= $base ?>index.php">&larr; Volver al inicio</a>
        
		<header class="major">
			<h2>Modalidades</h2>
		</header>

		<p class="mod-intro">
			Conocé las orientaciones que ofrece nuestra escuela.
		</p>

		<div class="mod-grid">

			<article class="mod-card">
				<div class="mod-banda">
					<span class="icon solid fa-laptop-code" aria-hidden="true"></span>
				</div>
				<div class="mod-cuerpo">
					<div class="mod-etiqueta">Modalidad</div>
					<h3>Informática</h3>
					<p>
						Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus.
						Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat.
					</p>
				</div>
			</article>

			<article class="mod-card">
				<div class="mod-banda">
					<span class="icon solid fa-chart-line" aria-hidden="true"></span>
				</div>
				<div class="mod-cuerpo">
					<div class="mod-etiqueta">Modalidad</div>
					<h3>Economía y Administración</h3>
					<p>
						Escribí acá la descripción de la modalidad.
					</p>
				</div>
			</article>

		</div>
	</div>
</section>
<!-- fin Main -->

<!-- footer -->
<?php include __DIR__ . '/../includes/footer_maps.php'; ?>