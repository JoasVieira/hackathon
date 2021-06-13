<?php
if (!isset($_SESSION['admin']['id'])) exit;

if ($_POST) {
  include "libs/docs.php";
  include "libs/imagem.php";


  foreach ($_POST as $key => $value) {
    $$key = trim($value);
  }

  $valor = formatarValor($valor);

  if ((empty($id)) and (empty($_FILES['foto']['name']))) {
    mensagem("Erro ao enviar imagem", "Selecione um arquivo JPG válido", "error");
  }

  if (!empty($_FILES['foto']['name'])) {
    $tamanho = $_FILES['foto']['size'];
    $t = 8 * 1024 * 1024;

    $foto = time();
    $usuario = $_SESSION['admin']['id'];

    $foto = "veiculo_{$foto}_{$usuario}";

    if ($_FILES['foto']['type'] != 'image/jpeg') {
      mensagem(
        "Erro ao enviar imagem",
        "O arquivo enviado não é um JPG válido, selecione um arquivo JPG",
        "error"
      );
    } else if ($tamanho > $t) {
      mensagem(
        "Erro ao enviar imagem",
        "O arquivo é muito grande e não pode ser enviado. Tente arquivos menores que 8 MB",
        "error"
      );
    } else if (!copy($_FILES['foto']['tmp_name'], '../src/main/resources/static/images/' . $_FILES['foto']['name'])) {
      mensagem(
        "Erro ao enviar imagem",
        "Não foi possível copiar o arquivo para o servidor",
        "error"
      );
    }

    $pastaFotos = '../src/main/resources/static/images/';
    loadImg(
      $pastaFotos . $_FILES['foto']['name'],
      $foto,
      $pastaFotos
    );
  }

  if (empty($id)) {

    $sql = "insert into veiculo
      values( NULL, :modelo, :anomodelo, :anofabricacao, :valor, :tipo, :foto, :marca_id, :cor_id, :usuario_id, :opcionais  )";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':modelo', $modelo);
    $consulta->bindParam(':anomodelo', $anomodelo);
    $consulta->bindParam(':anofabricacao', $anofabricacao);
    $consulta->bindParam(':valor', $valor);
    $consulta->bindParam(':tipo', $tipo);
    $consulta->bindParam(':foto', $foto);
    $consulta->bindParam(':marca_id', $marca_id);
    $consulta->bindParam(':cor_id', $cor_id);
    $consulta->bindParam(':usuario_id', $usuario_id);
    $consulta->bindParam(':opcionais', $opcionais);
  } else if (empty($foto)) {

    $sql = "update veiculo set
              modelo = :modelo, anomodelo = :anomodelo, anofabricacao = :anofabricacao, valor = :valor, tipo = :tipo, marca_id = :marca_id, cor_id = :cor_id, usuario_id = :usuario_id, opcionais = :opcionais
            where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':modelo', $modelo);
    $consulta->bindParam(':anomodelo', $anomodelo);
    $consulta->bindParam(':anofabricacao', $anofabricacao);
    $consulta->bindParam(':valor', $valor);
    $consulta->bindParam(':tipo', $tipo);
    $consulta->bindParam(':marca_id', $marca_id);
    $consulta->bindParam(':cor_id', $cor_id);
    $consulta->bindParam(':usuario_id', $usuario_id);
    $consulta->bindParam(':opcionais', $opcionais);
    $consulta->bindParam(':id', $id);
  } else {
    $sql = "update veiculo set
              modelo = :modelo, anomodelo = :anomodelo, anofabricacao = :anofabricacao, valor = :valor, tipo = :tipo, foto = :foto, marca_id = :marca_id, cor_id = :cor_id, usuario_id = :usuario_id, opcionais = :opcionais
            where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':modelo', $modelo);
    $consulta->bindParam(':anomodelo', $anomodelo);
    $consulta->bindParam(':anofabricacao', $anofabricacao);
    $consulta->bindParam(':valor', $valor);
    $consulta->bindParam(':tipo', $tipo);
    $consulta->bindParam(':foto', $foto);
    $consulta->bindParam(':marca_id', $marca_id);
    $consulta->bindParam(':cor_id', $cor_id);
    $consulta->bindParam(':usuario_id', $usuario_id);
    $consulta->bindParam(':opcionais', $opcionais);
    $consulta->bindParam(':id', $id);
  }

  if ($consulta->execute()) {
    redirect("Salvo", "Registro salvo com sucesso", "success", "listar/veiculos");
  } else {
    echo $erro = $consulta->errorInfo()[2];

    mensagem(
      "Erro",
      "Erro ao salvar ou alterar registro",
      "error"
    );
  }
}
