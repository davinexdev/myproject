<?php
require 'db.php';
require 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM consultas WHERE id = ?');
$stmt->execute([$id]);

header('Location: read_consultas.php');
exit;
