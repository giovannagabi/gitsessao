<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT);
    $email = $_POST["email"];
    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=autenticacao", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOExcption $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }

    // Insira os dados na tabela 'users'
    $stmt = $pdo->prpare("INSERT INTO usuarios (usuario, senha, email) VALUES (?, ?, ?)");

    $_SESSION["usuario"] = $usuario;
    header("Location: deshboard.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post">
        <input type="text" name="usuario" placeholder="Nom de Usuário" required><br>
        <input type="passaword" name="senha" placeholder="Senha" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="submit" value= "Cadastrar">
    </form>
</body>
</html>