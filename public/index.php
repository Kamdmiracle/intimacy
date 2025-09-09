<?php
declare(strict_types=1);
session_start();
// Load config
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Autoload.php';
use App\Core\Router;
use App\Core\Auth;

// Force HTTPS if configured
if (FORCE_HTTPS && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')) {
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $redirect, true, 301);
    exit;
}

// Basic CSP
header("Content-Security-Policy: default-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; img-src 'self' data: blob:; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com;");

// CSRF token bootstrap
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Simple route resolver: r=controller/action
$route = $_GET['r'] ?? 'dashboard/index';
$router = new Router();
$router->dispatch($route);