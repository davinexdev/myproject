<?php
require 'db.php';
require 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $paciente_id = $_POST['paciente_id'];
    $medico_id = $_POST['medico_id'];
    $data_hora = $_POST['data_hora'];
    $motivo = $_POST['motivo'];
    $stmt = $pdo->prepare('UPDATE consultas SET paciente_id = ?, medico_id = ?, data_hora = ?, motivo = ? WHERE id = ?');
    $stmt->execute([$paciente_id, $medico_id, $data_hora, $motivo, $id]);

    header('Location: read_consultas.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM consultas WHERE id = ?');
$stmt->execute([$id]);
$consulta = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Consulta</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Editar Consulta</h1>
    <form action="update_consulta.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($consulta['id']); ?>">

        <label for="paciente_id">Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>
            <?php
            $stmt = $pdo->query('SELECT * FROM pacientes');
            while ($paciente = $stmt->fetch()) {
                $selected = ($paciente['id'] == $consulta['paciente_id']) ? 'selected' : '';
                echo "<option value=\"{$paciente['id']}\" $selected>{$paciente['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="medico_id">Médico:</label>
        <select id="medico_id" name="medico_id" required>
            <?php
            $stmt = $pdo->query('SELECT * FROM medicos');
            while ($medico = $stmt->fetch()) {
                $selected = ($medico['id'] == $consulta['medico_id']) ? 'selected' : '';
                echo "<option value=\"{$medico['id']}\" $selected>{$medico['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="data_hora">Data e Hora:</label>
        <input type="datetime-local" id="data_hora" name="data_hora" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($consulta['data_hora']))); ?>" required><br>

        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo"><?php echo htmlspecialchars($consulta['motivo']); ?></textarea><br>

        <input type="submit" value="Atualizar">
    </form>
    <a href="read_consultas.php">Voltar para a lista</a>
    <script src="script.js"></script>
</body>

</html>