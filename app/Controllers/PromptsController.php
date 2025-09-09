<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Models\Prompt;
use App\Core\Helpers;

class PromptsController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $category = $_GET['category'] ?? 'getting_deeper';
        $prompts = Prompt::listByCategory($category);
        $this->view('prompts/index', compact('prompts','category'));
    }
    public function favoriteAction(): void {
        Auth::requireLogin();
        if (Helpers::isPost()) {
            $this->requireCsrf();
            $pid = (int)($_POST['prompt_id'] ?? 0);
            Prompt::favorite($_SESSION['user']['id'], $pid);
        }
        $this->redirect('prompts/index&category=' . ($_GET['category'] ?? 'getting_deeper'));
    }
}