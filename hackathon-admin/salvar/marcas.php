<?php
if (!isset($_SESSION['admin']['id'])) exit;

if ($_POST) {
  include "libs/docs.php";

  foreach ($_POST as $key => $value) {
    $$key = trim($value);
  }

  if (empty($marca)) {
    mensagem("Erro", "Preencha a marca", "error");
    exit;
  }

  if (empty($id)) {
    $sql = "insert into marca values(NULL, :marca)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":marca", $marca);
  } else {
    $sql = "update marca set marca = :marca where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":marca", $marca);
    $consulta->bindParam(":id", $id);
  }

  if ($consulta->execute()) {
    redirect("Salvo", "Registro salvo com sucesso", "success", "listar/marcas");
    exit;
  }

  mensagem("Erro", "Erro ao salvar", "error");
  exit;
}

mensagem("Erro", "Requisição inválida", "error");
