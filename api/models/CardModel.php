<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Expose-Headers: *");

class CardModel {

    private $db;
    private $table_name = "cards";

    public function __construct() {
      $conn = new Connection();
      $this->db = $conn->getConnection();
    }

    public function createNew($text, $sprint_id, $lane_id) {
        $query = "INSERT INTO $this->table_name (text, sprint_id, lane_id) VALUES ('$text', '$sprint_id', '$lane_id')";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "Success!";
        } else {
            echo "Not success :( ..." . $this->db->error;
        }
    }

    public function getAll() {

        $query = "SELECT * FROM $this->table_name";

        $result = mysqli_query($this->db, $query);

        $sprints = [];

        if ($result) {
            foreach ($result as $row) {
                $sprints[] = array(
                    'id' => $row['id'],
                    'text' => $row['text'],
                    'votes' => $row['votes'],
                    'sprint_id' => $row['sprint_id'],
                    'lane_id' => $row['lane_id'],
                );
            }
        }

        echo json_encode($sprints);

    }


    public function update($id, $text) {
        $query = "UPDATE $this->table_name
        SET text='$text'
        WHERE id='$id'";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "Success: updated $id!";
        } else {
            echo "Not success :( ..." . $this->db->error;
        }
    }


}