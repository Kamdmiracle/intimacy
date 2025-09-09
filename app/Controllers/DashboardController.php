<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Models\Reminder;
use App\Models\Prompt;
use App\Models\Photo;
use App\Models\Review;

class DashboardController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        $couple_id = $user['couple_id'] ?? null;
        $prompt = Prompt::randomOfWeek();
        $reminders = $couple_id ? Reminder::upcoming($couple_id) : [];
        $photos = $couple_id ? Photo::listByCouple($couple_id) : [];
        $reviews = $couple_id ? Review::listByCouple($couple_id) : [];
        $this->view('dashboard/index', compact('user','prompt','reminders','photos','reviews'));
    }
}