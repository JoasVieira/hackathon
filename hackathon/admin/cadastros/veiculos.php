<?php
if (!isset($_SESSION['admin']['id'])) exit;

include "libs/docs.php";

$now = date('Y');

$modelo = $anomodelo = $anofabricacao = $valor = $foto = $tipo =
  $marca_id = $cor_id = $usuario_id = $opcionais =  NULL;

if (!empty($id)) {
  $sql = "select * from veiculo where id = :id limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  $modelo = $dados->modelo;
  $anomodelo = $dados->anomodelo;
  $anofabricacao = $dados->anofabricacao;
  $valor = formatarValorBR($dados->valor);
  $foto = $dados->foto;
  $tipo = $dados->tipo;
  $marca_id = $dados->marca_id;
  $cor_id = $dados->cor_id;
  $usuario_id = $dados->usuario_id;
  $opcionais = $dados->opcionais;
}

?>
<div class="card">
  <div class="card-header">
    <h3 class="float-left">Cadastro de Veículo</h3>
    <div class="float-right">
      <a href="cadastros/veiculos" class="btn btn-info">
        <i class="fas fa-file"></i> Novo
      </a>
      <a href="listar/veiculos" class="btn btn-info">
        <i class="fas fa-search"></i> Listar
      </a>
    </div>
  </div>
  <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/veiculos" data-parsley-validate="" enctype="multipart/form-data">

      <div class="row">
        <div class="col-12 col-md-2">
          <label for="id">ID:</label>
          <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
        </div>
        <div class="col-12 col-md-6">
          <label for="modelo">Modelo:</label>
          <input type="text" name="modelo" id="modelo" class="form-control" required data-parsley-required-message="Digite o modelo" value="<?= $modelo ?>" maxlength="200">
        </div>
        <div class="col-12 col-md-4">
          <label for="valor">Valor:</label>
          <input type="text" name="valor" id="valor" class="form-control valor" required data-parsley-required-message="Digite o valor do veículo" inputmode="numeric" value="<?= $valor ?>">
        </div>

        <div class="col-12 col-md-3">
          <label for="anomodelo">Ano do modelo:</label>
          <input type="number" name="anomodelo" min="1900" max="<?= $now ?>" id="anomodelo" class="form-control" required data-parsley-required-message="Digite o ano de modelo do veículo" inputmode="numeric" value="<?= $anomodelo ?>">
        </div>
        <div class="col-12 col-md-3">
          <label for="anofabricacao">Ano de fabricação:</label>
          <input type="number" name="anofabricacao" min="1900" max="<?= $now ?>" id="anofabricacao" class="form-control" required data-parsley-required-message="Digite o ano de fabricação do veículo" inputmode="numeric" value="<?= $anofabricacao ?>">
        </div>
        <div class="col-12 col-md-6">
          <label for="marca_id">Selecione uma marca:</label>
          <select name="marca_id" id="marca_id" class="form-control" required data-parsley-required-message="Selecione uma marca">
            <option value="">Selecione</option>
            <?php
            $sql = "select id, marca from marca order by marca";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

              echo "<option value='{$dados->id}'>{$dados->marca}</option>";
            }
            ?>
          </select>
        </div>


        <div class="col-12 col-md-4">
          <label for="tipo">Tipo:</label>
          <select name="tipo" id="tipo" class="form-control" required data-parsley-required-message="Selecione um tipo">
            <option value="">Selecione</option>
            <option value="NOVO">Novo</option>
            <option value="SEMINOVO">Seminovo</option>
          </select>
        </div>
        <div class="col-12 col-md-4">
          <label for="usuario_id">Selecione um usuário:</label>
          <select name="usuario_id" id="usuario_id" class="form-control" required data-parsley-required-message="Selecione um usuário">
            <option value="">Selecione</option>
            <?php
            $sql = "select id, nome from usuario order by nome";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

              echo "<option value='{$dados->id}'>{$dados->nome}</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-12 col-md-4">
          <label for="cor_id">Cor:</label>
          <select name="cor_id" id="cor_id" class="form-control" required data-parsley-required-message="Selecione uma cor">
            <option value="">Selecione</option>
            <?php
            $sql = "select id, cor from cor order by cor";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

              echo "<option value='{$dados->id}'>{$dados->cor}</option>";
            }
            ?>
          </select>
        </div>


        <div class="col-12 col-md-12">
          <label for="opcionais">Opcionais:</label>
          <textarea name="opcionais" id="opcionais" class="form-control" rows="10"><?= $opcionais ?></textarea>
        </div>
        <div class="col-12 col-md-4">
          <?php

          $required = ' required data-parsley-required-message="Selecione um arquivo" ';
          $link = NULL;

          if (!empty($foto)) {
            $img = "../src/main/resources/static/images/{$foto}m.jpg";
            $link = "<a href='{$img}' data-lightbox='foto' class='badge badge-success'>Abrir imagem</a>";
            $required = NULL;
          }

          ?>
          <label for="foto">Imagem (JPG) <?= $link ?>:</label>
          <input type="file" name="foto" id="foto" class="form-control" <?= $required ?> accept="image/jpeg">
        </div>


      </div>
      <button type="submit" class="btn btn-success float-right">
        <i class="fas fa-check"></i> Salvar / Alterar
      </button>

      <br>
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {
    $(".valor").maskMoney({
      thousands: '.',
      decimal: ','
    });

    $("#marca_id").val(<?= $marca_id ?>);
    $("#cor_id").val(<?= $cor_id ?>);
    $("#usuario_id").val(<?= $usuario_id ?>);
    $("#tipo").val('<?= $tipo ?>');
  })
</script>
