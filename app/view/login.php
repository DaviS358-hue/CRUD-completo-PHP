<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/style.css">
    <title>login</title>
</head>

<body>
    <form action="../controller/login.php" , method="post">
        <fieldset>
            <legend>Login de usuário</legend>

            <div class="form-group">
                <label for="email">Digite seu e-mail:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Digite sua senha:</label>
                <input type="password" name="password" required> <br>
                <span><a href="update.php">Esqueci a senha</a></span>
                <span><a href="register.php">Cadastrar usuário</a></span>
            </div>

            <?php
            if (isset($_GET['erro'])) {
                $erro = $_GET['erro'];
    
                switch ($erro) {
                    case '1':
                        echo "<p class='error-message'>E-mail ou senha incorretos.</p>";
                        break;
    
                    case '2':
                        echo "<p class='error-message>Por favor, informe um e-mail em formato válido.</p>";
                        break;
    
                    case '4':
                        echo "<p class='error-message'>Falha ao iniciar a sessão. Tente novamente.</p>";
                        break;
    
                    default:
                        echo "<p class='error-message'>Ocorreu um erro ao tentar fazer login.</p>";
                        break;
                }
            }
            ?>
            <input type="submit">
            </fieldset>

    </form>
</body>

</html>