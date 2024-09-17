<?php

$host = 'localhost';
$port = '3306';
$dbname = 'hospital';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Erro na conexão com o banco de dados: '.$e->getMessage());
}
