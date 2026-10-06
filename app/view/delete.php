<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/style.css">
    <title>Deletar Conta</title>
</head>

<body>
    <form action="../controller/delete.php" method="post">
        <fieldset>
            <legend>Deletar conta:</legend>

            <div class="form-group">
                <label for="email">Digite o Email:</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Digite a Senha:</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <input type="submit" name="btnDelete" value="Deletar">
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $erro = $_GET['erro'] ?? null;
                if ($erro !== null) {
                    switch ($erro) {
                        case '1':
                            echo "<p>Credenciais incorretas, tente novamente.</p>";
                            break;

                        case '2':
                            echo "<p>E-mail inválido.</p>";
                            break;

                        default:
                            echo "<p class='error-message'>Ocorreu um erro ao tentar fazer login.</p>";
                            break;
                    }
                }
            }
            ?>

        </fieldset>
    </form>
</body>

</html>