<?php
require_once '../app/Rental.php';

$rental_id = $_POST['rental_id'];
$motorcycle_id = $_POST['motorcycle_id'];
$total_payment = $_POST['total_biaya'];
$return_time = $_POST['waktu_kembali'];


// echo "Rental ID:" . $rental_id;
// echo '<br/>';
// echo "Motorcycle ID:" . $motorcycle_id;
// echo '<br/>';
// echo "Total Payment:" . $total_payment;
// echo '<br/>';
// echo "Return Time:" . $return_time;
// date_default_timezone_set('Asia/Makassar');
// echo 'Current timezone: ' . date_default_timezone_get() . "\n";
// echo 'Current time: ' . date('Y-m-d H:i:s') . "\n";
// exit();

if ($Rental->confirmPayment($rental_id, $motorcycle_id, $total_payment, $return_time)) {
  echo "Payment Success";
  header("Location: ../admin-dashboard.php");
} else {
  echo "Payment Failed";
}