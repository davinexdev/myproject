<?php
include 'php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = 'INSERT INTO usuarios (username, password_hash) VALUES (?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password_hash]);

        echo 'Usuário registrado com sucesso!';
    } else {
        echo 'Por favor, preencha todos os campos.';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Registro Administrativo</h1>
    <form method="post" action="">
        <label for="username">Nome de usuário:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
    <a href="login.php">Faça o login</a>
</body>

</html>