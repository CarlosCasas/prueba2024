<?php

//namespace App\Controllers;
require_once '../App/Repositories/UserRepositories.php';
require_once '../App/Services/RequestService.php';
require_once '../App/Services/ResponseService.php';
use App\Services\RequestService;
use App\Services\ResponseService;
use App\Repositories\UserRepositories;

class UserController //extends BaseController
{
    private $userRepositories;
    private $requestService;
    private $responseService;

    public function __construct(/*UserRepositories $userRepositories, RequestService $requestService,ResponseService $responseService*/)
    {
        /*$this->userRepositories = $userRepositories;
        $this->requestService = $requestService;
        $this->responseService = $responseService;*/
        $this->userRepositories = new UserRepositories();
        $this->requestService = new RequestService();
        $this->responseService = new ResponseService();
    }

    public function getAll()
    {
        $users = $this->userRepositories->findAllUsers();
        //print_r($users);exit;
        if (!$users) {
            return json_encode(['error' => 'No users found'], 404);
        }

        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $user->toArray(); // Assuming a method in User model
        }

        return $this->responseService->json($userArray);
    }

    public function getUser()
    {
        // Obtener el parámetro userID del cuerpo del JSON
        $userId = $this->requestService->input('id');
        // Buscar usuario por ID
        $users = $this->userRepositories->findById($userId);
        // Verificar si se encontró el usuario
        if (empty($users)) {
            return $this->responseService->json(['error' => 'User not found'], 404);
        }

        $userArray = [];
        foreach ($users as $user) {
            $userArray = $user->toArray(); // Assuming a method in User model
        }

        // Devolver el usuario encontrado
        return $this->responseService->json($userArray);
  
    }
    /*
    public function updateUser($id)
    {
        // Validate and sanitize user data
        $name = $this->requestService->input('name');
        $email = $this->requestService->input('email');

        // Use UserRepository to find user by id
        $user = $this->userRepositories->findById($id);

        if (!$user) {
            return $this->responseService->json(['error' => 'User not found'], 404);
        }

        // Update user data (excluding sensitive fields like password)
        $user->setName($name);
        $user->setEmail($email);

        // Use UserRepository to save updated user
        $this->userRepositories->saveUser($user);

        // Update successful
        return $this->responseService->json(['message' => 'User updated successfully']);
    }*/
}