<?php
namespace App\Core;
use PDO, PDOException;
class Database {
    private static ?PDO $pdo = null;
    public static function pdo(): PDO {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $opts = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $opts);
            } catch (PDOException $e) {
                http_response_code(500);
                exit('Database connection failed.');
            }
        }
        return self::$pdo;
    }
}