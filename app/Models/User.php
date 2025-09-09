<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class User {
    public static function create(string $name, string $email, string $password): int {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
        return (int)$pdo->lastInsertId();
    }
    public static function findByEmail(string $email): ?array {
        $stmt = Database::pdo()->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $u = $stmt->fetch();
        return $u ?: null;
    }
    public static function find(int $id): ?array {
        $stmt = Database::pdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $u = $stmt->fetch();
        return $u ?: null;
    }
}