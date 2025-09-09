<?php use App\Core\Helpers; ?>
<div class="row g-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Conversation of the week</h5>
        <?php if($prompt): ?>
          <p class="card-text"><?= Helpers::e($prompt['text']) ?></p>
          <a class="btn btn-outline-primary" href="<?= Helpers::route('prompts/index') ?>">Explore prompts</a>
        <?php else: ?>
          <p>No prompts yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Start this month's review</h5>
        <p>Reflect together on wins, growth, and plans.</p>
        <a class="btn btn-primary" href="<?= Helpers::route('reviews/start') ?>">Start</a>
        <a class="btn btn-link" href="<?= Helpers::route('reviews/history') ?>">View history</a>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Upcoming reminders</h5>
        <?php if(!empty($reminders)): ?>
        <ul class="list-group">
          <?php foreach($reminders as $r): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><strong><?= Helpers::e($r['title']) ?></strong> — <?= Helpers::humanDate($r['remind_on']) ?></span>
            <span class="badge text-bg-secondary"><?= Helpers::e($r['type']) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
          <p>No upcoming reminders yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>