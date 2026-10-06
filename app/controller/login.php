<?php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../model/Class/User.php';
require_once __DIR__ . '/../../functions/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user = new User($email, $password);
        if ($user->login(DataBase::getConection())) {
            if (functions::getLoginData($user, DataBase::getConection())) {
                header("Location: ../view/dashboard.php?sucefull=2");
                exit();
            } else {
                header("Location: ../view/login.php?erro=4"); // Erro 4: Falha ao carregar dados da sessão
                exit();
            }
        } else {
            header("Location: ../view/login.php?erro=1"); // Erro 1: Credenciais incorretas ou erro no banco
            exit();
        }
    } else {
        header("Location: ../view/login.php?erro=2"); // Erro 2: E-mail com formato inválido
        exit();
    }
} else {
    header("Location: ../view/login.php");
    exit();
}
?>