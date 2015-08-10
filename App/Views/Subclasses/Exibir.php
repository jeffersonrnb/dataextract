<?php
include("../../Models/Conexao.php");
include("../../Models/Subclasse.php");

if (isset($_REQUEST['id'])) {
    $dadosSubclasse = Subclasse::find($_REQUEST['id']);
} else {
    header("Location: ../Secoes/Index.php");
}?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include("../Layouts/Head.inc"); ?>
    <title>Exibir</title>
</head>
<body>
    <header>
        <?php include("../Layouts/Menu.inc"); ?>
    </header>
    <main class="container">
        <div class="page-header">
            <h1>Subclasse</h1>
        </div>
        <table class="table table-striped table-hover">
        <tbody>
            <?php if (empty($dadosSubclasse)): ?>
                <tr>
                    <p>Não foram encontradas subclasses</p>
                </tr>
            <?php else: ?>
                <tr>
                    <td>Seção:</td>
                    <td><?php echo $dadosSubclasse->sc_id; ?></td>
                    <td><?php echo $dadosSubclasse->sc_descricao; ?></td>
                </tr>
                <tr>
                    <td>Divisão:</td>
                    <td><?php echo $dadosSubclasse->dv_id; ?></td>
                    <td><?php echo $dadosSubclasse->dv_descricao; ?></td>
                </tr>
                <tr>
                    <td>Grupo:</td>
                    <td><?php echo $dadosSubclasse->gr_id; ?></td>
                    <td><?php echo $dadosSubclasse->gr_descricao; ?></td>
                </tr>
                <tr>
                    <td>Classe:</td>
                    <td><?php echo $dadosSubclasse->cl_id; ?></td>
                    <td><?php echo $dadosSubclasse->cl_descricao; ?></td>
                </tr>
                <tr>
                    <td>Subclasse:</td>
                    <td><?php echo $dadosSubclasse->sub_id; ?></td>
                    <td><?php echo $dadosSubclasse->sub_descricao; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </main>
    <?php include("../Layouts/Scripts.inc"); ?>
</body>
</html>
