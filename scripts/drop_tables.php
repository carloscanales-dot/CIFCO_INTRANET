<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'dbcifconet';
$user = 'ccanales';
$pass = 'Arrup32020';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$tables = ['users', 'areas', 'cargos'];
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    foreach ($tables as $t) {
        echo "Dropping table if exists: $t\n";
        $pdo->exec("DROP TABLE IF EXISTS `$t`");
    }
    echo "Done.\n";
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    exit(1);
}
