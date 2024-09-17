<?php
require 'db.php';
require 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM pacientes WHERE id = ?');
$stmt->execute([$id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);
$imagem_id = $paciente['imagem_id'];
$imagem_path = null;

if ($imagem_id) {
    $stmt = $pdo->prepare('SELECT path FROM imagens WHERE id = ?');
    $stmt->execute([$imagem_id]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagem_path = $imagem['path'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];


    if (!empty($_FILES['imagem']['name'])) {
        if ($imagem_path) {
            $caminhoImagemAntiga = __DIR__ . '/../storage/' . $imagem_path;
            if (file_exists($caminhoImagemAntiga)) {
                unlink($caminhoImagemAntiga);
            }
        }

        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = __DIR__ . '/../storage/' . $novoNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $stmt = $pdo->prepare('INSERT INTO imagens (path) VALUES (?)');
            $stmt->execute([$novoNome]);
            $nova_imagem_id = $pdo->lastInsertId();
            $stmt = $pdo->prepare('UPDATE pacientes SET imagem_id = ? WHERE id = ?');
            $stmt->execute([$nova_imagem_id, $id]);
        }
    }

    $stmt = $pdo->prepare('UPDATE pacientes SET nome = ?, data_nascimento = ?, genero = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?');
    $stmt->execute([$nome, $data_nascimento, $genero, $endereco, $telefone, $email, $id]);

    header('Location: read.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Editar Paciente</h1>
    <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($paciente['nome']); ?>" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($paciente['data_nascimento']); ?>" required><br>

        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
            <option value="Masculino" <?php if ($paciente['genero'] == 'Masculino') {
                                            echo 'selected';
                                        } ?>>Masculino</option>
            <option value="Feminino" <?php if ($paciente['genero'] == 'Feminino') {
                                            echo 'selected';
                                        } ?>>Feminino</option>
        </select><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($paciente['endereco']); ?>"><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($paciente['telefone']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($paciente['email']); ?>"><br>

        <label for="imagem">Foto do paciente:</label>
        <?php if ($imagem_path): ?>
            <img src="../storage/<?php echo htmlspecialchars($imagem_path); ?>" alt="Imagem do Paciente" style="max-width: 150px; max-height: 150px;"><br>
        <?php endif; ?>
        <input type="file" id="imagem" name="imagem" accept="image/*"><br>

        <input type="submit" value="Atualizar">
    </form>
    <a href="read.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html>