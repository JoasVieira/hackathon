<?php
if (!isset($_SESSION['admin']['id'])) exit;

if ($_POST) {
  include "libs/docs.php";

  foreach ($_POST as $key => $value) {
    $$key = trim($value);
  }

  if (empty($cor)) {
    mensagem("Erro", "Preencha a cor", "error");
    exit;
  }

  if (empty($id)) {
    $sql = "insert into cor values(NULL, :cor)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":cor", $cor);
  } else {
    $sql = "update cor set cor = :cor where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":cor", $cor);
    $consulta->bindParam(":id", $id);
  }

  if ($consulta->execute()) {
    redirect("Salvo", "Registro salvo com sucesso", "success", "listar/cores");
    exit;
  }

  mensagem("Erro", "Erro ao salvar", "error");
  exit;
}

mensagem("Erro", "Requisição inválida", "error");
