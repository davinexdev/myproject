<?php
session_start();
include 'php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $sql = 'SELECT password_hash FROM usuarios WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            echo 'Nome de usuário ou senha incorretos.';
        }
    } else {
        echo 'Por favor, preencha todos os campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Login Administrativo</h1>
    <form method="post" action="">
        <label for="username">Nome de usuário:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <a href="register.php">Registro</a>
</body>

</html>