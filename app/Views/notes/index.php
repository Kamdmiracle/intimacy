<?php use App\Core\Helpers; ?>
<h3>Personal note corner</h3>
<form class="row g-2 mb-3" method="post">
  <?= Helpers::csrfInput() ?>
  <div class="col-md-3"><select class="form-select" name="category">
    <option>gift_ideas</option><option>favorites</option><option>hobbies</option>
    <option>clothing_sizes</option><option>media</option><option>travel</option>
    <option>dislikes_allergies</option>
  </select></div>
  <div class="col-md-7"><input class="form-control" name="content" placeholder="Note content"></div>
  <div class="col-md-2 d-flex align-items-center gap-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="is_private" id="pvt">
      <label class="form-check-label" for="pvt">Private</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="is_priority" id="pri">
      <label class="form-check-label" for="pri">Priority</label>
    </div>
  </div>
  <div class="col-md-12"><button class="btn btn-primary">Add note</button></div>
</form>
<ul class="list-group">
  <?php foreach($notes as $n): ?>
  <li class="list-group-item">
    <small class="text-muted"><?= Helpers::e($n['category']) ?></small><br>
    <?= nl2br(Helpers::e($n['content'])) ?>
    <?php if ($n['is_private']): ?><span class="badge text-bg-warning ms-2">Private</span><?php endif; ?>
    <?php if ($n['is_priority']): ?><span class="badge text-bg-danger ms-2">Priority</span><?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>