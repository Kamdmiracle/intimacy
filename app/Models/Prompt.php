<?php
namespace App\Models;
use App\Core\Database;

class Prompt {
    public static function listByCategory(string $category): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM conversation_prompts WHERE category=? ORDER BY id");
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }
    public static function randomOfWeek(): ?array {
        $stmt = Database::pdo()->query("SELECT * FROM conversation_prompts ORDER BY RAND() LIMIT 1");
        return $stmt->fetch() ?: null;
    }
    public static function favorite(int $user_id, int $prompt_id): void {
        $stmt = Database::pdo()->prepare("INSERT IGNORE INTO user_favorite_prompts (user_id, prompt_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $prompt_id]);
    }
}