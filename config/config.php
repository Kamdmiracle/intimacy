<?php
// ====== ENV ======
define('APP_NAME', 'Couples Intimacy');
define('BASE_URL', getenv('APP_BASE_URL') ?: '/intimacy/couples_intimacy_app_starter/'); // e.g., '/app/' if using subfolder
define('FORCE_HTTPS', false); // set true if you have SSL

// ====== DB ======
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'fkzgtqxy_intimacy');
define('DB_USER', getenv('DB_USER') ?: 'fkzgtqxy_kam');
define('DB_PASS', getenv('DB_PASS') ?: '8JQPWuRDNc3@');
define('DB_CHARSET', 'utf8mb4');

// ====== MAIL (optional) ======
define('MAIL_FROM', getenv('MAIL_FROM') ?: 'no-reply@example.com');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Couples Intimacy');
define('MAIL_USE_SMTP', false); // if true, configure SMTP below
define('SMTP_HOST', getenv('SMTP_HOST') ?: '');
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'tls');

// ====== STORAGE ======
define('STORAGE_PATH', __DIR__ . '/../storage');
define('UPLOADS_PATH', STORAGE_PATH . '/uploads');
define('UPLOAD_MAX_MB', 10); // per file
if (!is_dir(STORAGE_PATH)) { mkdir(STORAGE_PATH, 0775, true); }
if (!is_dir(UPLOADS_PATH)) { mkdir(UPLOADS_PATH, 0775, true); }

// ====== SECURITY ======
define('PASSWORD_ALGO', PASSWORD_DEFAULT);

ini_set('display_errors', 1);
error_reporting(E_ALL);
