<?php
if (!isset($_SESSION['admin']['id'])) exit;

$marca = NULL;

if (!empty($id)) {

  $sql = "select * from marca where id = :id limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  $id = $dados->id;
  $marca = $dados->marca;
}
?>
<div class="card">
  <div class="card-header">
    <h3 class="float-left">Cadastro de Marcas</h3>

    <div class="float-right">
      <a href="cadastros/marcas" class="btn btn-info">
        <i class="fas fa-file"></i> Novo
      </a>
      <a href="listar/marcas" class="btn btn-info">
        <i class="fas fa-search"></i> Listar
      </a>
    </div>
  </div>
  <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/marcas" data-parsley-validate="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12 col-md-4">
          <label for="id">ID:</label>
          <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
        </div>
        <div class="col-12 col-md-8">
          <label for="marca">Marca:</label>
          <input type="text" name="marca" id="marca" class="form-control" required data-parsley-required-message="Preencha uma marca" value="<?= $marca ?>">
        </div>
      </div>

      <button type="submit" class="btn btn-success float-right mt-2">
        <i class="fas fa-check"></i> Salvar / Alterar
      </button>
    </form>
  </div>
</div>
