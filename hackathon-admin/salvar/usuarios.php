<?php
if (!isset($_SESSION['admin']['id'])) exit;

if ($_POST) {
  include "libs/docs.php";

  foreach ($_POST as $key => $value) {
    $$key = trim($value);
  }

  if (empty($login)) {
    mensagem("Erro", "Preencha o login", "error");
    exit;
  } else if ($senha != $redigite) {
    mensagem("Erro", "As senhas digitadas não são iguais", "error");
    exit;
  }

  if (empty($id)) {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "insert into usuario values(NULL, :login, :nome, :senha)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":login", $login);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":senha", $senha);
  } else {
    $s = NULL;

    if (!empty($senha)) {
      $senha = password_hash($senha, PASSWORD_DEFAULT);
      $s = ", senha = :senha ";
    }

    $sql = "update usuario set
          login = :login,
    			nome = :nome
    			$s
    			where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":login", $login);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":id", $id);

    if (!empty($s)) {
      $consulta->bindParam(":senha", $senha);
    }
  }

  if ($consulta->execute()) {
    redirect("Salvo", "Registro salvo com sucesso", "success", "listar/usuarios");
    exit;
  }

  mensagem("Erro", "Erro ao salvar", "error");
  exit;
}

mensagem("Erro", "Requisição inválida", "error");
