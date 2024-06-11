<?php
require_once 'Database.php';

class Motorcycle extends Database
{
  private $tb_name = "electric_motorcycles";
  public function __construct()
  {
    parent::__construct();
  }

  public function getMotorcycles()
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_name");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }
}

$Motorcycle = new Motorcycle();