<?php

require_once '../app/Motorcycle.php';

$motorcycle_id = $_GET['motorcycle_id'];
if ($Motorcycle->deleteMotorcycles($motorcycle_id)) {
  echo "<script>
      alert('Motorcycle deleted successfully');
    </script>";
  header("Location: /rental-motor-listrik/motor.php");
  ;
}


