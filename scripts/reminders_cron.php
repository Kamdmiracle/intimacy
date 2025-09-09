<?php
// Run daily via cPanel cron to email reminders for next 7 days
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Autoload.php';
use App\Core\Database;

$pdo = Database::pdo();
// join couples->users to reach both partners' emails
$sql = "
SELECT r.*, c.user1_id, c.user2_id,
  u1.email as email1, u2.email as email2
FROM reminders r
JOIN couples c ON c.id=r.couple_id
LEFT JOIN users u1 ON u1.id=c.user1_id
LEFT JOIN users u2 ON u2.id=c.user2_id
WHERE r.remind_on BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$rows = $pdo->query($sql)->fetchAll();

foreach ($rows as $row) {
    $subject = 'Upcoming: ' . $row['title'] . ' on ' . $row['remind_on'];
    $message = "Hi,\n\nThis is a reminder for: {$row['title']} ({$row['type']}) on {$row['remind_on']}.\nNotes: {$row['notes']}\n\n— Couples Intimacy App";
    $headers = 'From: ' . MAIL_FROM . "\r\n";
    if (!empty($row['email1'])) { @mail($row['email1'], $subject, $message, $headers); }
    if (!empty($row['email2'])) { @mail($row['email2'], $subject, $message, $headers); }
}
echo "OK\n";