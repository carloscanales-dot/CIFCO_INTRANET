<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'dbcifconet';
$user = 'ccanales';
$pass = 'Arrup32020';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in $db:\n";
    foreach ($tables as $t) {
        echo "- $t\n";
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    exit(1);
}
