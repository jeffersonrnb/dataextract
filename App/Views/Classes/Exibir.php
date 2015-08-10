<?php
include("../../Models/Conexao.php");
include("../../Models/Classe.php");
include("../../Models/Subclasse.php");

if (isset($_REQUEST['id'])) {
    $dadosClasse = Classe::find($_REQUEST['id']);
    $subclasses = Subclasse::allByClass($_REQUEST['id']);
} else {
    header("Location: ../Secoes/Index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../Layouts/Head.inc"); ?>
    <title>Classe</title>
</head>
<body>
    <header>
        <?php include("../Layouts/Menu.inc"); ?>
    </header>
    <main class="container">
        <div class="page-header">
            <h1>Classe</h1>
        </div>
        <dl class="dl-horizontal">
          <dt>Seção:</dt>
          <dd><?php echo "{$dadosClasse->sc_id}"; ?></dd>
          <dt>Divisão:</dt>
          <dd><?php echo "{$dadosClasse->dv_id}" ?></dd>
          <dt>Grupo:</dt>
          <dd><?php echo "{$dadosClasse->gr_id}" ?></dd>
          <dt>Classe:</dt>
          <dd><?php echo "{$dadosClasse->cl_id}" ?></dd>
        </dl>
        <div class="page-header">
            <h2>Subclasses</h1>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>CNAE_ID</th>
                <th>Descrição</th>
            </thead>
            <tbody>
                <?php foreach ($subclasses as $subclasse): ?>
                    <tr>
                        <td><?php echo $subclasse->id; ?></td>
                        <td>
                            <?php echo "<a href=\"../Subclasses/Exibir.php?id={$subclasse->id}\";>{$subclasse->cnae_id}</a>"?>
                        </td>
                        <td><?php echo $subclasse->descricao; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</body>
</html>
