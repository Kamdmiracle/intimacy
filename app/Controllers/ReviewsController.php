<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Helpers;
use App\Core\Auth;
use App\Models\Question;
use App\Models\Review;

class ReviewsController extends Controller {
    public function startAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        $month = date('F Y');
        $review_id = Review::createSession($user['couple_id'], $month);
        $this->redirect('reviews/answer&review_id=' . $review_id);
    }
    public function answerAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        $review_id = (int)($_GET['review_id'] ?? 0);
        $questions = Question::allMonthly();
        if (Helpers::isPost()) {
            $this->requireCsrf();
            foreach ($questions as $q) {
                $ans = trim($_POST['q_'.$q['id']] ?? '');
                if ($ans !== '') {
                    Review::addAnswer($review_id, $user['id'], (int)$q['id'], $ans);
                }
            }
            Helpers::flash('success','Saved. You can come back to edit.');
        }
        $answers = Review::getAnswers($review_id);
        $byQ = [];
        foreach ($answers as $a) { $byQ[$a['question_id']][$a['user_id']] = $a['answer']; }
        $this->view('reviews/answer', compact('questions','review_id','byQ'));
    }
    public function historyAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        $reviews = Review::listByCouple($user['couple_id']);
        $this->view('reviews/history', compact('reviews'));
    }
}