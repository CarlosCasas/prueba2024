<?php
//namespace App\Controllers;
require_once '../App/Repositories/UserRepositories.php';
require_once '../App/Services/RequestService.php';
require_once '../App/Services/ResponseService.php';
use App\Services\RequestService;
use App\Services\ResponseService;
use App\Repositories\UserRepositories;

class PruebasController
{

    private $userRepositories;
    private $requestService;
    private $responseService;

    public function __construct()
    {


        $this->userRepositories = new UserRepositories();
        $this->requestService = new RequestService();
        $this->responseService = new ResponseService();
    }

    public function getAll()
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com']
        ];

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
