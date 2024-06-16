<?php
require_once "src/layouts/header.php";
require_once "app/Rental.php";

$user_id = $_SESSION['user_id'];
$rentals = $Rental->getRentedMotorcycleByCustomer($user_id);

?>

<div class="p-8">
  <div class="border border-slate-200 rounded-md shadow-md">
    <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900">Motorcycle Rental Info</h1>
    <hr>
    <div class="mx-5 border overflow-x-auto border-slate-200 rounded-md my-2 overflow-y-auto max-h-[45rem]">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Motorcycle</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Rental Start Time</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Return Time</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
              Cost</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Payment Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php foreach ($rentals as $index => $rental): ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $index + 1 ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $rental['merk'] ?> - <?= $rental['model'] ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $rental['waktu_sewa'] ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?= $rental['waktu_kembali'] == null ? '-' : $rental['waktu_kembali'] ?>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $rental['total_biaya'] == null ? '-' : $rental['total_biaya'] ?>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?php if ($rental['status_pembayaran'] == null): ?>
                    <form action="functions/process_payment.php" method="POST">
                      <input type="hidden" name="rental_id" value="<?= $rental['rental_id'] ?>">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Pay Now
                      </button>
                    </form>
                  <?php elseif ($rental['status_pembayaran'] == "pending"): ?>
                    <span class="text-sm text-yellow-500">Pending</span>
                  <?php else: ?>
                    <span class="text-sm text-green-500">Paid</span>
                  <?php endif ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>



<?php require_once "src/layouts/footer.php"; ?>