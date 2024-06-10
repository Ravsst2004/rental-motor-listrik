<?php
class Database
{
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "sewa_motor";
  protected $conn;

  public function __construct()
  {
    return $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
  }
}
