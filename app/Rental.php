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

  public function rentalMotorcyclesByID($motorcycle_id, $user_id)
  {
    // Periksa ketersediaan sepeda motor
    $queryCheck = "SELECT status FROM $this->tb_motorcycle WHERE motorcycle_id = '$motorcycle_id'";
    $resultCheck = $this->conn->query($queryCheck);

    if ($resultCheck && $resultCheck->num_rows > 0) {
      $data = $resultCheck->fetch_assoc();
      $status = $data['status'];

      // Jika sepeda motor tersedia
      if ($status == 1) {
        // Simpan waktu sewa
        $current_time = date('Y-m-d H:i:s');

        // Lakukan penyewaan
        $queryRent = "INSERT INTO $this->tb_rentals (user_id, motorcycle_id, waktu_sewa) VALUES ('$user_id', '$motorcycle_id', '$current_time')";
        $resultRent = $this->conn->query($queryRent);

        if ($resultRent) {
          return true; // Jika berhasil menyewa
        } else {
          return "Gagal menyewa motorcycle";
        }
      } else {
        // return "Motorcycle dengan ID $motorcycle_id tidak tersedia untuk disewa.";
        return false;
      }
    } else {
      return "Motorcycle dengan ID $motorcycle_id tidak ditemukan.";
    }
  }


}

$Rental = new Rental();

