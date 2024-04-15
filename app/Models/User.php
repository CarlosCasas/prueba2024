<?php
namespace App\Models;

class User
{
    private $id;
    private $name;
    private $lastname;
    private $document;
    private $email;
    private $password;
    private $type; // 1: Common, 2: Merchant

    // Getters and setters...

    public function __construct($name, $lastname, $document, $email, $password, $type, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->document = $document;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->type = $type;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'document' => $this->document,
            'email' => $this->email,
            'type' => $this->type
        ];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getType()
    {
        return $this->type;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDocument($document)
    {
        $this->document = $document;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setType($type)
    {
        $this->type = $type;
    }


}