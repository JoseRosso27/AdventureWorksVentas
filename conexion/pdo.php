<?php
$server = "LAPTOP-6M7TET7Q";
$username = "rosso";
$password = "123";
$database = "AdventureWorks";

try {
    $pdo = new PDO("sqlsrv:Server=$server;Database=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>