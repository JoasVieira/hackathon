<?php
session_start();

if ($_POST) {
  $login = trim($_POST['login'] ?? NULL);
  $senha = trim($_POST['senha'] ?? NULL);

  if (empty($login)) {
    echo "<script>alert('Digite um login');history.back();</script>";
    exit;
  } else if (empty($senha)) {
    echo "<script>alert('Digite uma senha');history.back();</script>";
    exit;
  }

  include "libs/conectar.php";

  $sql = "select * from usuario where login = :login limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(':login', $login);
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  if (!isset($dados->nome)) {
    echo "<script>alert('Usuário inexistente');history.back();</script>";
    exit;
  } else if (!password_verify($senha, $dados->senha)) {
    echo "<script>alert('Usuário ou senha incorretos');history.back();</script>";
    exit;
  }

  $_SESSION["admin"] = array(
    "id" => $dados->id,
    "nome" => $dados->nome,
    "login" => $dados->login
  );
  header("Location: paginas/home");
  exit;
}

echo "<script>alert('Requisição inválida, preencha os dados do formulário');history.back();</script>";
