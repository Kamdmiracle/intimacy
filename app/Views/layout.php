<?php use App\Core\Helpers; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= Helpers::e(APP_NAME) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= Helpers::route('dashboard/index') ?>"><?= Helpers::e(APP_NAME) ?></a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('reviews/history') ?>">Monthly Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('dates/index') ?>">Date Ideas</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('prompts/index') ?>">Conversations</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('photos/index') ?>">Photos</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('reminders/index') ?>">Reminders</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::route('notes/index') ?>">Notes</a></li>
      </ul>
      <div class="d-flex">
        <?php if (!empty($_SESSION['user'])): ?>
          <span class="me-3">Hi, <?= Helpers::e($_SESSION['user']['name']) ?></span>
          <a class="btn btn-outline-secondary" href="<?= Helpers::route('auth/logout') ?>">Logout</a>
        <?php else: ?>
          <a class="btn btn-primary me-2" href="<?= Helpers::route('auth/login') ?>">Login</a>
          <a class="btn btn-success" href="<?= Helpers::route('auth/register') ?>">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<main class="container my-4">
  <?php if ($msg = Helpers::flash('error')): ?>
    <div class="alert alert-danger"><?= Helpers::e($msg) ?></div>
  <?php endif; ?>
  <?php if ($msg = Helpers::flash('success')): ?>
    <div class="alert alert-success"><?= Helpers::e($msg) ?></div>
  <?php endif; ?>
  <?= $content ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>