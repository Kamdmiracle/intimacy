<?php use App\Core\Helpers; ?>
<h3>Monthly review</h3>
<form method="post">
  <?= Helpers::csrfInput() ?>
  <?php foreach($questions as $q): 
    $mine = $byQ[$q['id']][$_SESSION['user']['id']] ?? '';
  ?>
  <div class="mb-3">
    <label class="form-label"><strong><?= Helpers::e($q['text']) ?></strong></label>
    <textarea class="form-control" name="q_<?= $q['id'] ?>" rows="3"><?= Helpers::e($mine) ?></textarea>
  </div>
  <?php endforeach; ?>
  <button class="btn btn-primary">Save answers</button>
</form>