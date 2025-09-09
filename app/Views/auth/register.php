<?php use App\Core\Helpers; ?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <h3>Create your account</h3>
    <form method="post">
      <?= Helpers::csrfInput() ?>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Password (min 6)</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success">Create account</button>
    </form>
  </div>
</div>