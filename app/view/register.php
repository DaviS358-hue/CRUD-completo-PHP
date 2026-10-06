<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/style.css">
    <title>Cadastro</title>
</head>

<body>
    <form action="../controller/register.php" method="post">
        <fieldset>
            <legend>Cadastrar usuário</legend>

            <div class="form-group">
                <label for="name">Nome Completo:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail válido:</label>
                <input type="email" name="email" id="email" autocomplete="email" required>
                <span class="error-message" id="email-error"></span>
            </div>

            <div class="form-group">
                <label for="email_confirmation">Confirme o E-mail:</label>
                <input type="email" id="email_confirmation" name="email_confirmation" autocomplete="off" required>
                <span class="error-message" id="email-confirmation-error"></span>
            </div>

            <div class="form-group">
                <label for="date_birth">Data de nascimento:</label>
                <input type="date" name="date_birth" id="date_birth" required>
                <span class="error-message" id="date_birth-error"></span>
            </div>

            <div class="form-group">
                <div class="address">
                    <div class="form-group">
                        <label for="street">Rua:</label>
                        <input type="text" name="street" id="street" required>
                    </div>

                    <div class="form-group">
                        <label for="number">Número:</label>
                        <input type="text" name="number" id="number" required>
                    </div>

                    <div class="form-group">
                        <label for="neighborhood">Bairro:</label>
                        <input type="text" name="neighborhood" id="neighborhood" required>
                    </div>

                    <div class="form-group">
                        <label for="city">Cidade:</label>
                        <input type="text" name="city" id="city" required>
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="user_password">Senha:</label>
                <input type="password" name="user_password" id="user_password" required>
                <span class="error-message" id="password-error"></span>
            </div>

            <div class="form-group">
                <label for="user_password_confirmation">Confirmar Senha:</label>
                <input type="password" name="user_password_confirmation" id="user_password_confirmation" required>
                <span class="error-message" id="password-confirmation-error"></span>
            </div>

            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
            <?php
            if (isset($_GET['erro'])) {
                $erro = $_GET['erro'];

                switch ($erro) {
                    case '2':
                        echo "<p class='error'>Preencha todos os campos obrigatórios.</p>";
                        break;

                    case '7':
                        echo "<p class='error'>Os campos de confirmação (e-mail ou senha) devem ser iguais aos originais.</p>";
                        break;

                    case '8.1':
                        echo "<p class='error'>Falha ao realizar o cadastro. Tente novamente mais tarde.</p>";
                        break;
                    case '8.2':
                        echo "<p class='error'>Usuário já existente</p>";
                        break;
                    case '10':
                        echo "<p class='error'>Acesso inválido ao formulário.</p>";
                        break;

                    default:
                        echo "<p class='error'>Houve um erro, tente novamente.</p>";
                        break;
                }
            }
            ?>
        </fieldset>
    </form>
    <script src="../../public/script.js"></script>
</body>

</html>