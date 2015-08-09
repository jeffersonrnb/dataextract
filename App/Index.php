<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Extrair</title>
</head>
<body>
    <div>
        <form action="Controllers/RequisicaoController.php">
            <div>
                <label for="data_url"></label>
                <input type="text" name="data_url" id="data_url">
                <input type="submit" value="Extrair dados">
                <input type="hidden" name="action" value="extrair">
            </div>
        </form>
    </div>
</body>
</html>
