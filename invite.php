<?php
session_start();
require_once __DIR__ . '/config/config.php';

// Ensure user logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Generate or fetch invite code
$stmt = $pdo->prepare("SELECT invite_code FROM couples WHERE created_by = ?");
$stmt->execute([$user_id]);
$couple = $stmt->fetch();

if (!$couple) {
    $invite_code = bin2hex(random_bytes(5)); // 10-char random code
    $stmt = $pdo->prepare("INSERT INTO couples (invite_code, created_by, partner1_id) VALUES (?, ?, ?)");
    $stmt->execute([$invite_code, $user_id, $user_id]);
} else {
    $invite_code = $couple['invite_code'];
}

$invite_link = "https://" . $_SERVER['HTTP_HOST'] . "/intimacy/join.php?code=" . $invite_code;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invite Your Partner</title>
</head>
<body>
    <h2>Invite Your Partner</h2>
    <p>Share this link with your partner so they can join:</p>
    <input type="text" value="<?php echo htmlspecialchars($invite_link); ?>" readonly style="width:100%;">
    <p>Or share this code: <strong><?php echo htmlspecialchars($invite_code); ?></strong></p>
</body>
</html>
