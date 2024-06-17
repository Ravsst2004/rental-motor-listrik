<?php
require_once 'src/layouts/header.php';
require_once 'app/Location.php';

$locations = $Location->getLocations();

if (isset($_POST['edit_location'])) {
  if ($Location->updateLocation($_POST)) {
    echo "<script>
      alert('Location updated successfully');
      window.location.href = 'location.php';
    </script>";
  }
}

// Add Location
$error = false;
if (isset($_POST['add_location'])) {
  if ($Location->addLocation($_POST)) {
    $error = $Location->addLocation($_POST);
  }
}


// Pagination
$total_locations = count($locations);
$locations_per_page = 8;
$total_pages = ceil($total_locations / $locations_per_page);
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
  $current_page = 1;
} elseif ($current_page > $total_pages) {
  $current_page = $total_pages;
}
$offset = ($current_page - 1) * $locations_per_page;
$locations = $Location->getlocationsWithPagination($locations_per_page, $offset);
?>



<!-- Alert -->
<div class="flex justify-center items-center mx-auto">
  <?php if ($error): ?>
    <div id="alert" class="absolute w-[30rem] top-96 p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50"
      role="alert">
      <div class="flex items-center">
        <h3 class="text-lg font-medium">Error</h3>
      </div>
      <div class="mt-2 mb-4 text-sm">
        <?= $error ?>
      </div>
      <div class="flex">
        <button type="button" id="alert-close"
          class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
          data-dismiss-target="#alert-additional-content-3" aria-label="Close">
          Close
        </button>
      </div>
    </div>
  <?php endif; ?>
</div>

<div class="p-4 sm:ml-64">
  <div class="flex w-full gap-x-5">
    <!-- Form Add Location -->
    <div class="w-[40%]">
      <div class="w-full">
        <form class="bg-white shadow-md border border-slate-200 rounded px-8 pt-6 pb-8 mb-4" method="POST">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="location_name">
              Location Name
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="location_name" name="location_name" type="text" placeholder="Enter location name">
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="location_address">
              Location Address
            </label>
            <textarea
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-36 max-h-80"
              id="location_address" name="location_address" placeholder="Enter location address"></textarea>
          </div>
          <div class="flex items-center justify-between">
            <button
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              name="add_location" type="submit">
              Add Location
            </button>
          </div>
        </form>
      </div>

    </div>

    <!-- Table Location List -->
    <div class="w-[60%]">
      <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
        <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900 ">Location list</h1>
        <hr>
        <div class="mx-5 border border-slate-200 rounded-md my-2">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  No
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nama Lokasi
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Alamat Lokasi
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php $number = ($current_page - 1) * $locations_per_page + 1; ?>
              <?php foreach ($locations as $location): ?>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $number++ ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $location['location_name'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $location['location_address'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap flex gap-x-2">
                    <a class="btnModalEditLocation bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                      data-locationId="<?= $location['location_id'] ?>"
                      data-locationName="<?= $location['location_name'] ?>"
                      data-locationAddress="<?= $location['location_address'] ?>">
                      Edit
                    </a>
                    <a href="functions/location_delete.php?location_id=<?= $location['location_id'] ?>"
                      onclick="return confirm('Are you sure you want to delete this location?')"
                      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                      Delete
                    </a>
                  </td>
                </tr>
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
</div>


<!-- Modal Edit Location -->
<div id="modalEditLocation"
  class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-1/3">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4">
      <h2 class="text-lg font-semibold">Edit Location</h2>
      <button id="closeModalEditLocation" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <!-- Form Edit Location -->
      <form id="formEditLocation" method="POST">
        <input type="hidden" id="edit_location_id" name="edit_location_id">
        <div class="mb-4">
          <label for="edit_location_name" class="block text-gray-700 text-sm font-bold mb-2">Location Name</label>
          <input type="text" id="edit_location_name" name="edit_location_name"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter location name">
        </div>
        <div class="mb-6">
          <label for="edit_location_address" class="block text-gray-700 text-sm font-bold mb-2">Location Address</label>
          <textarea id="edit_location_address" name="edit_location_address"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-36 max-h-80"
            placeholder="Enter location address"></textarea>
        </div>
        <div class="flex items-center justify-end">
          <button type="submit" name="edit_location"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            name="edit_location">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const modalEditLocation = document.getElementById('modalEditLocation');
  const closeModalEditLocation = document.getElementById('closeModalEditLocation');
  const editButtons = document.querySelectorAll('.btnModalEditLocation');

  editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      modalEditLocation.classList.remove('hidden');
      const locationId = button.getAttribute('data-locationId');
      const locationName = button.getAttribute('data-locationName');
      const locationAddress = button.getAttribute('data-locationAddress');

      document.getElementById('edit_location_id').value = locationId;
      document.getElementById('edit_location_name').value = locationName;
      document.getElementById('edit_location_address').value = locationAddress;
    });
  });

  closeModalEditLocation.addEventListener('click', (event) => {
    modalEditLocation.classList.add('hidden');
  });

  const alertClose = document.getElementById("alert-close");
  alertClose.addEventListener("click", function () {
    document.getElementById("alert").classList.add("hidden");
    window.location.href = "location.php";
  })
</script>



<?php require_once 'src/layouts/footer.php'; ?>