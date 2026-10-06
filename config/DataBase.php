<?php
require_once "config.php";

class DataBase
{
    private static ?PDO $ConnectionDataBase = null;

    private function __construct() {}

    public static function getConection(): PDO
    {
        if (self::$ConnectionDataBase === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$ConnectionDataBase = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                error_log("Não foi possível fazer a conexão. O erro foi: " . $e->getMessage());
                exit("Erro na conexão com o banco de dados.");
            }
        }
        return self::$ConnectionDataBase;
    }
}
?>