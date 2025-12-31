<?php
require_once __DIR__ . '/../../conexionDB.php';

$sql_clientes = "SELECT * FROM clientes;";
$datos_clientes = $pdo->prepare($sql_clientes);
$datos_clientes->execute();
$db_clientes = $datos_clientes->fetchAll(PDO::FETCH_ASSOC);