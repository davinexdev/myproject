<?php
require 'db.php';
require 'authenticate.php';

$id = $_GET['id'];


$stmt = $pdo->prepare('SELECT imagem_id FROM pacientes WHERE id = ?');
$stmt->execute([$id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($paciente) {
    $imagem_id = $paciente['imagem_id'];

    if ($imagem_id) {
        $stmt = $pdo->prepare('SELECT path FROM imagens WHERE id = ?');
        $stmt->execute([$imagem_id]);
        $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($imagem) {
            $caminhoImagem = __DIR__ . '/../storage/' . $imagem['path'];

            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }

            $stmt = $pdo->prepare('DELETE FROM imagens WHERE id = ?');
            $stmt->execute([$imagem_id]);
        }
    }

    $stmt = $pdo->prepare('DELETE FROM pacientes WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: read.php');
exit;
