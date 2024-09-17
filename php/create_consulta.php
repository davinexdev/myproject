<?php
require 'db.php';
require 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $medico_id = $_POST['medico_id'];
    $data_hora = $_POST['data_hora'];
    $motivo = $_POST['motivo'];
    $stmt = $pdo->prepare('INSERT INTO consultas (paciente_id, medico_id, data_hora, motivo) VALUES (?, ?, ?, ?)');
    $stmt->execute([$paciente_id, $medico_id, $data_hora, $motivo]);

    header('Location: read_consultas.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Consulta</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Adicionar Consulta</h1>
    <form action="create_consulta.php" method="POST">
        <label for="paciente_id">Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>
            <?php
            $stmt = $pdo->query('SELECT * FROM pacientes');
            while ($paciente = $stmt->fetch()) {
                echo "<option value=\"{$paciente['id']}\">{$paciente['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="medico_id">Médico:</label>
        <select id="medico_id" name="medico_id" required>
            <?php
            $stmt = $pdo->query('SELECT * FROM medicos');
            while ($medico = $stmt->fetch()) {
                echo "<option value=\"{$medico['id']}\">{$medico['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="data_hora">Data e Hora:</label>
        <input type="datetime-local" id="data_hora" name="data_hora" required><br>

        <label for="motivo">Descrição:</label>
        <textarea id="motivo" name="motivo"></textarea><br>

        <input type="submit" value="Adicionar Consulta">
    </form>
    <a href="../index.php">Inicio |</a>
    <a href="read.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html>