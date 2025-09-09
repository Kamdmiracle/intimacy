<?php
namespace App\Core;
class Helpers {
    public static function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
    public static function csrfInput(): string {
        $t = $_SESSION['csrf_token'] ?? '';
        return '<input type="hidden" name="csrf_token" value="'.self::e($t).'">';
    }
    public static function asset(string $path): string { return BASE_URL . 'public/' . ltrim($path, '/'); }
    public static function route(string $r): string { return BASE_URL . '?r=' . $r; }
    public static function post(string $key, $default='') { return $_POST[$key] ?? $default; }
    public static function get(string $key, $default='') { return $_GET[$key] ?? $default; }
    public static function isPost(): bool { return ($_SERVER['REQUEST_METHOD'] === 'POST'); }
    public static function flash(string $key, ?string $msg=null): ?string {
        if ($msg !== null) { $_SESSION['flash'][$key] = $msg; return null; }
        $m = $_SESSION['flash'][$key] ?? null; if ($m) unset($_SESSION['flash'][$key]); return $m;
    }
    public static function humanDate(string $dt): string { return date('M j, Y', strtotime($dt)); }
}