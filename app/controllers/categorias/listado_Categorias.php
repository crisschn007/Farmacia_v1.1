<?php
require_once __DIR__ . '/../../conexionDB.php';

$sql_categoria = "SELECT * FROM categoria";
$query_categoria = $pdo->prepare($sql_categoria);
$query_categoria->execute();
$categoria_datos = $query_categoria->fetchAll(PDO::FETCH_ASSOC);