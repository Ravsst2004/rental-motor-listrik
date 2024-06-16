<?php
require_once 'Database.php';

class Rental extends Database
{
  private $tb_rentals = "rentals";
  private $tb_motorcycle = "electric_motorcycles";
  private $tb_locations = "locations";
  private $tb_users = "users";
  private $tb_payments = "payments";

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

      if ($status == 1) {
        date_default_timezone_set('Asia/Makassar');
        $current_time = date('Y-m-d H:i:s');

        $queryRent = "INSERT INTO $this->tb_rentals (user_id, motorcycle_id, waktu_sewa) VALUES ('$user_id', '$motorcycle_id', '$current_time')";
        $resultRent = $this->conn->query($queryRent);

        if ($resultRent) {
          return true;
        } else {
          return "Gagal menyewa motorcycle";
        }
      } else {
        return false;
      }
    } else {
      return "Motorcycle dengan ID $motorcycle_id tidak ditemukan.";
    }
  }

  public function getrentalsWithPagination($rentals_per_page, $offset)
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_rentals LIMIT $rentals_per_page OFFSET $offset");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function getRentedMotorcycle()
  {
    $query = "SELECT * FROM $this->tb_motorcycle INNER JOIN $this->tb_rentals ON $this->tb_rentals.motorcycle_id = $this->tb_motorcycle.motorcycle_id
    INNER JOIN $this->tb_users ON $this->tb_rentals.user_id = $this->tb_users.user_id
    INNER JOIN $this->tb_locations ON $this->tb_motorcycle.location_id = $this->tb_locations.location_id";
    $result = $this->conn->query($query);
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function returnMotorcycle($rental_id)
  {
    date_default_timezone_set('Asia/Makassar');
    $current_time = date('Y-m-d H:i:s');

    $query = "SELECT * FROM $this->tb_rentals WHERE rental_id = '$rental_id'";
    $result = $this->conn->query($query);
    $rental = mysqli_fetch_assoc($result);

    if ($rental) {
      $motorcycle_id = $rental['motorcycle_id'];
      $query = "SELECT * FROM $this->tb_motorcycle WHERE motorcycle_id = '$motorcycle_id'";
      $motor_result = $this->conn->query($query);
      $motor = mysqli_fetch_assoc($motor_result);
      if ($motor) {
        $waktu_sewa = strtotime($rental['waktu_sewa']);
        $waktu_kembali = strtotime($current_time);
        $durasi_sewa_seconds = $waktu_kembali - $waktu_sewa;
        $durasi_sewa_hours = $durasi_sewa_seconds / 3600;
        $durasi_sewa_hours = ceil($durasi_sewa_hours);
        $harga_sewa_per_jam = $motor['hourly_rental_price'];
        $total_biaya = $durasi_sewa_hours * $harga_sewa_per_jam;

        $update_query = "UPDATE $this->tb_rentals 
                             SET waktu_kembali = '$current_time', 
                                 total_biaya = '$total_biaya', 
                                 status_pembayaran = 'pending' 
                             WHERE rental_id = '$rental_id'";
        $result = $this->conn->query($update_query);
        if ($result) {
          return true;
        }
      }
    }
  }

  public function getRentedMotorcycleByCustomer($user_id)
  {
    $query = "SELECT * FROM $this->tb_motorcycle
          INNER JOIN $this->tb_rentals ON $this->tb_rentals.motorcycle_id = $this->tb_motorcycle.motorcycle_id
          INNER JOIN $this->tb_users ON $this->tb_rentals.user_id = $this->tb_users.user_id
          INNER JOIN $this->tb_locations ON $this->tb_motorcycle.location_id = $this->tb_locations.location_id 
          WHERE $this->tb_users.user_id = $user_id";

    $result = $this->conn->query($query);
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function confirmPayment($rental_id, $motorcycle_id, $total_payment, $current_time)
  {
    $query = "UPDATE $this->tb_rentals SET status_pembayaran = 'berhasil' WHERE rental_id = '$rental_id'";
    $result = $this->conn->query($query);

    if ($result) {
      $query = "UPDATE $this->tb_motorcycle SET status = 1 WHERE motorcycle_id = '$motorcycle_id'";
      $result = $this->conn->query($query);

      if ($result) {
        $query = "INSERT INTO $this->tb_payments (rental_id, jumlah_pembayaran, tanggal_pembayaran) VALUES ('$rental_id', '$total_payment', '$current_time')";
        $result = $this->conn->query($query);

        if ($result) {
          echo "Payment Success";
          header("Location: ../admin-dashboard.php");
        } else {
          return false;
        }
      }
    } else {
      return false;
    }

  }
}

$Rental = new Rental();

