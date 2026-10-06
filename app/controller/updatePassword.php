<?php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../model/Class/User.php';
require_once __DIR__ . '/../../functions/functions.php';


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tokenURL = $_GET['token'] ?? '';
    if (!empty($tokenURL) && isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if (functions::validateToken($tokenURL, DataBase::getConection())) {
            if ($user->setPassword(DataBase::getConection())) {
                unset($_SESSION['user']);
                if (functions::getLoginData($user, DataBase::getConection())) {
                    header("Location: ../view/dashboard.php?sucefull=3");
                    exit();
                }
            } else {
                header('Location: ../view/update.php?erro=20'); // Erro 20: não foi possível atualizar a senha
                exit();
            }
        } else {
            header('Location: ../view/update.php?erro=13'); // Erro 13: token inválido ou expirado
            exit();
        }
    } else {
        header('Location: ../view/update.php?erro=17'); //erro 17: erro genérico
        exit();
    }
} else {
    header('Location: ../view/login.php');
    exit();
}
