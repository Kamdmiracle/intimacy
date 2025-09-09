<?php
namespace App\Models;
use App\Core\Database;

class Reminder {
    public static function add(int $couple_id, string $type, string $title, string $date_str, ?string $notes=null): int {
        $stmt = Database::pdo()->prepare("INSERT INTO reminders (couple_id, type, title, remind_on, notes, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$couple_id, $type, $title, $date_str, $notes]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function upcoming(int $couple_id): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM reminders WHERE couple_id=? AND remind_on >= CURDATE() ORDER BY remind_on ASC");
        $stmt->execute([$couple_id]);
        return $stmt->fetchAll();
    }
}