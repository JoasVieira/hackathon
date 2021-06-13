<?php
if (!isset($_SESSION['admin']['id'])) exit;

include "libs/docs.php";

if (empty($id)) {
  mensagem("Erro", "Preencha", "Requisição Inválida - ID inválido", 'error');
  exit;
}

$sql = "delete from veiculo where id = :id limit 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(':id', $id);

if ($consulta->execute()) {
  mensagem("Sucesso", "Registro excluído com sucesso", "success");
  exit;
}

mensagem("Erro", "Erro ao excluir registro", "error");
