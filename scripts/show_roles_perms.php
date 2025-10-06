<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'dbcifconet';
$user = 'ccanales';
$pass = 'Arrup32020';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $tables = ['roles', 'permissions', 'role_has_permissions', 'model_has_roles'];
    foreach ($tables as $t) {
        echo "\nTable: $t\n";
        $stmt = $pdo->query("SELECT * FROM `$t` LIMIT 50");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            print_r($r);
        }
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    exit(1);
}
