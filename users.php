<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';

$users = $User->getUsers();

// pagination
$total_users = count($users);
$users_per_page = 10;
$total_pages = ceil($total_users / $users_per_page);
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
  $current_page = 1;
} elseif ($current_page > $total_pages) {
  $current_page = $total_pages;
}
$offset = ($current_page - 1) * $users_per_page;
$users = $User->getUsersWithPagination($users_per_page, $offset);
?>

<div class="p-4 sm:ml-64">

  <!-- Table -->
  <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
    <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900 ">Customers List</h1>
    <hr>
    <div class="mx-5 border border-slate-200 rounded-md my-2">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              No</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Username</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Email</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Full Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Address</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Phone</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php $number = ($current_page - 1) * $users_per_page + 1; ?>
          <?php foreach ($users as $user): ?>
            <?php if ($user['role'] == 2): ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $number++ ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['username'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['email'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['fullname'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['address'] ?: '-' ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['phone'] ?></div>
                </td>
              </tr>
            <?php endif ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination button -->
  <div class="flex gap-x-4 mt-4">
    <div>
      <?php if ($current_page > 1): ?>
        <a href="?page=<?= $current_page - 1 ?>"
          class="text-slate-100 rounded-lg p-2 border bg-blue-700 hover:bg-blue-900">Previous</a>
      <?php endif; ?>
    </div>
    <div>
      <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?= $current_page + 1 ?>"
          class="text-slate-100 rounded-lg p-2 border bg-blue-700 hover:bg-blue-900">Next</a>
      <?php endif; ?>
    </div>
  </div>

</div>
</div>


<?php require_once 'src/layouts/footer.php'; ?>