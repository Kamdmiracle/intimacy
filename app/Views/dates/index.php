<?php use App\Core\Helpers; ?>
<h3>Date ideas</h3>
<form class="row g-2 mb-3" method="get">
  <input type="hidden" name="r" value="dates/index">
  <div class="col-md-2"><input class="form-control" name="theme" placeholder="Theme" value="<?= Helpers::e($filters['theme']) ?>"></div>
  <div class="col-md-2"><select class="form-select" name="budget"><option value="">Budget</option><option>free</option><option>low</option><option>splurge</option></select></div>
  <div class="col-md-2"><select class="form-select" name="season"><option value="">Season</option><option>any</option><option>harmattan</option><option>rainy</option><option>dry</option></select></div>
  <div class="col-md-2"><select class="form-select" name="location"><option value="">Location</option><option>indoor</option><option>outdoor</option></select></div>
  <div class="col-md-2"><select class="form-select" name="duration"><option value="">Duration</option><option>1h</option><option>half-day</option><option>full-day</option></select></div>
  <div class="col-md-2"><button class="btn btn-outline-primary w-100">Filter</button></div>
</form>
<div class="list-group">
  <?php foreach($ideas as $d): ?>
    <div class="list-group-item">
      <div class="d-flex justify-content-between">
        <div>
          <h6 class="mb-1"><?= Helpers::e($d['title']) ?> <small class="text-muted">(<?= Helpers::e($d['theme']) ?>)</small></h6>
          <p class="mb-1"><?= Helpers::e($d['description']) ?></p>
          <small>Budget: <?= Helpers::e($d['budget_tier']) ?> · Season: <?= Helpers::e($d['season']) ?> · <?= Helpers::e($d['location_type']) ?> · <?= Helpers::e($d['duration']) ?></small>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>