<?php
require 'db.php';
require 'authenticate.php';

$stmt = $pdo->query('SELECT * FROM medicos');
$medicos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Médicos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Lista de Medicos</h1>
        <nav>
            <ul>
                <li><a href="create_medicos.php">Adicionar Medicos</a></li>
            </ul>
        </nav>
    </header>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicos as $medico): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medico['id']); ?></td>
                    <td><?php echo htmlspecialchars($medico['nome']); ?></td>
                    <td><?php echo htmlspecialchars($medico['especialidade']); ?></td>
                    <td><?php echo htmlspecialchars($medico['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($medico['email']); ?></td>
                    <td>
                        <a href="update_medico.php?id=<?php echo htmlspecialchars($medico['id']); ?>">Editar</a>
                        <a href="delete_medico.php?id=<?php echo htmlspecialchars($medico['id']); ?>">Excluir</a>
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

</html