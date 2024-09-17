<?php
require 'db.php';
require 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM medicos WHERE id = ?');
$stmt->execute([$id]);

header('Location: read_medicos.php');
exit;
