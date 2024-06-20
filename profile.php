<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';

$user_id = $_SESSION['user_id'];
$user = $User->getUsersBId($user_id)[0];
// var_dump($user);

if (isset($_POST['edit_user'])) {
  if ($User->editUser($_POST)) {
    echo "<script>
      alert('Success to updated');
      window.location.href = 'profile.php';
    </script>";
  } else {
    echo "<script>
      alert('Failed to update');
      window.location.href = 'profile.php';
    </script>";
  }
}
?>

<div class="py-10 pt-20">
  <div class=" p-8 bg-white shadow-2xl rounded-lg max-w-6xl mx-auto">
    <div class="text-center">
      <h1 class="text-4xl font-bold text-gray-900"><?= $user['username'] ?></h1>
      <h2 class="text-2xl text-gray-700 mt-2"><?= $user['fullname'] ?></h2>
    </div>
    <div class="mt-8">
      <h3 class="text-lg font-medium text-gray-700">Email</h3>
      <p class="text-gray-600"><?= $user['email'] ?></p>
    </div>
    <div class="mt-4">
      <h3 class="text-lg font-medium text-gray-700">Phone</h3>
      <p class="text-gray-600"><?= $user['phone'] ?></p>
    </div>
    <div class="mt-4">
      <h3 class="text-lg font-medium text-gray-700">Address</h3>
      <p class="text-gray-600"><?= $user['address'] == null ? '-' : $user['address'] ?></p>
    </div>
    <button class="btnModalEditLocation bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-5 mt-6 rounded"
      data-user-id="<?= $user['user_id'] ?>" data-user-fullname="<?= $user['fullname'] ?>"
      data-user-email="<?= $user['email'] ?>" data-user-phone="<?= $user['phone'] ?>"
      data-user-address="<?= $user['address'] ?>">
      Edit
    </button>
  </div>
</div>


<!-- Modal Edit User -->
<div id="modalEditUser"
  class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-1/3">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4">
      <h2 class="text-lg font-semibold">Edit</h2>
      <button id="closeModalEditUser" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <!-- Form Edit User -->
      <form id="formEditUser" method="POST">
        <input type="hidden" id="edit_user_id" name="user_id">

        <!-- Input for fullname -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_fullname">Fullname</label>
          <input type="text" id="edit_fullname" name="fullname"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter fullname">
        </div>

        <!-- Input for email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_email">Email</label>
          <input type="email" id="edit_email" name="email"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter email">
        </div>

        <!-- Input for phone -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_phone">Phone</label>
          <input type="number" id="edit_phone" name="phone"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter phone">
        </div>

        <!-- Input for Address-->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_address">Address</label>
          <textarea type="text" id="edit_address" name="address"
            class="shadow appearance-none border rounded w-full py-2 px-3 h-32 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter address"></textarea>

        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
          <button type="submit" name="edit_user"
            class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const modalEditUser = document.getElementById('modalEditUser');
  const closeModalEditUser = document.getElementById('closeModalEditUser');
  const editButtons = document.querySelectorAll('.btnModalEditLocation');

  editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      modalEditUser.classList.remove('hidden');

      const userId = button.getAttribute('data-user-id');
      const userFullname = button.getAttribute('data-user-fullname');
      const userEmail = button.getAttribute('data-user-email');
      const userPhone = button.getAttribute('data-user-phone');
      const userAddress = button.getAttribute('data-user-address');

      document.getElementById('edit_user_id').value = userId;
      document.getElementById('edit_fullname').value = userFullname;
      document.getElementById('edit_email').value = userEmail;
      document.getElementById('edit_phone').value = userPhone;
      document.getElementById('edit_address').value = userAddress;
    });
  });

  closeModalEditUser.addEventListener('click', (event) => {
    modalEditUser.classList.add('hidden');
  });

  const alertClose = document.getElementById("alert-close");
  alertClose.addEventListener("click", function () {
    document.getElementById("alert").classList.add("hidden");
    window.location.href = "motor.php";
  })
</script>


<?php require_once 'src/layouts/footer.php'; ?>