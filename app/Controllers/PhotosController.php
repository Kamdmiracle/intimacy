<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Helpers;
use App\Core\Auth;
use App\Models\Photo;

class PhotosController extends Controller {
    public function indexAction(): void {
        Auth::requireLogin();
        $user = $_SESSION['user'];
        $photos = Photo::listByCouple($user['couple_id']);
        $this->view('photos/index', compact('photos'));
    }
    public function uploadAction(): void {
        Auth::requireLogin();
        if (Helpers::isPost()) {
            $this->requireCsrf();
            $user = $_SESSION['user'];
            if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                Helpers::flash('error','Upload failed.');
                $this->redirect('photos/index');
            }
            $file = $_FILES['photo'];
            $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
            $type = mime_content_type($file['tmp_name']);
            if (!isset($allowed[$type]) || ($file['size'] > (UPLOAD_MAX_MB*1024*1024))) {
                Helpers::flash('error','Invalid file type or size too large.');
                $this->redirect('photos/index');
            }
            $ext = $allowed[$type];
            $name = bin2hex(random_bytes(8)) . '.' . $ext;
            $dest = UPLOADS_PATH . '/' . $name;
            // basic optimization: re-encode
            $img = null;
            if ($ext==='jpg') $img = imagecreatefromjpeg($file['tmp_name']);
            if ($ext==='png') $img = imagecreatefrompng($file['tmp_name']);
            if ($ext==='webp') $img = imagecreatefromwebp($file['tmp_name']);
            if ($img) {
                imagejpeg($img, $dest, 85);
                imagedestroy($img);
            } else {
                move_uploaded_file($file['tmp_name'], $dest);
            }
            $rel = 'storage/uploads/' . $name;
            Photo::add($user['couple_id'], $user['id'], null, $rel, trim($_POST['caption'] ?? ''));
            Helpers::flash('success','Photo uploaded.');
        }
        $this->redirect('photos/index');
    }
}