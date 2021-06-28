<?php
if (!isset($_SESSION['admin']['id'])) exit;

include "libs/docs.php";

if (empty($id)) {
  mensagem("Erro", "Preencha", "Requisição Inválida - ID inválido", 'error');
  exit;
}

$sql = "select cor_id from veiculo
        where cor_id = :id limit 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(':id', $id);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

if (!empty($dados->cor_id)) {
  mensagem("Erro", "O registro não pode ser excluído pois existe um veículo vinculada a ele", "error");
  exit;
}

$sql = "delete from cor where id = :id limit 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(':id', $id);

if ($consulta->execute()) {
  mensagem("Sucesso", "Registro excluído com sucesso", "success");
  exit;
}

mensagem("Erro", "Erro ao excluir registro", "error");
