<?php

require_once '../app/Rental.php';
require_once '../app/Payment.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['rental_id'])) {
    $rental_id = $_POST['rental_id'];
    // echo $Rental->returnMotorcycle($rental_id);
    // die();
    if ($Rental->returnMotorcycle($rental_id)) {
      echo "<script>
      alert('Return successfully');
      window.location.href = '../index.php';
    </script>";
    } else {
      echo "Return Failed";
    }
    // if ($Rental->updateStatusRental($rental_id)) {
    //   echo "Update Rental Status Success";
    // if ($Payment->setPayment($rental_id, $rental_time, $current_time)) {
    //   echo "Payment Success";
    // } else {
    //   echo "Payment Failed";
    // }
    // }
  }
}