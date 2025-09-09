<?php
namespace App\Models;
use App\Core\Database;

class Note {
    public static function add(int $couple_id, int $user_id, string $category, string $content, bool $is_private=false, bool $priority=false): int {
        $stmt = Database::pdo()->prepare("INSERT INTO notes (couple_id, user_id, category, content, is_private, is_priority, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$couple_id, $user_id, $category, $content, $is_private ? 1 : 0, $priority ? 1 : 0]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function list(int $couple_id, int $user_id): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM notes WHERE couple_id=? AND (is_private=0 OR user_id=?) ORDER BY is_priority DESC, created_at DESC");
        $stmt->execute([$couple_id, $user_id]);
        return $stmt->fetchAll();
    }
}