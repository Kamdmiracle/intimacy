<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Core\Helpers;
use App\Models\Reminder;

class RemindersController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        if (Helpers::isPost()) {
            $this->requireCsrf();
            Reminder::add($user['couple_id'], $_POST['type'], trim($_POST['title']), $_POST['date'], trim($_POST['notes'] ?? ''));
            Helpers::flash('success','Reminder added.');
        }
        $reminders = Reminder::upcoming($user['couple_id']);
        $this->view('reminders/index', compact('reminders'));
    }
}