<?php
include("../../Models/Conexao.php");
include("../../Models/Subclasse.php");

if (isset($_REQUEST['id'])) {
    $dadosSubclasse = Subclasse::find($_REQUEST['id']);
} else {
    header("Location: ../Secoes/Index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exibir</title>
</head>
<body>
    <table>
        <tbody>
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
        </tbody>
    </table>
</body>
</html>
