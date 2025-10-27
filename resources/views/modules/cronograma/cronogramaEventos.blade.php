<?php
header('Content-Type: application/json');

try {
    $dbPath = __DIR__ . '/../database/database.sqlite';

    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sentenciaSQL = $pdo->prepare("SELECT id, descripcion, fecha_inicio, fecha_fin FROM cronogramas");
    $sentenciaSQL->execute();
    $datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    $eventos = [];
    foreach ($datos as $row) {
        $eventos[] = [
            'id'    => $row['id'],
            'title' => $row['descripcion'],
            'start' => $row['fecha_inicio'],
            'end'   => $row['fecha_fin']
        ];
    }

    echo json_encode($eventos);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
