<?php
require 'php/authenticate.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Crud de Pacientes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Bem-vindo ao CRUD Hospitalar by DaviDev</h1>
        <nav>
            <ul>
                <li><a href="php/create.php">Adicionar Paciente</a></li>
                <li><a href="php/read.php">Lista de Pacientes</a></li>
                <li><a href="php/create_medicos.php">Adicionar medicos</a></li>
                <li><a href="php/read_medicos.php">Lista de Medicos</a></li>
                <li><a href="php/create_consulta.php">Criar consulta</a></li>
                <li><a href="php/read_consultas.php">Lista de consultas</a></li>

            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; 2024 Hospital</p>
    </footer>
    <script src="script.js"></script>
    <a href="logout.php">Logout</a>
</body>

</html>