<?php require_once 'src/layouts/header.php'; ?>

<?php if ($user && $role == ROLE_ADMIN): ?>
  <section>
    <h1><?= $user; ?></h1>
    <p>Admin</p>
  </section>
<?php elseif ($user && $role == ROLE_USER): ?>
  <section>
    <h1><?= $user; ?></h1>
    <p>User</p>
  </section>
<?php endif ?>

<?php require_once 'src/layouts/footer.php'; ?>