<?php

namespace MyApp\Database;

require '../../vendor/autoload.php';

class Database {
    private static $cnx;

    public static function connect() {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $dsn = "mysql:host={$_ENV['DB_SERVERNAME']};dbname={$_ENV['DB_NAME']}";
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            self::$cnx = new \PDO($dsn, $username, $password);
            self::$cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return self::$cnx;
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

?>
