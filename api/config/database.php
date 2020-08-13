<?php
class Connection {
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "funretroclone";
    private $username = "root";
    private $password = "";
    public $db;
  
    // get the database connection
    public function getConnection(){
  
        $this->db = null;

        $this->db = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
  
        if (!$this->db) {
            echo "Error: " . mysqli_connect_errno();
            die();
        }
  
        return $this->db;
    }
}