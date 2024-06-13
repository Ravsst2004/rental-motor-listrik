<?php
require_once 'Database.php';

class Rental extends Database
{
  private $tb_rentals = "rentals";
  private $tb_motorcycle = "electric_motorcycles";

  public function __construct()
  {
    parent::__construct();
  }

  public function rentalMotorcyclesByID($motorcycle_id, $customer_name, $rental_duration)
  {
    // Validasi ketersediaan motor
    if (!$this->isMotorcycleAvailable($motorcycle_id)) {
      return "Motorcycle dengan ID $motorcycle_id tidak tersedia untuk disewa.";
    }

    $query = "INSERT INTO $this->tb_rentals (motorcycle_id, customer_name, rental_duration) VALUES ('$motorcycle_id', '$customer_name', '$rental_duration')";
    $result = $this->conn->query($query);

    if ($result) {
      return "Motorcycle berhasil disewa oleh $customer_name";
    } else {
      return "Gagal menyewa motorcycle";
    }
  }

  private function isMotorcycleAvailable($motorcycle_id)
  {
    $query = "SELECT status FROM $this->tb_motorcycle WHERE motorcycle_id = '$motorcycle_id'";
    $result = $this->conn->query($query);

    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $status = $data['status'];
      return $status == 1;
    }
    return false;
  }
}

$Rental = new Rental();

