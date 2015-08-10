<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Views/Layouts/Head.inc"); ?>
    <title>Extrair</title>
</head>
<body>
    <header>
        <?php include("Views/Layouts/Menu.inc"); ?>
    </header>
    <main class="container">
        <div class="page-header">
            <h1>Extração de dados</h1>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="row">
                <form action="Controllers/RequisicaoController.php" method="POST">
                    <div>
                        <label for="data_url"></label>
                        <input type="text" name="data_url" id="data_url">
                        <input type="submit" value="Extrair dados">
                        <input type="hidden" class="btn btn-primary" name="action" value="extrair">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include("Views/Layouts/Scripts.inc"); ?>
</body>
</html>
