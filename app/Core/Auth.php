<?php
namespace App\Core;
use App\Models\User;
class Auth {
    public static function user(): ?array {
        return $_SESSION['user'] ?? null;
    }
    public static function check(): bool {
        return isset($_SESSION['user']);
    }
    public static function requireLogin(): void {
        if (!self::check()) {
            header('Location: ' . BASE_URL . '?r=auth/login');
            exit;
        }
    }
    public static function login(array $user): void {
        $_SESSION['user'] = $user;
    }
    public static function logout(): void {
        unset($_SESSION['user']);
        session_destroy();
    }
}