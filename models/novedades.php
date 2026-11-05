<?php
// models/novedades.php
require_once __DIR__ . '/conexion.php';

class Novedades extends Conexion
{
    // Tipos permitidos
    const TIPOS = ['Inscripciones', 'Mesas de examen', 'Avisos', 'Otros'];

    private function db()
    {
        $pdo = $this->get_conexion();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES utf8mb4");
        return $pdo;
    }

    // Listar todas las novedades para el ABM
    public function listar($tipo = null)
    {
        $sql = "SELECT * FROM novedades";
        $params = [];

        if ($tipo) {
            $sql .= " WHERE tipo = :tipo";
            $params['tipo'] = $tipo;
        }

        $sql .= " ORDER BY IdNovedad DESC";

        $st = $this->db()->prepare($sql);
        $st->execute($params);

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar solamente las novedades activas para la página pública
    public function listarActivas()
    {
        $sql = "SELECT *
                FROM novedades
                WHERE activo = 1
                ORDER BY IdNovedad DESC";

        $st = $this->db()->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una novedad por ID
    public function obtener($id)
    {
        $st = $this->db()->prepare(
            "SELECT * FROM novedades WHERE IdNovedad = :id"
        );

        $st->execute(['id' => (int)$id]);

        $fila = $st->fetch(PDO::FETCH_ASSOC);

        return $fila ?: null;
    }

    // Crear una novedad
    public function crear($tipo, $titulo, $ciclo_fecha, $detalle, $archivo, $activo = 0)
    {
        $pdo = $this->db();

        $st = $pdo->prepare(
            "INSERT INTO novedades
                (tipo, titulo, ciclo_fecha, detalle, archivo, activo)
             VALUES
                (:tipo, :titulo, :ciclo_fecha, :detalle, :archivo, :activo)"
        );

        $st->execute([
            'tipo'        => $tipo,
            'titulo'      => $titulo,
            'ciclo_fecha' => $ciclo_fecha,
            'detalle'     => $detalle,
            'archivo'     => $archivo,
            'activo'      => (int)$activo
        ]);

        return $pdo->lastInsertId();
    }

    // Actualizar una novedad
    public function actualizar($id, $tipo, $titulo, $ciclo_fecha, $detalle, $archivo, $activo)
    {
        $st = $this->db()->prepare(
            "UPDATE novedades
                SET tipo = :tipo,
                    titulo = :titulo,
                    ciclo_fecha = :ciclo_fecha,
                    detalle = :detalle,
                    archivo = :archivo,
                    activo = :activo
              WHERE IdNovedad = :id"
        );

        return $st->execute([
            'tipo'        => $tipo,
            'titulo'      => $titulo,
            'ciclo_fecha' => $ciclo_fecha,
            'detalle'     => $detalle,
            'archivo'     => $archivo,
            'activo'      => (int)$activo,
            'id'          => (int)$id
        ]);
    }

    // Eliminar una novedad
    public function eliminar($id)
    {
        $st = $this->db()->prepare(
            "DELETE FROM novedades WHERE IdNovedad = :id"
        );

        return $st->execute(['id' => (int)$id]);
    }


    
public function listarTipos($tipo = null)
{
    $sql = "SELECT *
            FROM novedades
            WHERE activo = 1";

    $params = [];

    if ($tipo !== null) {
        $sql .= " AND tipo = :tipo";
        $params['tipo'] = $tipo;
    }

    $sql .= " ORDER BY IdNovedad DESC";

    $st = $this->db()->prepare($sql);
    $st->execute($params);

    return $st->fetchAll(PDO::FETCH_ASSOC);
}

}