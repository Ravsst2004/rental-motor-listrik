<?php
require_once '../app/Rental.php';

$rental_id = $_POST['rental_id'];
$motorcycle_id = $_POST['motorcycle_id'];
$total_payment = $_POST['total_biaya'];
$return_time = $_POST['waktu_kembali'];

if ($Rental->confirmPayment($rental_id, $motorcycle_id, $total_payment, $return_time)) {
  echo "Payment Success";
  header("Location: ../admin-dashboard.php");
} else {
  echo "Payment Failed";
}