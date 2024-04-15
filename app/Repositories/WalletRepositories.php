<?php
namespace App\Repositories; 
use Wallet;

require_once '../App/Models/Wallet.php';
require_once(__DIR__ . '/../Config/database.php');

class WalletRepositories
{
    private $conn;
    private $table = 'user_wallet'; 

    public function __construct()
    {
        //$this->conn = $conn;
        $this->conn = include(__DIR__ . '/../Config/database.php');
    }

    public function getBalance($id)
    {
        $sql = "SELECT * FROM user_wallet WHERE user_id = ?";        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        //print_r($stmt);exit;
        $stmt->execute();
        $result = $stmt->get_result();
        //print_r($result);exit;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //print_r($row);exit;
            $users[] = new Wallet($row['id'], $row['user_id'],$row['balance'], $row['created_at']);
            return $users;
        } else {
            return null;
        }
    }

    public function updateBalance($walletId,$amount,$operacion)
    {
        $wallet = wallet::toArrayFormat($walletId);
        $balance=$wallet['balance'];
        if($operacion == wallet::OPERACION_EGRESO) {
            $newAmount = $balance + $amount;
        }else{
            $newAmount = $balance - $amount;
        }
        
        $this->conn->begin_transaction();
        $sql = "UPDATE user_wallet SET balance = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
         // Asignar los valores a variables
         //print_r($newBalance); exit;
         try {
            $stmt->bind_param("ii", $newAmount,$wallet['id']);
            $stmt->execute();
            $this->conn->commit();
            return $stmt->affected_rows;
        } catch (\Throwable $e) {
            // Error al insertar la transacción, hacer rollback y retornar null
            $this->conn->rollback();
            return null;
        }

        
    }

    
}