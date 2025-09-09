<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Core\Helpers;
use App\Core\Database;

class AdminController extends Controller {
    private function isAdmin(): bool {
        $u = $_SESSION['user'] ?? null;
        return $u && isset($u['role']) && $u['role']==='admin';
    }
    public function indexAction(): void {
        Auth::requireLogin();
        if (!$this->isAdmin()) { http_response_code(403); exit('Forbidden'); }
        $this->view('admin/index');
    }
    public function seedAction(): void {
        Auth::requireLogin();
        if (!$this->isAdmin()) { http_response_code(403); exit('Forbidden'); }
        $sql = file_get_contents(__DIR__ . '/../../scripts/sql/seed.sql');
        Database::pdo()->exec($sql);
        $this->redirect('admin/index');
    }
}