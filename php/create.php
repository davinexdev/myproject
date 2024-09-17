<?php
require 'db.php';
require 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $imagem_id = null;

    if (!empty($_FILES['imagem']['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = __DIR__ . '/../storage/' . $novoNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $stmt = $pdo->prepare("INSERT INTO imagens (path) VALUES (?)");
            $stmt->execute([$novoNome]);
            $imagem_id = $pdo->lastInsertId();
        }
    }

    $stmt = $pdo->prepare('INSERT INTO pacientes (nome, data_nascimento, genero, endereco, telefone, email, imagem_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nome, $data_nascimento, $genero, $endereco, $telefone, $email, $imagem_id]);

    header('Location: read.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Paciente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Adicionar Paciente</h1>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br>

        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco"><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="imagem">Foto do paciente:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*"><br>

        <input type="submit" value="Adicionar">
    </form>
    <a href="../index.php">Inicio |</a>
    <a href="read.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html