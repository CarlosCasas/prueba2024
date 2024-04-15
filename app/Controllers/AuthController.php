<?php
use App\Services\RequestService;
use App\Services\ResponseService;
class AuthController extends BaseController
{

    private $userRepositories;
    private $requestService;
    private $responseService;

    public function __construct()
    {
        $this->requestService = new RequestService();
        $this->responseService = new ResponseService();
    }
    /*public function login( $request)
    {
        
    }

    public function register(Request $request)
    {

    }*/
}
