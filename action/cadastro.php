<?php
include('../db/conexao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; 

    $senha_hashed = md5($senha);

    $sql = "INSERT INTO usuarios (nome, email, senha) values ('$nome', '$email', '$senha_hashed')";

    if ($conn->query($sql) === TRUE) {
        header("location: ../views/login.html");
        } else {
            echo "Erro ao cadastro usuarios." . $conn->error;
    }

}
?>