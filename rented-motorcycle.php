<?php
require_once "src/layouts/header.php";
require_once "app/Rental.php";

$rentals = $Rental->getRentedMotorcycle();

?>

<div class="p-4 sm:ml-64">
  <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
    <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900 ">Motorcycle List</h1>
    <hr>
    <div class="mx-5 border border-slate-200 rounded-md my-2">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              No</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Motorcycle</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Rental start time</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Return time</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Total cost</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Payments status</th>
            <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Running time</th> -->
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php $number = 1 ?>
          <?php foreach ($rentals as $index => $rental): ?>
            <?php if ($rental['status_pembayaran'] == null): ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $number++ ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $rental['fullname'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $rental['merk'] ?> - <?= $rental['model'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $rental['waktu_sewa'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    <?= $rental['waktu_kembali'] == null ? "-" : $rental['waktu_kembali'] ?>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    <?= $rental['total_biaya'] == null ? "-" : $rental['total_biaya'] ?>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    <?php if ($rental['status_pembayaran'] == null): ?>
                      <span>
                        -
                      </span>
                    <?php else: ?>
                      <span class="bg-green-200 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                        <?= $rental['status_pembayaran'] ?>
                      </span>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
            <?php endif ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once "src/layouts/footer.php" ?>