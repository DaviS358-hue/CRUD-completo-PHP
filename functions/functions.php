<?php
class functions
{
    public static function getLoginData(User $user, PDO $PDO): bool
    {
        try {
            $sql = "SELECT user_id,nome_user,birth_date,email FROM usuario where email = :email";
            $stm = $PDO->prepare($sql);
            $stm->execute(
                [
                    'email' => $user->getEmail(),
                ]
            );

            $internalta = $stm->fetch(PDO::FETCH_ASSOC);
            if ($internalta) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['id_user'] = $internalta['user_id'];
                $_SESSION['nome'] = $internalta['nome_user'];
                $_SESSION['birth_date'] = $internalta['birth_date'];
                $_SESSION['email'] = $internalta['email'];

                return true;
            }

            return false;
        } catch (\Throwable $th) {
            error_log("erro: " . $th->getMessage());
            return false;
        }
    }

    public static function existEmail(User $user, PDO $PDO)
    {
        try {
            $sql = "SELECT email FROM usuario WHERE email = :email";
            $stm = $PDO->prepare($sql);
            $stm->execute(['email' => $user->getEmail()]);
            return $stm->rowCount() > 0;;
        } catch (\Throwable $th) {
            error_log("erro email não encontrado: " . $th->getMessage());
            return false;
        }
    }

    public static function saveCreateToken(PDO $PDO, string $email): string|false
    {
        $token = self::createToken();
        $tokenClean = $token['puro'];
        $tokenHash = $token['hash'];
        $tokenValidate = $token['expiracao'];
        $saveToken = self::saveTokenDataBase($PDO, $tokenHash, $tokenValidate, $email);
        if ($saveToken) {
            return $tokenClean;
        } else {
            return false;
        }
    }

    public static function validateToken(string $token, PDO $PDO): bool
    {
        try {
            $tokenHash = hash('sha256', $token);
            if (self::recuperationHasTokenDataBase($tokenHash, $PDO)) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            error_log("Erro: " . $th->getMessage());
            return false;
        }
    }

    private static function createToken(): array
    {
        $tokenPuro = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $tokenPuro);
        $expiracao = date('Y-m-d H:i:s', strtotime('+30 minutes'));
        return [
            'puro'      => $tokenPuro,
            'hash'      => $tokenHash,
            'expiracao' => $expiracao
        ];
    }

    private static function saveTokenDataBase(PDO $PDO, string $tokenHash, string $tokenExpiration, string $email): bool
    {
        $sql = "UPDATE usuario 
            SET token_recuperacao = :token_hash, 
                token_expiracao = :expiracao 
            WHERE email = :email";

        $stmt = $PDO->prepare($sql);

        return $stmt->execute([
            'token_hash' => $tokenHash,
            'expiracao'  => $tokenExpiration,
            'email'      => $email
        ]);
    }

    private static function recuperationHasTokenDataBase(string $tokenHash, PDO $PDO): bool
    {
        try {
            $sql = "SELECT user_id
            FROM usuario 
            WHERE token_recuperacao = :token_hash 
            AND token_expiracao > NOW()";

            $stm = $PDO->prepare($sql);
            $stm->execute(['token_hash' => $tokenHash]);
            return $stm->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (\Throwable $th) {
            error_log("Erro: " . $th->getMessage());
            return false;
        }
    }
}
