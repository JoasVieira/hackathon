<?php
if (!isset($_SESSION['admin']['id'])) exit;

$cor = NULL;

if (!empty($id)) {

  $sql = "select * from cor where id = :id limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  $id = $dados->id;
  $cor = $dados->cor;
}
?>
<div class="card">
  <div class="card-header">
    <h3 class="float-left">Cadastro de Cores</h3>

    <div class="float-right">
      <a href="cadastros/cores" class="btn btn-info">
        <i class="fas fa-file"></i> Novo
      </a>
      <a href="listar/cores" class="btn btn-info">
        <i class="fas fa-search"></i> Listar
      </a>
    </div>
  </div>
  <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/cores" data-parsley-validate="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12 col-md-4">
          <label for="id">ID:</label>
          <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
        </div>
        <div class="col-12 col-md-8">
          <label for="cor">Cor:</label>
          <input type="text" name="cor" id="cor" class="form-control" required data-parsley-required-message="Preencha uma cor" value="<?= $cor ?>">
        </div>
      </div>

      <button type="submit" class="btn btn-success float-right mt-2">
        <i class="fas fa-check"></i> Salvar / Alterar
      </button>
    </form>
  </div>
</div>
