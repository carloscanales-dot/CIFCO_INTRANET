<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'dbcifconet';
$user = 'ccanales';
$pass = 'Arrup32020';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Obtener el id desde la URL
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("Error: No se recibió ID");
    }

    // Usuario
    $stmt = $pdo->prepare("SELECT id, name, email, sexo, area_id, cargo_id FROM users WHERE id=? LIMIT 1");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "User:\n";
    print_r($user);

    // Área
    $stmt = $pdo->prepare("SELECT * FROM areas WHERE id = ?");
    $stmt->execute([$user['area_id'] ?? null]);
    echo "Area:\n";
    print_r($stmt->fetch(PDO::FETCH_ASSOC));

    // Cargo
    $stmt = $pdo->prepare("SELECT * FROM cargos WHERE id = ?");
    $stmt->execute([$user['cargo_id'] ?? null]);
    echo "Cargo:\n";
    print_r($stmt->fetch(PDO::FETCH_ASSOC));

    // Roles
    $stmt = $pdo->prepare("SELECT * FROM model_has_roles WHERE model_type = 'App\\\\Models\\\\User' AND model_id = ?");
    $stmt->execute([$user['id'] ?? 0]);
    echo "model_has_roles:\n";
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    exit(1);
}
