<?php 
namespace DankiCode;

// Classe para comunicação com o BANCO DE DADOS.
class MySql {
    private static $pdo;

    // Método para estabelecer a conexão com o banco de dados.
    public static function connect() {
        if (self::$pdo == null) {
            try {
                // Data Source Name (DSN) para a conexão PDO.
                self::$pdo = new \PDO('mysql:host=localhost;dbname=rede_social_devweb', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                // Configurando atributos do PDO para lidar com erros.
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // Mensagem de erro para falha na conexão.
                echo 'Erro ao conectar ao banco de dados: ' .$e->getMessage();//Mensagem de erro detalhada
                // Log do erro para debugging.
                error_log($e->getMessage());
                die();
            }
        }
        // Retorna a instância PDO.
        return self::$pdo;
    }
}

