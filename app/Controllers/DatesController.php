<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Helpers;
use App\Core\Auth;
use App\Models\DateIdea;

class DatesController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $filters = [
            'theme' => $_GET['theme'] ?? '',
            'budget' => $_GET['budget'] ?? '',
            'season' => $_GET['season'] ?? '',
            'location' => $_GET['location'] ?? '',
            'duration' => $_GET['duration'] ?? '',
        ];
        $ideas = DateIdea::list($filters);
        $this->view('dates/index', compact('ideas','filters'));
    }
}