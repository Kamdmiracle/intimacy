<?php use App\Core\Helpers; ?>
<h3>Intimacy conversation prompts</h3>
<form class="mb-3" method="get">
  <input type="hidden" name="r" value="prompts/index">
  <select name="category" class="form-select" onchange="this.form.submit()">
    <option value="getting_deeper" <?= $category==='getting_deeper'?'selected':'' ?>>Getting deeper</option>
    <option value="dreams" <?= $category==='dreams'?'selected':'' ?>>Dreams & aspirations</option>
    <option value="past" <?= $category==='past'?'selected':'' ?>>Past experiences</option>
    <option value="physical" <?= $category==='physical'?'selected':'' ?>>Physical intimacy</option>
    <option value="emotional" <?= $category==='emotional'?'selected':'' ?>>Emotional needs</option>
    <option value="future" <?= $category==='future'?'selected':'' ?>>Future planning</option>
  </select>
</form>
<ul class="list-group">
  <?php foreach($prompts as $p): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><?= Helpers::e($p['text']) ?></span>
    <form method="post" action="<?= Helpers::route('prompts/favorite&category='.$category) ?>">
      <?= Helpers::csrfInput() ?>
      <input type="hidden" name="prompt_id" value="<?= $p['id'] ?>">
      <button class="btn btn-sm btn-outline-secondary">Favorite</button>
    </form>
  </li>
  <?php endforeach; ?>
</ul>