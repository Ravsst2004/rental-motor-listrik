<?php
require_once 'src/layouts/header.php';
require_once 'app/Rental.php';
require_once 'app/Motorcycle.php';

$user_id = $_SESSION['user_id'];
$motorcycles = $Motorcycle->getMotorcycles();
?>

<div class="flex justify-center items-center mx-auto gap-x-9">
  <div class="grid grid-cols-4 gap-4 mx-auto pt-5">

    <?php foreach ($motorcycles as $motorcycle): ?>
      <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
        <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?= $motorcycle['merk'] ?> -
            <?= $motorcycle['model'] ?>
          </h5>
        </a>
        <p class="mb-3 font-normal text-gray-400">Price/hour Rp. <?= $motorcycle['hourly_rental_price'] ?></p>
        <button data-id="<?= $motorcycle['motorcycle_id'] ?>" data-merk="<?= $motorcycle['merk'] ?>"
          data-model="<?= $motorcycle['model'] ?>" data-year="<?= $motorcycle['year'] ?>"
          data-price="<?= $motorcycle['hourly_rental_price'] ?>"
          class="open-modal inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
          Rent now!
        </button>
      </div>
    <?php endforeach ?>

  </div>
</div>



<!-- Modal -->
<div id="modalRentMotorcycle"
  class="hidden fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
  <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4 rounded-t-lg">
      <h2 class="text-lg font-semibold">Rental Motorcycle</h2>
      <button id="closemodalRentMotorcycle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <h5 id="modal_merk_model" class="mb-2 text-2xl font-bold tracking-tight text-gray-900"></h5>
      <p id="modal_year" class="mb-3 font-normal text-gray-700"></p>
      <p id="modal_price" class="mb-3 font-normal text-gray-700"></p>

      <form id="rentalForm" method="POST" action="functions/process_rental.php">
        <input type="hidden" id="modal_motorcycle_id" name="motorcycle_id">
        <input type="hidden" id="modal_user_id" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Confirm Rent
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modalRentMotorcycle");
    const closeModalBtn = document.getElementById("closemodalRentMotorcycle");
    const openModalBtns = document.querySelectorAll(".open-modal");

    openModalBtns.forEach(button => {
      button.addEventListener("click", function () {
        const motorcycleId = this.getAttribute("data-id");
        const merk = this.getAttribute("data-merk");
        const model = this.getAttribute("data-model");
        const year = this.getAttribute("data-year");
        const price = this.getAttribute("data-price");

        document.getElementById("modal_motorcycle_id").value = motorcycleId;
        document.getElementById("modal_merk_model").textContent = `${merk} - ${model}`;
        document.getElementById("modal_year").textContent = `Year: ${year}`;
        document.getElementById("modal_price").textContent = `Price/hour: Rp. ${price}`;

        modal.classList.remove("hidden");
      });
    });

    closeModalBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
    });
  });
</script>

<?php require_once 'src/layouts/footer.php'; ?>