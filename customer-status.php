<?php
require_once "src/layouts/header.php";
require_once "app/Rental.php";

$rentals = $Rental->getRentedMotorcycle();

?>

<div class="p-8">
  <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
    <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900">Motorcycle Rental Info</h1>
    <hr>
    <div class="mx-5 border border-slate-200 rounded-md my-2">
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
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu
              Berjalan</th>
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
                <div class="text-sm text-gray-900" id="elapsed-time-<?= $index ?>"></div>
                <script>
                  function updateElapsedTime(startTime, elementId) {
                    const startDate = new Date(startTime);
                    const now = new Date();
                    const diff = now - startDate;

                    const diffSeconds = Math.floor(diff / 1000);
                    const diffMinutes = Math.floor(diffSeconds / 60);
                    const diffHours = Math.floor(diffMinutes / 60);
                    const diffDays = Math.floor(diffHours / 24);

                    const seconds = diffSeconds % 60;
                    const minutes = diffMinutes % 60;
                    const hours = diffHours % 24;

                    document.getElementById(elementId).innerText =
                      `${diffDays}d ${hours}h ${minutes}m ${seconds}s`;

                    setTimeout(() => updateElapsedTime(startTime, elementId), 1000);
                  }

                  const startTime = "<?= $rental['waktu_sewa'] ?>";
                  const elementId = "elapsed-time-<?= $index ?>";
                  updateElapsedTime(startTime, elementId);
                </script>
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