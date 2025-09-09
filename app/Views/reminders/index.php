<?php use App\Core\Helpers; ?>
<h3>Important dates</h3>
<form class="row g-2 mb-3" method="post">
  <?= Helpers::csrfInput() ?>
  <div class="col-md-3"><select class="form-select" name="type" required>
    <option value="anniversary">Anniversary</option>
    <option value="birthday">Birthday</option>
    <option value="milestone">Milestone</option>
    <option value="holiday">Holiday</option>
  </select></div>
  <div class="col-md-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
  <div class="col-md-3"><input type="date" name="date" class="form-control" required></div>
  <div class="col-md-3"><input type="text" name="notes" class="form-control" placeholder="Notes"></div>
  <div class="col-md-12"><button class="btn btn-primary">Add reminder</button></div>
</form>
<ul class="list-group">
  <?php foreach($reminders as $r): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><strong><?= Helpers::e($r['title']) ?></strong> — <?= Helpers::humanDate($r['remind_on']) ?></span>
    <span class="badge text-bg-secondary"><?= Helpers::e($r['type']) ?></span>
  </li>
  <?php endforeach; ?>
</ul>