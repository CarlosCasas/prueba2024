<?php
//namespace App\Controllers;

require_once '../App/Repositories/TransactionRepositories.php';
require_once '../App/Repositories/WalletRepositories.php';
require_once '../App/Repositories/UserRepositories.php';

require_once '../App/Services/RequestService.php';
require_once '../App/Services/ResponseService.php';
use App\Services\RequestService;
use App\Services\ResponseService;
use App\Repositories\TransactionRepositories;
use App\Repositories\WalletRepositories;
use App\Repositories\UserRepositories;


class TransactionController //extends BaseController
{

    private $transactionRepositories;
    private $walletRepositories;
    private $userRepositories;
    private $requestService;
    private $responseService;

    public function __construct()
    {
        $this->transactionRepositories = new TransactionRepositories();
        $this->walletRepositories = new WalletRepositories();
        $this->userRepositories = new UserRepositories();
        $this->requestService = new RequestService();
        $this->responseService = new ResponseService();
    }

    public function createTransaction()
    {
        $id = null;
        $userPayerId = $this->requestService->input('payer');
        $userPayeeId = $this->requestService->input('payee');
        $amount = $this->requestService->input('value');
        $status = 1;
        $urlAuthorized = 'https://run.mocky.io/v3/1f94933c-353c-4ad1-a6a5-a1a5ce2a7abe';
        try {
            $resultAuthorized = $this->getServiceExternal($urlAuthorized);
            if (!isset($resultAuthorized['message']) || $resultAuthorized['message'] !== 'Autorizado') {
                throw new Exception('No se pudo conectar al servicio');
                //return $this->responseService->json(['error' => 'No se pudo conectar al servicio'], 500);
            }

            
            //Consultar el Saldo del usuario
            $walletPayerId = $this->walletRepositories->getBalance($userPayerId);
            $walletPayeeId = $this->walletRepositories->getBalance($userPayeeId);
            // Crear una instancia de la transacción con los datos recibidos
            $transaction = new Transaction($userPayerId, $userPayeeId, $amount, $status);
            if($walletPayerId== null){
                throw new Exception('No existe el usuario.');
            }
            if($walletPayeeId== null){
                throw new Exception('No existe el usuario/comerciante.');
            }

            //Consulta si el Payer es Usuario
            $userData = $this->userRepositories->findById($userPayerId);
            $userTypeId = Wallet::toArrayFormat($userData);
            if($userTypeId['type'] !== 1){
                throw new Exception('El payer es Comerciante, no esta permitido reaizar transferencias.');
            }

            if(wallet::toArrayFormat($walletPayerId)['balance'] <= 0){
                throw new Exception('El usuario no cuenta con Saldo disponible.');
            }
            $createdTransactionId = $this->transactionRepositories->insertTransaction($transaction);
            // Verificar si la transacción se creó con éxito
            if ($createdTransactionId) {
                // Actualizar Wallet
                $updateWalletPayerId = $this->walletRepositories->updateBalance($walletPayerId,$amount,wallet::OPERACION_INGRESO);
                if ($updateWalletPayerId) {
                    $updateWalletPayeeId = $this->walletRepositories->updateBalance($walletPayeeId, $amount,wallet::OPERACION_EGRESO);
                    if($updateWalletPayeeId ){
                         // Devolver la respuesta con el ID de la transacción creada
                        $resultNotification = $this->notificationTransaction();
                        return $this->responseService->json(['transaction_id' => $createdTransactionId, 'userPayerId' => $userPayerId,'notification' => $resultNotification], 201);

                    }else {
                        // Si falla la actualización del saldo, lanzar una excepción
                        throw new Exception('No se pudo actualizar el saldo DEL COMERCIANTE.');
                    }                   
                } else {
                    //Cambia al estado a la transación realizada como inactiva
                    $this->transactionRepositories->updateInactiveTransaction($createdTransactionId);
                    // Si falla la actualización del saldo, lanzar una excepción
                    throw new Exception('No se pudo actualizar el saldo del USUARIO.');
                }
            } else {
                // Si falla la creación de la transacción, lanzar una excepción
                throw new Exception('No se pudo crear la transacción');
            }
        } catch (Exception $e) {
            // Si ocurre alguna excepción, hacer rollback de la transacción
            // Devolver un error si la transacción no se pudo completar
            return $this->responseService->json(['error' => $e->getMessage()], 500);
        }
  
        
    }

    private function getServiceExternal($url){
        $serviceResponse = file_get_contents($url);
        if ($serviceResponse !== false) {
            $serviceData = json_decode($serviceResponse, true);

            return $serviceData;
        }
        else {
            // Devolver un error si no se recibió respuesta del servicio web
            return $this->responseService->json(['error' => 'No se pudo conectar al servicio'], 500);
        }
    }

    private function notificationTransaction(){
        $urlNotification = 'https://run.mocky.io/v3/6839223e-cd6c-4615-817a-60e06d2b9c82';
        $resultNotification = $this->getServiceExternal($urlNotification);
        if (!isset($resultNotification['message']) || $resultNotification['message'] !== true) {
            return false;
            //return $this->responseService->json(['error' => 'No se pudo conectar al servicio'], 500);
        }
        return $resultNotification['message'];
    }
}