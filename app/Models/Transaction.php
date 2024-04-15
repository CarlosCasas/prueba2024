<?php

class Transaction
{
    private $id;
    private $user_payer_id;
    private $user_payee_id;
    private $amount;
    private $status; // 1: Pending, 2: Approved, 3: Rejected, 4: Reversed

    // Getters and setters...

    public function __construct($user_payer_id, $user_payee_id, $amount, $status=NULL)
    {
        //$this->id = $id;
        $this->user_payer_id = $user_payer_id;
        $this->user_payee_id = $user_payee_id;
        $this->amount = $amount;
        $this->status = $status;
    }

    
    // Methods 
    public function getId()
    {
        return $this->id;
    }

    public function getUserPayerId()
    {
        return $this->user_payer_id;
    }

    public function getUserPayeeId()
    {
        return $this->user_payee_id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserPayerId($user_payer_id)
    {
        $this->user_payer_id = $user_payer_id;
    }

    public function setUserPayeeId($user_payee_id)
    {
        $this->user_payee_id = $user_payee_id;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

}