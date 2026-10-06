<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/style.css">
    <title>Redefinição de Senha</title>
</head>

<body>
    <form action="../controller/createToken.php" method="post">
        <fieldset>
            <legend>Redefinição de senha</legend>
            
            <div class="form-group">
                <input type="email" name="email" id="email" required>
                <label for="email">E-Mail</label>
            </div>

            <div class="form-group">
                <input type="password" name="newPassword" id="password" required>
                <label for="newPassword">Insira a nova senha</label>
            </div>

            <div class="form-group">
                <input type="password" name="newPasswordConfirmation" id="passwordConfirm" required>
                <label for="newPasswordConfirmation">Confirme sua senha</label>
            </div>

            <div class="form-group">
                <input type="submit" value="Redefinir Senha">
            </div>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $erro = $_GET['erro'] ?? null;
                if ($erro !== null) {
                    switch ($erro) {
                        case"20":
                            echo"<p class='error-message'>E-mail errado</p>";
                            break;
                        case '15':
                            echo"<p class='error-message'>todos os campos devem ser preenchidos</p>";
                            break;
                        case '2':
                            echo"<p class='error-message'>email com formato invalido</p>";
                            break;    
                        default:
                            echo"<p class='error-message'>tente novamente mais tarde</p>";
                            break;
                    }
                }

            }
            ?>
        </fieldset>
    </form>
</body>

</html>