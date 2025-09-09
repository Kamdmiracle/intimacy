<?php use App\Core\Helpers; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Photo memories</h3>
  <form method="post" enctype="multipart/form-data" action="<?= Helpers::route('photos/upload') ?>">
    <?= Helpers::csrfInput() ?>
    <div class="input-group">
      <input type="file" name="photo" class="form-control" required>
      <input type="text" name="caption" class="form-control" placeholder="Caption">
      <button class="btn btn-primary">Upload</button>
    </div>
  </form>
</div>
<div class="row g-3">
  <?php foreach($photos as $ph): ?>
  <div class="col-6 col-md-3">
    <div class="card">
      <img class="card-img-top" src="<?= Helpers::asset($ph['path']) ?>" alt="">
      <div class="card-body">
        <small><?= Helpers::e($ph['caption']) ?></small><br>
        <small class="text-muted"><?= Helpers::humanDate($ph['created_at']) ?></small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>