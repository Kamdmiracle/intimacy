<?php use App\Core\Helpers; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Review history</h3>
  <a class="btn btn-primary" href="<?= Helpers::route('reviews/start') ?>">Start new review</a>
</div>
<ul class="list-group">
  <?php foreach($reviews as $r): ?>
  <li class="list-group-item">
    <strong><?= Helpers::e($r['month_label']) ?></strong> — <?= Helpers::humanDate($r['created_at']) ?>
  </li>
  <?php endforeach; ?>
</ul>