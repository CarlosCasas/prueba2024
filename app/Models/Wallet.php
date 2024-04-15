<?php

class Wallet
{
    private $id;
    private $user_id;
    private $balance;
    const OPERACION_INGRESO = 1; //Cuando el monto transferido al usuario aumente su Wallet
    const OPERACION_EGRESO = 2; // Cuando el monto transferido disminuye su Wallet del usuario
    // Getters and setters...

    public function __construct($id = null, $user_id, $balance = 0)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->balance = $balance;
    }

    // Methods .

    public function toArray()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'balance' => $this->balance,
        ];
    }

    public static function toArrayFormat($array)
    {
        $listaArray = [];
        foreach ($array as $arr) {
            $listaArray = $arr->toArray();
        }
        return $listaArray;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

}