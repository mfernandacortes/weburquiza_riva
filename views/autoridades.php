<?php
$base = '../';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<!-- Columna derecha: Autoridades -->
<section class="col-12 col-12-narrower">
    <div class="box autoridades-box" style="text-align:center;">

        <h3 class="titulo-autoridades">
            <i class="bi bi-people-fill"></i>
            Autoridades institucionales
        </h3>

        <!-- Directora destacada -->
        <div class="box highlight directora-card">

            <div class="autoridad-icono directora-icono">
                <i class="bi bi-mortarboard-fill"></i>
            </div>

            <h3>Baroli, Mariana</h3>

            <span class="cargo-autoridad">
                <i class="bi bi-award-fill"></i>
                Directora
            </span>
        </div>

        <!-- Vicedirectoras -->
        <div class="row vicedirectoras">

            <section class="col-6 col-12-mobilep">
                <div class="vice-card">

                    <div class="autoridad-icono turno-tarde">
                        <i class="bi bi-sun-fill"></i>
                    </div>

                    <h4>Rodriguez, Elisa</h4>
                    <p>
                        <strong>Vicedirectora</strong><br>
                        <span>Turno Tarde</span>
                    </p>

                </div>
            </section>

            <section class="col-6 col-12-mobilep">
                <div class="vice-card">

                    <div class="autoridad-icono turno-noche">
                        <i class="bi bi-moon-stars-fill"></i>
                    </div>

                    <h4>Broda, Vanina</h4>
                    <p>
                        <strong>Vicedirectora</strong><br>
                        <span>Turno Noche</span>
                    </p>

                </div>
            </section>

        </div>
    </div>
</section>

<style>
.autoridades-box {
    border-radius: 14px;
    padding: 25px 20px;
}

.titulo-autoridades {
    color: #234a73;
    margin-bottom: 25px;
}

.titulo-autoridades i {
    margin-right: 8px;
}

.directora-card {
    border-radius: 12px;
    padding: 24px 15px;
    margin-bottom: 22px;
    border-top: 4px solid #234a73;
}

.autoridad-icono {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 1.7rem;
}

.directora-icono {
    background: #234a73;
    color: white;
}

.directora-card h3 {
    margin-bottom: 10px;
    color: #17365d;
}

.cargo-autoridad {
    display: inline-block;
    background: #eaf1f8;
    color: #234a73;
    border-radius: 20px;
    padding: 7px 14px;
    font-weight: 600;
}

.cargo-autoridad i {
    margin-right: 5px;
}

.vicedirectoras {
    row-gap: 20px;
}

.vice-card {
    height: 100%;
    padding: 18px 10px;
    border: 1px solid #e1e6ec;
    border-radius: 12px;
    background: #fafbfd;
}

.turno-tarde {
    background: #fff1d6;
    color: #a66a00;
}

.turno-noche {
    background: #e9e9f8;
    color: #5555a0;
}

.vice-card h4 {
    color: #234a73;
    font-size: 1rem;
    overflow-wrap: anywhere;
}

.vice-card p {
    margin-bottom: 0;
    line-height: 1.7;
}

.vice-card p span {
    color: #687586;
    font-size: .9rem;
}
</style>

			<!-- Fin Main -->

			<!-- Footer -->
<?php include __DIR__ . '/../includes/footer_maps.php'; ?>
