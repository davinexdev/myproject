<?php
require 'db.php';
require 'authenticate.php';

$stmt = $pdo->query('SELECT c.id, p.nome AS paciente, m.nome AS medico, c.data_hora, c.motivo
                     FROM consultas c
                     JOIN pacientes p ON c.paciente_id = p.id
                     JOIN medicos m ON c.medico_id = m.id');
$consultas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Consultas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Lista de Consultas</h1>
        <nav>
            <ul>
                <li><a href="create_consulta.php">Criar consulta</a></li>
            </ul>
        </nav>
    </header>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Data e Hora</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?php echo htmlspecialchars($consulta['id']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['paciente']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['medico']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['data_hora']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['motivo']); ?></td>
                    <td>
                        <a href="update_consulta.php?id=<?php echo htmlspecialchars($consulta['id']); ?>">Editar</a>
                        <a href="delete_consulta.php?id=<?php echo htmlspecialchars($consulta['id']); ?>">Excluir</a>
                        <a href="../export_to_pdf.php?id=<?php echo htmlspecialchars($consulta['id']); ?>" target="_blank">Exportar PDF</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <footer>
        <p>&copy; 2024 Hospital</p>
    </footer>
    <a href="../index.php">Voltar para o início</a>
    <script src="script.js"></script>
</body>

</html>