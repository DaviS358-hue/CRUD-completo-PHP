<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/dashboard.css">
    <title>Deletar Conta</title>
</head>

<body>
    <nav>
        <!-- coloca o nome dele -->
        <ul>
            <li><a href="delete.php">Deletar Usuário</a></li>
            <li><a href="update.php">Mudar a Senha</a></li>
        </ul>
    </nav>

    
    <?php
    session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sucefullUrl = $_GET['sucefull'] ?? '';
            $name = $_SESSION['nome'];
            $email = $_SESSION['email'];
            switch ($sucefullUrl) {
                case '1':
                     echo "<h1>Bem vindo ao nosso site, " . $name ." com o email: ". $email."</h1>";    
                    break;
                
                case '2':
                    echo "<h1>Bem vindo ao nosso site, " . $name ." com o email: ". $email."</h1>";    
                    break;
                case '3':
                    echo "<h1>".$name . " sua senha  foi alterada com sucesso <h1>";
                    break;
            }
        }else{
            header("Location: ../view/loguin.php");
            exit();
        }
    ?>
    
    <div class="video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/EIGAc5mdPpE?si=4F-O8jRrmOsQ4tGF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
</body>

</html>