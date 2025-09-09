<?php
namespace App\Models;
use App\Core\Database;

class Couple {
    public static function create(int $user1, ?int $user2 = null): int {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("INSERT INTO couples (user1_id, user2_id, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$user1, $user2]);
        return (int)$pdo->lastInsertId();
    }
    public static function assignPartner(int $couple_id, int $partner_id): void {
        $stmt = Database::pdo()->prepare("UPDATE couples SET user2_id = ? WHERE id = ?");
        $stmt->execute([$partner_id, $couple_id]);
    }
    public static function findByUser(int $user_id): ?array {
        $stmt = Database::pdo()->prepare("SELECT * FROM couples WHERE user1_id = ? OR user2_id = ? LIMIT 1");
        $stmt->execute([$user_id, $user_id]);
        $c = $stmt->fetch();
        return $c ?: null;
    }
}