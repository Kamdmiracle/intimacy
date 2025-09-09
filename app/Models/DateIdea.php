<?php
namespace App\Models;
use App\Core\Database;

class DateIdea {
    public static function list(array $filters=[]): array {
        $sql = "SELECT * FROM date_ideas WHERE 1";
        $params = [];
        if (!empty($filters['theme'])) { $sql .= " AND theme=?"; $params[] = $filters['theme']; }
        if (!empty($filters['budget'])) { $sql .= " AND budget_tier=?"; $params[] = $filters['budget']; }
        if (!empty($filters['season'])) { $sql .= " AND (season='any' OR season=?)"; $params[] = $filters['season']; }
        if (!empty($filters['location'])) { $sql .= " AND location_type=?"; $params[] = $filters['location']; }
        if (!empty($filters['duration'])) { $sql .= " AND duration=?"; $params[] = $filters['duration']; }
        $sql .= " ORDER BY id";
        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}