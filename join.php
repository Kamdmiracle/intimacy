<?php
session_start();
require_once __DIR__ . '/config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$code = $_GET['code'] ?? '';

$message = '';

if ($code) {
    $stmt = $pdo->prepare("SELECT * FROM couples WHERE invite_code = ?");
    $stmt->execute([$code]);
    $couple = $stmt->fetch();

    if ($couple) {
        if ($couple['partner2_id'] === null && $couple['partner1_id'] != $user_id) {
            $stmt = $pdo->prepare("UPDATE couples SET partner2_id = ? WHERE id = ?");
            $stmt->execute([$user_id, $couple['id']]);
            $message = "🎉 You have successfully joined your partner!";
        } else {
            $message = "⚠️ This invite is already used or invalid.";
        }
    } else {
        $message = "❌ Invalid code.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Join Your Partner</title>
</head>
<body>
    <h2>Join Partner</h2>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php else: ?>
        <form method="get" action="join.php">
            <label>Enter Invite Code:</label>
            <input type="text" name="code" required>
            <button type="submit">Join</button>
        </form>
    <?php endif; ?>
</body>
</html>
