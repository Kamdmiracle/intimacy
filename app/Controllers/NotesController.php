<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Core\Helpers;
use App\Models\Note;

class NotesController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        if (Helpers::isPost()) {
            $this->requireCsrf();
            $is_private = isset($_POST['is_private']) ? true : false;
            $priority = isset($_POST['is_priority']) ? true : false;
            Note::add($user['couple_id'], $user['id'], trim($_POST['category']), trim($_POST['content']), $is_private, $priority);
        }
        $notes = Note::list($user['couple_id'], $user['id']);
        $this->view('notes/index', compact('notes'));
    }
}