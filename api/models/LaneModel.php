<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Expose-Headers: *");

class LaneModel {

    private $db;
    private $table_name = "lanes";

    public function __construct() {
      $conn = new Connection();
      $this->db = $conn->getConnection();
    }

    public function getAll() {

        $query = "SELECT * FROM $this->table_name";

        $result = mysqli_query($this->db, $query);

        $sprints = [];

        if ($result) {
            foreach ($result as $row) {
                $sprints[] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'color' => $row['color'],
                );
            }
        }

        echo json_encode($sprints);

    }


    public function createNew($title, $color) {
        $query = "INSERT INTO $this->table_name (title, color) VALUES ('$title', '$color')";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "Success!";
        } else {
            echo "Not success :( ..." . $this->db->error;
        }
    }


    public function update($id, $title, $color) {
        $query = "UPDATE $this->table_name
        SET title='$title', color='$color'
        WHERE id='$id'";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "Success: updated $id!";
        } else {
            echo "Not success :( ..." . $this->db->error;
        }
    }


    public function destroy($id) {
        $query = "DELETE FROM $this->table_name WHERE id = '$id'";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "Success fully deleted $id!";
        } else {
            echo "Not success :( ..." . $this->db->error;
        }
    }




}