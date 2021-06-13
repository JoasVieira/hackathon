<?php
if (!isset($_SESSION['admin']['id'])) exit;

$nome = $login = $senha = NULL;

if (!empty($id)) {

  $sql = "select * from usuario where id = :id limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  $id = $dados->id;
  $nome = $dados->nome;
  $login = $dados->login;
}
?>
<div class="card">
  <div class="card-header">
    <h3 class="float-left">Cadastro de Usuários</h3>

    <div class="float-right">
      <a href="cadastros/usuarios" class="btn btn-info">
        <i class="fas fa-file"></i> Novo
      </a>
      <a href="listar/usuarios" class="btn btn-info">
        <i class="fas fa-search"></i> Listar
      </a>
    </div>
  </div>
  <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/usuarios" data-parsley-validate="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12 col-md-2">
          <label for="id">ID:</label>
          <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
        </div>
        <div class="col-12 col-md-6">
          <label for="nome">Nome do Usuário:</label>
          <input type="text" name="nome" id="nome" class="form-control" required data-parsley-required-message="Preencha o nome" value="<?= $nome ?>">
        </div>
        <div class="col-12 col-md-4">
          <label for="login">Login do Usuário:</label>
          <input type="text" name="login" id="login" class="form-control" required data-parsley-required-message="Preencha o login" value="<?= $login ?>">
        </div>
        <div class="col-12 col-md-6">
          <label for="senha">Senha:</label>
          <input type="password" name="senha" id="senha" class="form-control" required data-parsley-required-message="Preencha a senha">
        </div>
        <div class="col-12 col-md-6">
          <label for="redigite">Redigite a Senha:</label>
          <input type="password" name="redigite" id="redigite" class="form-control" required data-parsley-required-message="Preencha a senha" data-parsley-equalto="#senha">
        </div>
      </div>

      <button type="submit" class="btn btn-success float-right mt-2">
        <i class="fas fa-check"></i> Salvar / Alterar
      </button>
    </form>
  </div>
</div>
