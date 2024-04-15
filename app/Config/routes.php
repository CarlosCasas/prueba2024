<?php
/*use App\Http\Request;
use App\Services\RequestService;
use App\Services\ResponseService;*/

// Obtiene la ruta solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if (!isset($uri[4])  || !isset($uri[5])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}


//print_r($uri);exit;
 

// Define las rutas disponibles y los controladores asociados
$routes = [
    '/pruebas' => 'PruebasController',
    '/user' => 'UserController',
    '/wallet' => 'WalletController',
    '/transaction' => 'TransactionController',
    //'/user/getUser' => 'UserController@getUser'

];
// Verifica si la ruta solicitada está definida
//print_r($uri);exit;
if (isset($routes['/'.$uri[4]])) {
    // Obtiene el nombre del controlador
    $controllerName = $routes['/'.$uri[4]];
    $parameter = isset($uri[6]) ? $uri[3] : null; // Obtener el parámetro si está presente

    // Crea una instancia del controlador
    $controller = new $controllerName();
    //print_r($controllerName.'->'.$uri[5]);exit;
    

    // Verifica si el método solicitado existe en el controlador
    if (method_exists($controller, $uri[5])) {
        //print_r($controllerName.'->'.$uri[5]);exit;
        // Llama al método apropiado del controlador
       // $controller->{$uri[5]}();
        if ($parameter !== null) {
            $controller->{$uri[5]}($parameter);
        } else {
            $controller->{$uri[5]}();
        }
    } else {
        // Si la acción no está definida en el controlador, devuelve un error 404
        http_response_code(404);
        echo 'Error 404: Acción no encontrada';
    }
} else {
    // Si la ruta no está definida, devuelve un error 404
    http_response_code(404);
    echo 'Error 404: Página no encontrada';
}
