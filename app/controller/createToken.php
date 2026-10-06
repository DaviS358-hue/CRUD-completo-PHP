<?php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../model/Class/User.php';
require_once __DIR__ . '/../../functions/functions.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $newPassword = isset($_POST['newPassword']) ? ($_POST['newPassword']) : '';
    $newPasswordConfirmation = isset($_POST['newPasswordConfirmation']) ? ($_POST['newPasswordConfirmation']) : '';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!empty($newPassword) && !empty($newPasswordConfirmation)) {
            $user = new User($email, $newPassword);
            if (functions::existEmail($user, DataBase::getConection())) {
                $token = functions::saveCreateToken(DataBase::getConection(), $email);
                if (is_bool($token)) {
                    header("Location: ../view/update.php?erro=8"); //falha: erro genérico
                    exit();
                } else {
                    $_SESSION['user'] = $user;
                    header("Location: updatePassword.php?token=" . urldecode($token));
                    exit();
                }
            } else {
                header("Location: ../view/update.php?erro=20"); //falha: erro não existe o email
                exit();
            }
        } else {
            header("Location: ../view/update.php?erro=15"); // Erro 15: todos os campos devem ser preenchidos 
            exit();
        }
    } else {
        header("Location: ../view/update.php?erro=2"); // Erro 2: E-mail com formato inválido
        exit();
    }
}
