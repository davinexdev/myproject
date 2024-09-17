<?php
require 'db.php';
require 'authenticate.php';

$stmt = $pdo->query('
    SELECT pacientes.*, imagens.path AS imagem_path
    FROM pacientes
    LEFT JOIN imagens ON pacientes.imagem_id = imagens.id
');
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Lista de Pacientes</h1>
        <nav>
            <ul>
                <li><a href="create.php">Adicionar Paciente</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <table id="tabela-pacientes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Gênero</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($paciente['id']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['data_nascimento']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['genero']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['endereco']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($paciente['email']); ?></td>
                        <td>
                            <?php if ($paciente['imagem_path']) { ?>
                                <img src="../storage/<?php echo htmlspecialchars($paciente['imagem_path']); ?>" alt="Imagem do paciente" style="max-width: 100px; max-height: 100px;">
                            <?php } else { ?>
                                Paciente sem foto
                            <?php } ?>
                        </td>
                        <td>
                            <a href="update.php?id=<?php echo $paciente['id']; ?>">Editar</a>
                            <a href="delete.php?id=<?php echo $paciente['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Hospital</p>
    </footer>
    <script src="script.js"></script>
    <a href="../index.php">Voltar para a tela inicial</a>
</body>

</html