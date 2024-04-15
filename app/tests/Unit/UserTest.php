<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $name = 'John Doe';
        $document = '12345678';
        $email = 'johndoe@example.com';
        $password = 'secret';
        $type = 1; // Common User

        /*$user = new User(null, $name, $document, $email, $password, $type);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($document, $user->getDocument());
        $this->assertEquals($email, $user->getEmail());
        $this->assertTrue(password_verify($password, $user->getPassword())); // Verify hashed password
        $this->assertEquals($type, $user->getType());*/
    }

}
