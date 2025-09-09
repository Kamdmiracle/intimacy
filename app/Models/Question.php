<?php
namespace App\Models;
use App\Core\Database;

class Question {
    public static function allMonthly(): array {
        $stmt = Database::pdo()->query("SELECT * FROM questions WHERE type='monthly_review' ORDER BY id");
        return $stmt->fetchAll();
    }
    public static function allPromptsByTheme(string $theme): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM date_ideas WHERE theme = ? ORDER BY id");
        $stmt->execute([$theme]);
        return $stmt->fetchAll();
    }
}