<?php
namespace App\Core;
class Controller {
    protected function view(string $template, array $data = []): void {
        extract($data);
        $templatePath = __DIR__ . '/../Views/' . $template . '.php';
        $layoutPath = __DIR__ . '/../Views/layout.php';
        ob_start();
        if (file_exists($templatePath)) {
            include $templatePath;
        } else {
            echo "View not found: " . htmlspecialchars($template);
        }
        $content = ob_get_clean();
        include $layoutPath;
    }
    protected function redirect(string $route): void {
        header("Location: " . BASE_URL . "?r=" . $route);
        exit;
    }
    protected function requireCsrf(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
                http_response_code(400);
                exit('Invalid CSRF token');
            }
        }
    }
}