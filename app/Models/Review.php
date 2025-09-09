<?php
namespace App\Models;
use App\Core\Database;

class Review {
    public static function createSession(int $couple_id, string $month): int {
        $stmt = Database::pdo()->prepare("INSERT INTO monthly_reviews (couple_id, month_label, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$couple_id, $month]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function addAnswer(int $review_id, int $user_id, int $question_id, string $answer): void {
        $stmt = Database::pdo()->prepare("INSERT INTO monthly_review_answers (review_id, user_id, question_id, answer) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE answer = VALUES(answer)");
        $stmt->execute([$review_id, $user_id, $question_id, $answer]);
    }
    public static function getAnswers(int $review_id): array {
        $stmt = Database::pdo()->prepare("SELECT a.*, q.text as question FROM monthly_review_answers a JOIN questions q ON q.id=a.question_id WHERE review_id=? ORDER BY question_id");
        $stmt->execute([$review_id]);
        return $stmt->fetchAll();
    }
    public static function listByCouple(int $couple_id): array {
        $stmt = Database::pdo()->prepare("SELECT * FROM monthly_reviews WHERE couple_id=? ORDER BY created_at DESC");
        $stmt->execute([$couple_id]);
        return $stmt->fetchAll();
    }
}