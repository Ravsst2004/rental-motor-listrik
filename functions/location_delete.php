<?php
require_once '../app/Location.php';

$location_id = $_GET['location_id'];
if ($Location->deleteLocation($location_id)) {
  echo "<script>
      alert('Location deleted successfully');
    </script>";
  header("Location: /rental-motor-listrik/location.php");
  ;
}
