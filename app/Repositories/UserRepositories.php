<?php
namespace App\Repositories; 
use App\Models\User;
require_once '../App/Models/User.php';
require_once(__DIR__ . '/../Config/database.php');

class UserRepositories
{
    private $conn;
    private $table = 'user'; 

    public function __construct()
    {
        //$this->conn = $conn;
        $this->conn = include(__DIR__ . '/../Config/database.php');
    }

    public function findAllUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = new User($row['id'], $row['name'],$row['lastname'], $row['document'], $row['email'], $row['password'], $row['type']);
            }
        }
        return $users;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        //print_r($stmt);exit;
        $stmt->execute();
        $result = $stmt->get_result();
        //print_r($result);exit;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //print_r($row);exit;
            $users[] = new User($row['id'], $row['name'],$row['lastname'], $row['document'], $row['email'], $row['password'], $row['type']);
            return $users;
        } else {
            return null;
        }
    }


}