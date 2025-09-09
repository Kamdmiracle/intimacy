<?php
namespace App\Models;
use App\Core\Database;

class Photo {
    public static function add(int $couple_id, int $user_id, ?int $date_idea_id, string $path, string $caption=''): int {
        $stmt = Database::pdo()->prepare("INSERT INTO photos (couple_id, user_id, date_idea_id, path, caption, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$couple_id, $user_id, $date_idea_id, $path, $caption]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function listByCouple(int $couple_id): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM photos WHERE couple_id=? ORDER BY created_at DESC");
        $stmt->execute([$couple_id]);
        return $stmt->fetchAll();
    }
}