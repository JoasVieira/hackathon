<?php
if (!isset($_SESSION['admin']['id'])) exit;
?>
<div class="card">
  <div class="card-header">
    <h3 class="float-left">Listagem de Usuários</h3>

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
    <p>Resultados:</p>

    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <td width="10%">ID</td>
          <td width="80%">Nome</td>
          <td width="80%">Login</td>
          <td width="10%">Opções</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from usuario order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();

        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

        ?>
          <tr>
            <td><?= $dados->id ?></td>
            <td><?= $dados->nome ?></td>
            <td><?= $dados->login ?></td>
            <td>
              <a href="cadastros/usuarios/<?= $dados->id ?>" class="btn btn-success btn-sm">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="js/dataTable.js"></script>
