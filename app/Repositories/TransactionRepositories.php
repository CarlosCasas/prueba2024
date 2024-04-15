<?php
namespace App\Repositories;

use Transaction;

require_once '../App/Models/Transaction.php';
require_once(__DIR__ . '/../Config/database.php');

class TransactionRepositories
{

    private $conn;
    private $table = 'user_transaction'; 

    public function __construct()
    {
        //$this->conn = $conn;
        $this->conn = include(__DIR__ . '/../Config/database.php');
    }

    public function insertTransaction(Transaction $transaction)
    {
        //print_r($transaction);exit;
        $this->conn->begin_transaction();
        $sql = "INSERT INTO user_transaction (user_payer_id, user_payee_id, amount, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        // Asignar los valores a variables
        $userPayerId = $transaction->getUserPayerId();
        $userPayeeId = $transaction->getUserPayeeId();
        $amount = $transaction->getAmount();
        $status = $transaction->getStatus();

        try {
            // Pasar las variables por referencia a bind_param
            $stmt->bind_param("iiii", $userPayerId, $userPayeeId, $amount, $status);
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                $transactionId = $this->conn->insert_id;
                $this->conn->commit();
                return $transactionId;
            } else {
                return null;
            }
        } catch (\Throwable $e) {
            // Error al insertar la transacción, hacer rollback y retornar null
            $this->conn->rollback();
            return null;
        }
    }

    public function updateInactiveTransaction($id)
    {
        
        $this->conn->begin_transaction();
        $sql = "UPDATE user_transaction SET status = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
         // Asignar los valores a variables
         //print_r($newBalance); exit;
         try {
            $stmt->bind_param("i", $id);
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