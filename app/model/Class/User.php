<?php
class User
{
    private string $email;
    private ?string $name;
    private ?string $password;
    private ?Address $address;
    private ?string $birth_date;

    public function __construct(string $email, ?string $password = null, ?string $name = null, ?Address $address = null, ?string $birth_date = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->address = $address;
        $this->birth_date = $birth_date;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $newName): void
    {
        $this->name = $newName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function getAddress(): Address
    {
        return $this->address;
    }
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }
    public function getBirthDate(): int
    {
        return $this->birth_date;
    }

    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }


    public function login(PDO $PDO): bool
    {
        try {
            $sql = "SELECT password_hash FROM usuario WHERE email = :email";
            $stm = $PDO->prepare($sql);
            $stm->execute(['email' => $this->email]);
            $usuario = $stm->fetch(PDO::FETCH_ASSOC);
            if ($usuario && password_verify($this->password, $usuario['password_hash'])) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erro na Base de Dados: " . $e->getMessage());
            return false;
        } catch (Throwable $e) {
            error_log("Erro Inesperado: " . $e->getMessage());
            return false;
        }
    }

    public function registerUser(PDO $PDO): int|false
    {
        try {
            $sql = "INSERT INTO usuario (nome_user, email, password_hash, birth_date) VALUES (:nome, :email, :password_hash, :birth_date)";
            $stm = $PDO->prepare($sql);
            $stm->execute([
                'nome' => $this->name,
                'email' => $this->email,
                'password_hash' => $this->hasPassword($this->password),
                'birth_date' => $this->birth_date,
            ]);
            return (int) $PDO->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro na Base de Dados: " . $e->getMessage());
            return false;
        } catch (Throwable $e) {
            error_log("Erro Inesperado: " . $e->getMessage());
            return false;
        }
    }


    public function registerAdress(int $IdUser, PDO $PDO): bool
    {
        try {
            $sql = "INSERT INTO address_user (street, number_address, neighborhood, city, cep,user_id) VALUES ( :street, :number_address, :neighborhood, :city, :cep, :user_id)";
            $stm =  $PDO->prepare($sql);
            $stm->execute([
                'street' => $this->address->getStreet(),
                'number_address' => $this->address->getNumber(),
                'neighborhood' => $this->address->getNeighborhood(),
                'city' => $this->address->getCity(),
                'cep' => $this->address->getCep(),
                'user_id' => $IdUser,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro na Base de Dados: " . $e->getMessage() . "\n" . $e->getLine());
            return false;
        } catch (Throwable $e) {
            error_log("Erro Inesperado: " . $e->getMessage());
            return false;
        }
    }



   public function deleteUser(PDO $PDO): bool
{
    try {
        // Log para conferir o que chegou na classe
        error_log("Tentando deletar email: " . var_export($this->email, true));

        $sqlSelect = "SELECT password_hash FROM usuario WHERE email = :email";
        $stmSelect = $PDO->prepare($sqlSelect);
        $stmSelect->execute(['email' => $this->email]);
        $usuario = $stmSelect->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            error_log("E-mail não encontrado no banco de dados.");
            return false;
        }

        if (password_verify($this->password, $usuario['password_hash'])) {
            $sqlDelete = "DELETE FROM usuario WHERE email = :email";
            $stmDelete = $PDO->prepare($sqlDelete);
            $stmDelete->execute(['email' => $this->email]);

            return $stmDelete->rowCount() > 0;
        } else {
            error_log("Senha incorreta fornecida para exclusão.");
            return false;
        }

    } catch (PDOException $e) {
        error_log("Erro no BD ao deletar usuário: " . $e->getMessage());
        return false;
    } catch (Throwable $e) {
        error_log("Erro inesperado ao deletar usuário: " . $e->getMessage());
        return false;
    }
}

    public function setPassword(PDO $PDO): bool
    {
        try {
            $hashPassword = $this->hasPassword($this->password);
            $sql = "UPDATE usuario 
                SET password_hash = :password_hash, 
                    token_recuperacao = NULL, 
                    token_expiracao = NULL 
                WHERE email = :email";
            $stm = $PDO->prepare($sql);
            $executou = $stm->execute([
                'password_hash' => $hashPassword,
                'email'    => $this->email
            ]);


            return $executou && $stm->rowCount() > 0;
        } catch (\Throwable $th) {
            error_log("Erro no setPassword: " . $th->getMessage());
            return false;
        }
    }






    private function hasPassword(String $passoword)
    {
        return password_hash($passoword, PASSWORD_DEFAULT);
    }
}
