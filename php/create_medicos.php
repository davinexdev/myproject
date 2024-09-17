<?php
require 'db.php';
require 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('INSERT INTO medicos (nome, especialidade, telefone, email) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nome, $especialidade, $telefone, $email]);

    header('Location: read_medicos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Médico</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Adicionar Médico</h1>
    <form action="create_medicos.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="especialidade">Especialidade:</label>
        <input type="text" id="especialidade" name="especialidade" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <input type="submit" value="Adicionar">
    </form>
    <a href="../index.php">Inicio |</a>
    <a href="read.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html