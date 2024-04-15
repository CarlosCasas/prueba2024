<?php

namespace App\Services;

use App\Http\Request;

class RequestService
{
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function input($key, $default = null)
    {
         // Obtener el JSON del cuerpo de la solicitud
         $jsonData = file_get_contents("php://input");

         // Decodificar el JSON en un array asociativo
         $requestData = json_decode($jsonData, true);
 
         // Verificar si la clave existe en los datos decodificados
         return isset($requestData[$key]) ? $requestData[$key] : $default;
    }

    
    public function getData()
    {
        $jsonData = file_get_contents("php://input");

        return json_decode($jsonData, true);
    }

}
