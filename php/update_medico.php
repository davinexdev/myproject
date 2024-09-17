<?php
require 'db.php';
require 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $stmt = $pdo->prepare('UPDATE medicos SET nome = ?, especialidade = ?, telefone = ?, email = ? WHERE id = ?');
    $stmt->execute([$nome, $especialidade, $telefone, $email, $id]);

    header('Location: read_medicos.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM medicos WHERE id = ?');
$stmt->execute([$id]);
$medico = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Editar Médico</h1>
    <form action="update_medico.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($medico['id']); ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($medico['nome']); ?>" required><br>

        <label for="especialidade">Especialidade:</label>
        <input type="text" id="especialidade" name="especialidade" value="<?php echo htmlspecialchars($medico['especialidade']); ?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($medico['telefone']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($medico['email']); ?>"><br>

        <input type="submit" value="Atualizar">
    </form>
    <a href="read_medicos.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html>