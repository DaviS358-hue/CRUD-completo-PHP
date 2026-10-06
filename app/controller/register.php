<?php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../model/Class/User.php';
require_once __DIR__ . '/../../functions/functions.php';
require_once __DIR__ . '/../model/Class/Address.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = array_map(function ($dado) {
        return is_string($dado) ? trim($dado) : $dado;
    }, $_POST);
    $dados['user_password'] = $_POST['user_password'] ?? '';
    $dados['user_password_confirmation'] = $_POST['user_password_confirmation'] ?? '';
    foreach ($dados as $key => $value) {
        if (empty($value)) {
            header(("location: ../view/register.php?erro=2")); //falha:comleta todos os campos
            exit();
        }
    }
    if ($dados['email'] === $dados['email_confirmation'] && $dados['user_password'] === $dados['user_password_confirmation']) {
        $address = new Address($dados['street'], $dados['number'], $dados['neighborhood'], $dados['city'], $dados['cep']);
        $user = new User($dados['email'], $dados['user_password'], $dados['name'], $address, $dados['date_birth']);
        $idUser = $user->registerUser(DataBase::getConection());
        if (is_int($idUser)) {
            if ($user->registerAdress($idUser, DataBase::getConection())) {
                if (functions::getLoginData($user, DataBase::getConection())) {
                    header("Location: ../view/dashboard.php?sucefull=1");
                    exit();
                }
            } else {
                header("Location: ../view/register.php?erro=8.1"); // Erro 8: falha no cadastro do usúario; 
                exit();
            }
        } else {
            header("Location: ../view/register.php?erro=8.2"); // Erro 8: falha no cadastro do usúario; 
            exit();
        }
    } else {
        header(("location: ../view/register.php?erro=7")); //falha:os campos de confirmação devem ser iguais
        exit();
    }
} else {
    header("Location: ../view/register.php?erro=10"); //falha: os campos de confirmação devem ser igual ao de inserção original
    exit();
}
