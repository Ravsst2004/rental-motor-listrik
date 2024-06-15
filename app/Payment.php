<?php

require_once 'Database.php';

class Payment extends Database
{
  private $tb_payments = "payments";
  private $tb_users = "users";
  private $tb_rentals = "rentals";
  private $tb_motorcycle = "electric_motorcycles";
  public function __construct()
  {
    parent::__construct();
  }

  public function getPayments()
  {
    $query = "SELECT * FROM $this->tb_payments 
    INNER JOIN $this->tb_rentals ON $this->tb_payments.rental_id = $this->tb_rentals.rental_id 
    INNER JOIN $this->tb_users ON $this->tb_rentals.user_id = $this->tb_users.user_id
    INNER JOIN $this->tb_motorcycle ON $this->tb_rentals.motorcycle_id = $this->tb_motorcycle.motorcycle_id
    ";
    $result = $this->conn->query($query);
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function getPaymentsWithPagination($payments_per_page, $offset)
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_payments 
    INNER JOIN $this->tb_rentals ON $this->tb_payments.rental_id = $this->tb_rentals.rental_id 
    INNER JOIN $this->tb_users ON $this->tb_rentals.user_id = $this->tb_users.user_id
    INNER JOIN $this->tb_motorcycle ON $this->tb_rentals.motorcycle_id = $this->tb_motorcycle.motorcycle_id 
    LIMIT $payments_per_page OFFSET $offset");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }
}

$Payment = new Payment();