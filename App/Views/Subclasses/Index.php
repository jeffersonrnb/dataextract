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
    <meta charset="UTF-8">
    <title>Subclasses</title>
</head>
<body>
    <label><?php echo "Seção: {$dadosClasse->sc_id}"; ?></label>
    <label><?php echo "Divisão: {$dadosClasse->dv_id}" ?></label>
    <label><?php echo "Grupo: {$dadosClasse->gr_id}" ?></label>
    <label><?php echo "Classe: {$dadosClasse->cl_id}" ?></label>
    <br><br>
    <table>
        <thead>
            <th>CNAE_ID</th>
            <th>Descricao</th>
        </thead>
        <tbody>
            <?php foreach ($subclasses as $subclasse): ?>
                <tr>
                    <td>
                        <?php echo "<a href=\"Exibir.php?id={$subclasse->id}\";>{$subclasse->cnae_id}</a>"?>
                    </td>
                    <td><?php echo $subclasse->descricao; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
