<?php

//namespace App\Controllers;
require_once '../App/Repositories/WalletRepositories.php';
require_once '../App/Services/RequestService.php';
require_once '../App/Services/ResponseService.php';
use App\Services\RequestService;
use App\Services\ResponseService;
use App\Repositories\WalletRepositories;

class WalletController //extends BaseController
{
    private $walletRepositories;
    private $requestService;
    private $responseService;

    public function __construct()
    {
        $this->walletRepositories = new WalletRepositories();
        $this->requestService = new RequestService();
        $this->responseService = new ResponseService();
    }

    public function getBalance()
    {
        // Obtener el parámetro userID del cuerpo del JSON
        $userId = $this->requestService->input('user_id');
        // Buscar usuario por ID
        $users = $this->walletRepositories->getBalance($userId);
        // Verificar si se encontró el usuario
        if (empty($users)) {
            return $this->responseService->json(['error' => 'User not found'], 404);
        }

        /*$userArray = [];
        foreach ($users as $user) {
            $userArray = $user->toArray();
        }*/

        // Devolver el usuario encontrado
        //return $this->responseService->json($userArray);
        return $this->responseService->json(Wallet::toArrayFormat($users));

  
    }
   
}