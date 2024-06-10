<?php

?>

<?php require_once 'src/layouts/header.php'; ?>

<?php if (isset($user)): ?>
  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Welcome, <?= $user; ?>!
          </h1>
          <p class="text-gray-500">This is your dashboard.</p>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php require_once 'src/layouts/footer.php'; ?>