<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Helpers;
use App\Core\Auth;
use App\Models\User;
use App\Models\Couple;

class AuthController extends Controller {
    public function registerAction(): void {
        if (Helpers::isPost()) {
            $this->requireCsrf();
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
                $uid = User::create($name, $email, $password);
                $cid = Couple::create($uid, null);
                $user = User::find($uid);
                $user['couple_id'] = $cid;
                $_SESSION['user'] = $user;
                $this->redirect('dashboard/index');
            } else {
                Helpers::flash('error', 'Please provide valid details (password 6+ chars).');
            }
        }
        $this->view('auth/register');
    }
    public function loginAction(): void {
        if (Helpers::isPost()) {
            $this->requireCsrf();
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = User::findByEmail($email);
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user'] = $user;
                $this->redirect('dashboard/index');
            } else {
                Helpers::flash('error', 'Invalid credentials.');
            }
        }
        $this->view('auth/login');
    }
    public function logoutAction(): void {
        session_destroy();
        $this->redirect('auth/login');
    }
}